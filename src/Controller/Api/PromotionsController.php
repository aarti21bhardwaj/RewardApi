<?php
namespace App\Controller\Api;

    use App\Controller\Api\ApiController;
    use Cake\Network\Exception\MethodNotAllowedException;
    use Cake\Network\Exception\BadRequestException;
    use Cake\Collection\Collection;

    /**
     * Legacy Rewards Controller
     *
     * @property \App\Model\Table\LegacyRewardsTable $legacyRewards
     */
    class PromotionsController extends ApiController
    {

     public function initialize()
     {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }


     public function add()
    {
        // pr($this->request->data); die("blabla");
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $promotion = $this->Promotions->newEntity();
        $resellerProgramId = $this->Auth->user('reseller_program_id');
        $this->request->data['reseller_program_id'] = $resellerProgramId;
        //validate token
        // $resellerData = $this->_validateAuthToken($this->request->header('token'));
        // $resellerId = $resellerData['reseller_program_id'];
        // $this->request->data['reseller_program_id'] = $resellerId;

       $promotion = $this->Promotions->patchEntity($promotion, $this->request->data);
       //pr($promotion); die;
        if ($this->Promotions->save($promotion)) {

            $this->set('promotion', $promotion);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$promotion->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }  

        public function edit($id = null)
        {
        $promotion = $this->Promotions->find('all')->where(['id'=>$id])->first();
        if(!$promotion){
           throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }
        if ($this->request->is('put')) {
            $promotion = $this->Promotions->patchEntity($promotion, $this->request->data);
            if ($this->Promotions->save($promotion)) {
               $this->set('promotion', $promotion);
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

    
}

