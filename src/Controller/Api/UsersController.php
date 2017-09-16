<?php
namespace App\Controller\Api;


use App\Controller\Api\ApiController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\NotFoundException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends ApiController
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
        if(!$this->request->data['name']){
            throw new BadRequestException(__('MANDATORY_FIELD_MISSING', 'name'));
        }
        if(!isset($this->request->data['email']) && !isset($this->request->data['guardian_email'])){
            throw new BadRequestException(__("One of the two is required, Email or gaurdian's email"));
        }
        
        $this->request->data['reseller_program_id'] = $this->Auth->user('id');;
        $this->request->data['password'] = $this->_randomPassword();

        // $response = $this->PeopleHub->registerPatient($this->Auth->user('vendor_peoplehub_id'), $this->request->data);
         $response = $this->Peoplehub->requestData('post', 'vendor', 'redeemedCredits', false, false, $rewardRedemptionData, null );


        if(!$response || !$response->status){
            // pr($response);die;
            $message ="";
            foreach($response->error as $key=>$value)
            {
                $message= $message." ".$value->unique;
            }
            if($message == " This email id is already registered with Us. Kindly login. Username not available."){

                $response->title = "It looks like this email is linked to another account";
                // $response->message = "This email is already linked to another patient's account. In order to assign a second patient to ".$patientFirstName."'s email ID, Please click on 'Add Another Patient'";
            
            }else{

                throw new InternalErrorException(__($message));
            }
            
        }else{


            $data = [ 
                        'bountee_user_id' => $response->data->id, 
                        'reseller_program_id' => $this->Auth->user('id')
                    ];

            $user = $this->Users->newEntity();
            
            $user = $this->Users->patchEntity($user, $data);

            if($this->Users->save($user)){
            $this->set('user', $user);
            $this->set('response', ['status' => "OK"]);
            } else{
                throw new InternalErrorException(__('ENTITY_ERROR', 'vendor patient'));

            }

                $data =array();
                $data['status']=true;
                $data['data']['id']=$user->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }
    }

     /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->find('all')->where(['id'=>$id])->first();
        if(!$user){
           throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }
        if ($this->request->is('put')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
               $this->set('user', $user);
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

    private function _randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}