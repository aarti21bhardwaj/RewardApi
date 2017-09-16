<?php
namespace App\Controller\Api;


use App\Controller\Api\ApiController;
use Cake\Controller\Component;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\NotFoundException;

/**
 * Tiers Controller
 *
 * @property \App\Model\Table\TiersTable $Users
 */
class TiersController extends ApiController
{


 public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
    
    //$this->loadComponent('Auth');
    // $this->Auth->config('authorize', ['Controller']);
  }

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
        // pr($this->Auth->user());die;
        $tier = $this->Tiers->newEntity();
        $resellerId = $this->Auth->user('reseller_id');
        $tier = $this->Tiers->Resellers->ResellerPrograms->findByResellerId($resellerId)->first();
        $this->request->data['reseller_id'] = $resellerId;
        $tier = $this->Tiers->patchEntity($tier, $this->request->data);
        
        if ($this->Tiers->save($tier)) {

            $this->set('tier', $tier);
            $this->set('response', ['status' => "OK"]);
        } else {
            //pr($tier->errors()); die;
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$tier->id;
                $data['data']['name']=$tier->name;
                $data['data']['lowerbound']=$tier->lowerbound;
                $data['data']['upperbound']=$tier->upperbound;
                $data['data']['multiplier']=$tier->multiplier;
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
        $tier = $this->Tiers->find('all')->where(['id'=>$id])->first();
        if(!$tier){
           throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }
        if ($this->request->is('put')) {
            $tier = $this->Tiers->patchEntity($tier, $this->request->data);
            if ($this->Tiers->save($tier)) {
               $this->set('user', $tier);
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

    public function isAuthorized($tier)
    {
        return true;
    }

}