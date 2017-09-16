<?php
namespace App\Controller\Api;

    use App\Controller\Api\ApiController;
    use Cake\Network\Exception\MethodNotAllowedException;
    use Cake\Network\Exception\BadRequestException;
    use Cake\Collection\Collection;

    /**
     * Redemptions Controller
     *
     * @property \App\Model\Table\RewardsTable $rewards
     */
    class RedemptionsController extends ApiController
    {

     public function initialize()
     {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }

    /**
     * Redemptions for Amazon/Tango card and custom gift coupons 
     */

    public function redemption(){

        if(!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }

        $this->loadModel('Users');
        $userId = $this->Users->findByBounteeUserId($this->request->data['redeemer_peoplehub_identifier'])->first()->id;
        $this->request->data['user_id'] = $userId;
        $this->request->data['reseller_program_id'] = $this->Auth->user('id');
        
        // Check if rewardId is set or not.
        if(isset($this->request->data['reward_id'])){
            $this->loadModel('Rewards');
            $reward = $this->Rewards->findById($this->request->data['reward_id'])->first();
            if(!$reward){

                throw new NotFoundException(__('Reward not found'));
            }

               $this->loadModel('ResellerPrograms');
               $esellerProgram = $this->ResellerPrograms->findById($this->Auth->user('id'))->first();
               if(!$esellerProgram){
                throw new NotFoundException(__('Reseller Program not found'));
               }
            // Redemptions for custom gift coupons 
            if($reward->name == 'Custom Gift Coupons') {

                if($reward && $reward->amount == 0){
                    if(!$this->request->data['amount']){
                        throw new BadRequestException(__('EMPTY_NOT_ALLOWED', 'amount'));
                    }
                    $amount = $this->request->data['amount'];
                }elseif($reward && $reward->amount){
                    $amount = $reward->amount;
                }elseif($reward && !$reward->amount){
                    throw new BadRequestException(__('REWARD_ID_NOT_CORRESPOND'));
                }elseif(!$reward){
                    throw new BadRequestException(__('RECORD_NOT_FOUND_IN', 'LegacyRewards'));
                }else{
                    throw new InternalErrorException(__('BAD_REQUEST'));
                }
                $instantRedemptionData = ['amount' => $amount, 'user_id' => $userId, 'service' => $this->request->data['service'], 'description' => $reward->name];
            
                $legacyRedemptionId = $this->_rewardRedemption($this->request->data, $reward, $instantRedemptionData);
            } elseif($reward->name == 'Amazon/Tango'){
                $redeemReward = $this->_redeemWalletCredits(
                                                    $this->request->data['redeemer_peoplehub_identifier'],
                                                    $this->request->data['service']
                                                ); 
            } else {
                 throw new NotFoundException(__('Reward not found'));
            }

        if(!$redeemReward['response']){

            throw new InternalErrorException(__('Error in response from peoplehub'));

        }
        $this->request->data['transaction_number'] = $redeemReward['response']->data->id;

        $redemption = $this->Redemptions->newEntity();
        
        if(isset($this->request->data['points']) && !isset($this->request->data['amount']) ){

            $pointValue = (int) 50;
            $points = (int) $this->request->data['points'];

            $this->request->data['amount'] = $points / $pointValue;

        }elseif(!isset($this->request->data['points']) && isset($this->request->data['amount']) ){

            $this->request->data['amount'] = $this->request->data['amount'];

        } else{
           throw new BadRequestException(__("Either amount or points should set")); 
        }
            $redemption = $this->Redemptions->patchEntity($redemption, $this->request->data); 

        if($redemption->errors()){

            throw new BadRequestException(__("ENTITY_NOT_CORRECT"));
        }

        if(!$this->Redemptions->save($redemption)){

            throw new InternalErrorException(__('COULD_NOT_SAVED'));
        }
        
        $this->set(compact('Redemptions'));
        $this->set('_serialize', ['redemption']);

        }        

    }

    private function _redeemWalletCredits($userId, $service){
       
      // See AppController::beforeRender() to know more about why we 
      // are reading from the session and using the loop.
    // $session = new Session();
    // $cardSetup = $session->read('CardSetup');
    
    // if($cardSetup == 0){

    //     throw new BadRequestException(__('Credit Card is not setup. Please setup your card first.'));

    // }
    $rewardRedemptionData = ['user_id' => $userId , 'service' => $service , 'reward_type' => 'wallet_credit'];


    $redeemRewardResponse = $this->PeopleHub->redeemReward($rewardRedemptionData, $this->Auth->user('vendor_peoplehub_id'));
    if(!$redeemRewardResponse['status']){
      throw new BadRequestException(__('PEOPLE_HUB_REQUEST_REJECTED'.json_encode($redeemRewardResponse['response']->message)));
    }

    return $redeemRewardResponse;
    }

    private function _redeemStoreCredits($userId, $points, $rewardType){
        
        $rewardRedemptionData = ['user_id'=> $userId, 'points' => $points , 'reward_type' => $rewardType];


        $redeemRewardResponse = $this->PeopleHub->redeemReward($rewardRedemptionData, $this->Auth->user('vendor_peoplehub_id'));

        if(!$redeemRewardResponse['status']){
            
            throw new BadRequestException(__('PEOPLE_HUB_REQUEST_REJECTED'.json_encode($redeemRewardResponse['response']->message)));
        }

        return $redeemRewardResponse;
    }
    

    private function _rewardRedemption($redemptionData, $reward, $instantRedemptionData){
        //hit people hub API for instant gift card redemption. On success:

        $redeemRewardResponse = $this->PeopleHub->instantRedemption($instantRedemptionData, $this->Auth->user('vendor_peoplehub_id'));

        if(!$redeemRewardResponse['status']){
            throw new BadRequestException('Some error occured'.json_encode($instantRedemptionResponse));
        }
        return $redeemRewardResponse;
        
    }
}

