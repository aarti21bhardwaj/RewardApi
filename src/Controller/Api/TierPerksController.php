<?php
namespace App\Controller\Api;


use App\Controller\Api\ApiController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\NotFoundException;

/**
 * Tiers Controller
 *
 * @property \App\Model\Table\TiersTable $Users
 */
class TierPerksController extends ApiController
{


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $tierPerk = $this->TierPerks->newEntity();
        $tierPerk = $this->TierPerks->patchEntity($tierPerk, $this->request->data);
        if ($this->TierPerks->save($tierPerk)) {

            $this->set('user', $tierPerk);
            $this->set('response', ['status' => "OK"]);
        } else {
            //pr($user->errors());die;
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$tierPerk->id;
                $data['data']['perk']=$tierPerk->perk;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
    }

     /**
     * Edit method
     *
     * @param string|null $id Tier id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tierPerk = $this->TierPerks->find('all')->where(['id'=>$id])->first();
        if(!$tierPerk){
           throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }
        if ($this->request->is('put')) {
            $tierPerk = $this->TierPerks->patchEntity($tierPerk, $this->request->data);
            if ($this->TierPerks->save($tierPerk)) {
               $this->set('user', $tierPerk);
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