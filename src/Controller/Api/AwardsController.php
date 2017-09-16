<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Collection\Collection;


/*$dsn = 'mysql://root:1234@localhost/new_buzzydoc';
ConnectionManager::config('new_buzzydoc', ['url' => $dsn]);*/

/**
 * ReferralLeads Controller
 *
 * @property \App\Model\Table\VendorRedeemedPointsTable 
 */
class  AwardsController extends ApiController
{

    public function initialize()
     {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }
    

 public function promotions()
    {
      $this->loadModel('PromotionAwards');
        if (!$this->request->is('post')) {
        throw new MethodNotAllowedException(__('BAD_REQUEST'));
            }
            $data = $this->request->data;
            $resellerId = $this->Auth->user('reseller_id');
            $data['reseller_id'] = $resellerId;

            $this->loadModel('PromotionAwards');
            $Promotions = $this->PromotionAwards->Promotions->findByResellerProgramId($resellerData['reseller_program_id'])->all();
            $promotionAwards = [];
            $points = 0;
            $userId = $data['user_id'];
            foreach ($data['selectedPromotions'] as $key => $value) {
              foreach ($Promotions as $value2) {
                  if($value === $value2['id']){

                      $promotionAwards[$key]['promotion_id'] = $value2['id'];
                      $promotionAwards[$key]['reseller_id'] = $resellerId;
                      $promotionAwards[$key]['user_id'] = $userId;
                      $promotionAwards[$key]['points'] = $value2['points'];
                      $points += $promotionAwards[$key]['points'];
                  }
              }
          }

          // bountee_transaction_id is fixed for now
          $transactionNumber = 12345;
          $promotionAwardsCollection = new Collection($promotionAwards);
          $promotionAwardsCollection = $promotionAwardsCollection->map(function($value, $key)use($transactionNumber, $userId){
              $value['bountee_transaction_id'] = $transactionNumber;
              return $value;
          });
          $promotionAwards = $promotionAwardsCollection->toArray();

          $promotionAwards = $this->PromotionAwards->newEntities($promotionAwards);
          if($this->PromotionAwards->saveMany($promotionAwards)) {
              $this->set('response', $promotionAwards);
              $this->set('_serialize', ['response']);
          }else{
              throw new InternalErrorException(__('ENTITY_ERROR', 'Promotion Awards'));
          }

    }

    /**
  * Tier method
  * This method is called when amount is spent by the patient. Calculate method in PatientTiersTable is called.
  * If tier upgrades mailer event is fired further if a gift coupon is associated to the tier then GiftCoupon method 
  * is called.
  * If year changes for a patient then mailer event is fired.
  *
  * @return \Cake\Network\Response
  * @throws \Cake\Network\Exception\InternalErrorException when data provided is not valid.
  * @throws \Cake\Network\Exception\BadRequestException if data is empty.
  * @throws \Cake\Network\Exception\MethodNotAllowedException if request is not post.
  * @author James Kukreja
  */

public function tier(){

    if (!$this->request->is('post')) {
        throw new MethodNotAllowedException(__('BAD_REQUEST'));
    }

    $data = $this->request->data;

    if(!$data)
        throw new BadRequestException(__('DATA_EMPTY'));

     $resellerId = $this->Auth->user('reseller_id');

     $data['reseller_id'] = $resellerId;

    $this->loadModel('TierAwards');

    //Calculate method in PatientTiers is called here.
    $tierInfo = $this->TierAwards
    ->Tiers
    ->UserTiers
    ->calculate($data);

 //pr($tierInfo); die;


    //Data to be stored in TierAwards Table is stored here
    $tierReward = [
    'points' => (int) $tierInfo['points'], 
    'user_id' => $data['user_id'], 
    'tier_id' => $tierInfo['tierId'], 
    'amount' => $data['amount'],
    'bountee_transaction_id' => $data['bountee_transaction_id'],
    'reseller_id' => $resellerId
    ];
    //pr($tierReward); die;
    $tierAward = $this->TierAwards->newEntity();
    $tierAward = $this->TierAwards->patchEntity($tierAward, $tierReward);

    if(!$this->TierAwards->save($tierAward)){
        throw new InternalErrorException(__('ENTITY_ERROR', 'tier award'));
    }

    $this->set('response', ['status' => 'OK', 
        'data' =>   [
        'id' => $tierAward->id, 
        'points' => $tierInfo['points']
        ] 
        ]);

    $this->set('_serialize', ['response']);
}


