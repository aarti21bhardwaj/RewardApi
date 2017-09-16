<?php
namespace App\Controller\Reseller;

use App\Controller\Reseller\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ConflictException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Collection\Collection;
use Cake\Event\Event;
use Cake\Routing\Router;

/**
* Staff User Controller
*
* @property \App\Model\Table\LegacyRedemptionsTable $staff
*/
class StaffsController extends ApiController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');

	}

	// Change Password
	public function updatePassword(){
		if(!$this->request->is(['post'])){
			throw new MethodNotAllowedException(__('BAD_REQUEST'));
		}
		$data = $this->request->data;
		if(!isset($data['new_password'])){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','new_password'));
		}
		if(isset($data['new_password']) && empty($data['new_password'])){
			throw new BadRequestException(__('EMPTY_NOT_ALLOWED','new_password'));
		}
		if(!isset($data['old_password'])){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','old_password'));
		}
		if(isset($data['old_password']) && empty($data['old_password'])){
			throw new BadRequestException(__('EMPTY_NOT_ALLOWED','old_password'));
		}
		if(!isset($data['staff_id'])){
			throw new BadRequestException(__('MANDATORY_FIELD_MISSING','staff_id'));
		}
		if(isset($data['staff_id']) && empty($data['staff_id'])){
			throw new BadRequestException(__('EMPTY_NOT_ALLOWED','staff_id'));
		}
		$id = $data['staff_id'];
		$staff = $this->Staffs->find()->where(['id'=>$id])->first();
		if(!$staff){
			throw new NotFoundException(__('ENTITY_DOES_NOT_EXISTS','Staff'));
		}
		$password = $data['new_password'];
		$oldPassword = $data['old_password'];


		$hasher = new DefaultPasswordHasher();
		if(!$hasher->check( $oldPassword,$staff->password)){
			throw new BadRequestException(__('UNAUTHORIZED_PROVIDE_OLD_PASSWORD'));
		}
		if(! preg_match("/^[A-Za-z0-9~!@#$%^*&;?.+_]{8,}$/", $password)){
			throw new BadRequestException(__('Only numbers 0-9, alphabets a-z A-Z and special characters ~!@#$%^*&;?.+_ are allowed.'));
		}
		$reqData = ['password'=>$password];

		$isContainChars = false;
		for( $i = 0; $i <= strlen($staff->username)-3; $i++ ) {
			$char = substr( $staff->username, $i, 3 );
			if(strpos($password,$char,0) !== false ){
				$isContainChars = true;
				break;
			}
		}
		if($isContainChars){
			throw new BadRequestException(__('THREE_CONTIGUOUS_CHARACTERS','username'));
		}
		$fullname = $staff->full_name;
		for( $i = 0; $i <= strlen($fullname)-3; $i++ ) {
			$char = substr( $fullname, $i, 3 );
			if(strpos($password,$char,0) !== false ){
				$isContainChars = true;
				break;
			}
		}
		if($isContainChars){
				throw new BadRequestException(__('THREE_CONTIGUOUS_CHARACTERS','full name'));
		}
		$this->loadModel('OldPasswords');

		$userOldPasswordCheck = $this->OldPasswords->find('all')->where(['staff_id'=>$id])->toArray();
		foreach ($userOldPasswordCheck as $key => $value) {
			if($hasher->check( $password,$value['password'])){
				throw new BadRequestException(__('SIX_EARLIER_PASSWORD'));
			}
		}
		$staff = $this->Staffs->patchEntity($staff, $reqData);
		if($this->Staffs->save($staff)){
			$reqData = ['staff_id'=>$id,'password'=>$password];

			$userOldPasswordCheck = $this->OldPasswords->newEntity($reqData);
			$userOldPasswordCheck = $this->OldPasswords->patchEntity($userOldPasswordCheck, $reqData);
			if($this->OldPasswords->save($userOldPasswordCheck)){
				$userOldPasswordCheck = $this->OldPasswords->find('all')->where(['staff_id'=>$id]);
				if($userOldPasswordCheck->count() > 6){
					$userOldPasswordCheck =$userOldPasswordCheck->order('created ASC')->first();
					$userOldPasswordCheck = $this->OldPasswords->delete($userOldPasswordCheck);
				}
				$data =array();
				$data['status']=true;
				$data['data']['id']=$staff->id;
				$data['data']['message']='password saved';
				$this->set('response',$data);
				$this->set('_serialize', ['response']);

			}else{
				// pr($userOldPasswordCheck->errors());die;
				//log password not changed
				// throw new BadRequestException(__('can not use earlier used 6 passwords'));
			}
		}else{
			// pr($user->errors());die;
			throw new BadRequestException(__('BAD_REQUEST'));
		}

	}

}