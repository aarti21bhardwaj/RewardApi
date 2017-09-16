<?php
namespace App\Controller\Api;

    use App\Controller\Api\ApiController;
    use Cake\Network\Exception\MethodNotAllowedException;
    use Cake\Network\Exception\BadRequestException;
    use Cake\Network\Exception\InternalErrorException;
    use Cake\Collection\Collection;

    /**
     * Legacy Rewards Controller
     *
     * @property \App\Model\Table\LegacyRewardsTable $legacyRewards
     */
    class GiftCouponsController extends ApiController
{
    // public function initialize()
    //  {
    //     parent::initialize();
    //     $this->loadComponent('RequestHandler');

    // }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function add()
    {
        // die('tyui');
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $giftCoupon = $this->GiftCoupons->newEntity();

       $giftCoupon = $this->GiftCoupons->patchEntity($giftCoupon, $this->request->data);
        if ($this->GiftCoupons->save($giftCoupon)) {

            $this->set('GiftCoupons', $giftCoupon);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$giftCoupon->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
    }  

    public function edit($id = null)
    {
        $giftCoupon = $this->GiftCoupons->find('all')->where(['id'=>$id])->first();
        if(!$giftCoupon){
           throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }
        if ($this->request->is('put')) {
            $giftCoupon = $this->GiftCoupons->patchEntity($giftCoupon, $this->request->data);
            if ($this->GiftCoupons->save($giftCoupon)) {
               $this->set('giftCoupon', $giftCoupon);
               $this->set('response', ['status' => "Updated Successfuly"]);
            } else {
                throw new InternalErrorException(__('Internal Error'));
            }
                $data =array();
                $data['status']=true;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }
    }





    public function getResellerProgramsCoupons($resellerProgramId = null)
    { 
        if(!$this->request->is('get')){
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        
        if(!$resellerProgramId){
            // pr('here');
            $resellerProgramId = $this->Auth->user('id');
        }
        $giftCoupons = $this->GiftCoupons->findByResellerProgramId($resellerProgramId)->all();
        // pr($giftCoupons); die;

        $response = ['message' => 'gift coupons for reseller program id '.$resellerProgramId.' have been retrieved.', 'giftCoupons' => $giftCoupons];
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function redemption(){
        if(!$this->request->is('post')){
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }

        if(!$this->request->data['gift_coupon_award_id']){
            throw new BadRequestException(__('MANDATORY_FIELD_MISSING', 'gift coupon award id'));
        }

        $this->loadModel('GiftCouponAwards');
        $gcAward = $this->GiftCouponAwards->findById($this->request->data['gift_coupon_award_id'])->first();

        if(!$gcAward){
            throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }else if(!$gcAward->status){
            throw new BadRequestException(__('the gift coupon is not valid anymore.'));
        }

        $gcRedemptionData = ['gift_coupon_award_id' => $this->request->data['gift_coupon_award_id'], 'redemption_status' => 1    /*corresponds to the status: redeemed*/];
        $this->loadModel('GiftCouponRedemptions');
        $gcRedemption = $this->GiftCouponRedemptions->newEntity($gcRedemptionData);
        // pr($gcRedemption); die;
        $gcRedemption = $this->GiftCouponRedemptions->save($gcRedemption);
        if($gcRedemption){
            //update end_time for gift_coupon_award_id received.
            $deactivateGc = ['status' => 0];
            $expiredGcAward = $this->GiftCouponAwards->patchEntity($gcAward, $deactivateGc);

            if($this->GiftCouponAwards->save($expiredGcAward)){
                $this->set('response', ['status' => 'OK', 'data' => ['id' => $gcRedemption->id]]);
                $this->set('_serialize', ['response']);
            }else{
                throw new InternalErrorException(__('ENTITY_ERROR', 'gift coupon award'));
            }
        }
        else{
            throw new InternalErrorException(__('ENTITY_ERROR', 'gift coupon redemption'));
        }
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Gift Coupon id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $giftCoupon = $this->GiftCoupons->get($id);
        $this->loadModel('MilestoneLevelRewards');

        $response = ['status' => FALSE, 'message' => NULL];
        //TODO make reward type seed
        if ($this->GiftCoupons->delete($giftCoupon)){
            if($this->MilestoneLevelRewards->deleteAll(['reward_type_id' => 2, 'reward_id' => $id])){
                $response = ['status' => TRUE, 'message' => (__('ENTITY_DELETED', 'gift coupon'))];
            }
        } else {
            throw new InternalErrorException(__('ENTITY_DELETED_ERROR', 'gift coupon'));
        }
        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function checkForMilestoneRewards($id = null){
        $this->loadModel('MilestoneLevelRewards');
        $milestoneRewards = $this->MilestoneLevelRewards->findByRewardId($id)->where(['reward_type_id' => 2])->all();
        $message = NULL;
        if($milestoneRewards){
            $message = "If you delete this gift coupon, one or more levels in your milestone program may get orphaned.";
        }

        $this->set('response', $message);
        $this->set('_serialize', ['response']);
    }

    public function isAuthorized($giftCoupon)
    {
        return false;
    }
}