     public function manual()
    {
        $this->loadModel('ManualAwards');
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $data = $this->request->data;
        $resellerId = $this->Auth->user('reseller_id');
        $data['reseller_id'] = $resellerId;
        $manualAward = $this->ManualAwards->newEntity();
        $manualAward = $this->ManualAwards->patchEntity($manualAward, $data);
        if ($this->ManualAwards->save($manualAward)) {

            $this->set('manualAward', $manualAward);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$manualAward->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }


    public function giftCoupon(){
        //if request is not post, throw error.
    if (!$this->request->is('post')) {
      throw new MethodNotAllowedException(__('BAD_REQUEST'));
      }
      $data = $this->request->data;
            //check the request data and throw errors if anything is absent
      if(!isset($data['gift_coupon_id'])){
        throw new BadRequestException(__('MANDATORY_FIELD_MISSING', 'gift_coupon_id'));
      }
      if(!isset($data['user_id'])){
          throw new BadRequestException(__('MANDATORY_FIELD_MISSING', 'user_id'));
      }

      $this->loadModel('GiftCoupons');
      $giftCoupon = $this->GiftCoupons->findById($data['gift_coupon_id'])->first();

      if(!$giftCoupon){
          throw new InternalErrorException(__('RECORD_NOT_FOUND'));
      }

      $this->loadModel('Users');
      $userId = $this->Users->findById($data['user_id'])->first();
      $gcRedemptionResponse = $this->_redeemStoreCredit($userId->bountee_user_id, $giftCoupon->points);
              //check response and log in giftCouponAwards
      if(!$gcRedemptionResponse['status']){
          throw new BadRequestException(__('PEOPLE_HUB_REQUEST_REJECTED'.json_encode($provideRewardResponse['response']->message)));
      }

      $giftCouponAwardData = ['gift_coupon_id' => $data['gift_coupon_id'], 'user_id' => $data['user_id'], 'reseller_program_id' => $this->Auth->user('id'),'transaction_number' => $gcRedemptionResponse['response']->data->id ,'status' => 1];

      $saved = $this->_giftCouponAward($giftCouponAwardData);

      if($saved[1]){
          $this->set('response', ['status' => 'ok', 'id' => $saved[0]]);
          $this->set('_serialize', ['response']);
      }
      else{
          throw new InternalErrorException(__('ENTITY_ERROR', 'gift coupon award'));
      }

      } 

    private function _giftCouponAward($giftCouponAwardData){

      $this->loadModel('GiftCouponAwards');
      $giftCouponAward = $this->GiftCouponAwards->newEntity($giftCouponAwardData);

      if($giftCouponAward->errors()){
          throw new InternalErrorException(__('ENTITY_INTERNAL_ERRORS'));
      }

      $saved = $this->GiftCouponAwards->save($giftCouponAward);
      if($giftCouponAward->errors()){
          throw new InternalErrorException(__('ENTITY_INTERNAL_ERRORS'.','.json_encode($giftCouponAward->errors())));
      }

      return [$giftCouponAward->id, true];

    }

    private function _redeemStoreCredit($redeemersId, $points){

        $rewardRedemptionData = ['user_id' => $redeemersId , 'points' => $points , 'reward_type' => 'store_credit'];
        $this->loadModel('ResellerPrograms');
        $resellerProgramId = $this->ResellerPrograms->findById($this->Auth->user('id'))->first();
      // $redeemRewardResponse = $this->PeopleHub->redeemReward($rewardRedemptionData, $resellerProgramId->$reseller_program_bountee_id);
        $redeemRewardResponse = $this->Peoplehub->requestData('post', 'vendor', 'redeemedCredits', false, false, $rewardRedemptionData, null );
      if(!$redeemRewardResponse['status']){
          throw new BadRequestException(__('PEOPLE_HUB_REQUEST_REJECTED'.json_encode($redeemRewardResponse['response']->message)));
      }

      return $redeemRewardResponse;
    }


}


