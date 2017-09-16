<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Staffs Controller
 *
 * @property \App\Model\Table\StaffsTable $Staffs
 */
class StaffsController extends AppController
{
    const SUPER_ADMIN_LABEL = 'admin';
    const STAFF_ADMIN_LABEL = 'staff_admin';
    const STAFF_MANAGER_LABEL = 'staff_manager';


    public function initialize()
    {
        parent::initialize();
        $this->Auth->config('authorize', ['Controller']);

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

       $loggedInUser = $this->Auth->user();
        //pr($loggedInUser);

        if($loggedInUser['role_id'] == 1){
          $staffs = $this->Staffs->find('WithDisabled')->contain(['Roles', 'Resellers'])->all();
        
      }
      else if($loggedInUser['role_id'] == 2){
        $staffs = $this->Staffs->find('WithDisabled')->contain(['Roles', 'Resellers'])->where(['reseller_id =' => $this->Auth->user('reseller_id'),'Roles.name <>'=>self::SUPER_ADMIN_LABEL])->all();
       
      }
      else {
        $staffs = $this->Staffs->find('WithDisabled')->contain(['Roles', 'Resellers'])->where(['reseller_id =' => $this->Auth->user('reseller_id'), 'Roles.name'=>self::STAFF_MANAGER_LABEL])->all();
        
      }
        // $users = $this->paginate($users);
        // $this->set('users', $this->paginate($users));
        // $this->paginate = [
        //     'contain' => ['Roles', 'Resellers']
        // ];
        // $users = $this->paginate($this->Users);

        $this->set(compact('staffs','roles','resellers'));
        $this->set('_serialize', ['staff']);
        $this->set('loggedInUser', $loggedInUser);
    }

    /**
     * View method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       $staff = $this->Staffs->get($id, [
            'contain' => ['Roles', 'Resellers', 'UserOldPasswords']
        ]);

        $this->set('staff', $staff);
        $this->set('_serialize', ['staff']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loggedInUser = $this->Auth->user();
        $staff = $this->Staffs->newEntity();
        if ($this->request->is('post')) {
            $staff = $this->Staffs->patchEntity($staff, $this->request->data);
            if ($this->Staffs->save($staff)) {
                $this->Flash->success(__('The staff has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The staff could not be saved. Please, try again.'));
            }
        }
        $loggedInUser = $this->Auth->user();
        if($loggedInUser['role_id'] == 1){
        $resellers = $this->Staffs->Resellers->find()->where(['status'=>1])->all()->combine('id', 'org_name');
        $roles = $this->Staffs->Roles->find('list')->where(['status'=>1])->all()->toArray();
        $this->set('resellers', $resellers);
        }else {
        //$vendors = $this->Users->Vendors->find('list')->where(['status'=>1, 'id'=>$loggedInUser['vendor_id']])->all()->toArray();
        $roles = $this->Staffs->Roles->find('list')->where(['status'=>1,'name <>'=>'admin'])->all()->toArray();
      }
        
        $this->set(compact('staff', 'roles', 'resellers', 'loggedInUser'));
        $this->set('_serialize', ['staff']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loggedInUser = $this->Auth->user();
        $staff = $this->Staffs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $staff = $this->Staffs->patchEntity($staff, $this->request->data);
            if ($this->Staffs->save($staff)) {
                $this->Flash->success(__('The staff has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The staff could not be saved. Please, try again.'));
            }
        }

        if($loggedInUser['role_id'] == 1){

            $resellers = $this->Staffs->Resellers->find()->where(['status'=>1])->all()->combine('id', 'org_name');
            $roles = $this->Staffs->Roles->find('list')->where(['status'=>1])->all()->toArray();

          }else if($loggedInUser['role_id'] == 2){
            $resellers = $this->Staffs->Resellers->find('list')
            ->where(['status'=>1, 'id'=>$loggedInUser['reseller_id']])
            ->all()
            ->toArray();

            $roles = $this->Staffs->Roles->find('list')
            ->where(['status'=>1,'name <>'=>'admin'])
            ->all()
            ->toArray();

          }
          else {
             $resellers = $this->Staffs->Resellers->find('list')
            ->where(['status'=>1, 'id'=>$loggedInUser['reseller_id']])
            ->all()
            ->toArray();
            $roles = $this->Staffs->Roles->find('list')
            ->where(['status'=>1,'name'=>'staff_manager'])
            ->all()
            ->toArray();
          }
        
  
        $this->set(compact('staff', 'roles', 'resellers'));
        $this->set('_serialize', ['staff']);
        $this->set('loggedInUser', $loggedInUser);
    }

    /**
     * Delete method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $staff = $this->Staffs->get($id);
        if ($this->Staffs->delete($staff)) {
            $this->Flash->success(__('The staff has been deleted.'));
        } else {
            $this->Flash->error(__('The staff could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


      /**
     * Login method
     *
     **/
    public function login()
    {
        // Layout for the admin login
        $this->viewBuilder()->layout('admin-login');
        if ($this->request->is('post')) {
          // pr($this->request->data); die('blabla');
          //pr($this->Auth->identify()); die;
        $staff = $this->Auth->identify();
        // pr($staff); die;
        if ($staff) {
          $this->loadModel('ResellerPrograms');
            // $staff['reseller_program_id'] = $this->ResellerPrograms->
            $this->Auth->setUser($staff);
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('Username or password is incorrect'), [
                'key' => 'auth'
            ]);
        }
      }
    }

    /** 
    ** Logout method 
    *
    **/
    public function logout()
    {
        $staff = $this->Auth->user();
        $this->redirect($this->Auth->logout());
        $this->Flash->success('You are now logged out.');
    }
}
