<?php
namespace App\Controller\Api;


use App\Controller\Api\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ConflictException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\InternalErrorException;
use Cake\I18n\Time;
use Cake\Auth\BaseAuthenticate;
use Firebase\JWT\JWT;
use Cake\Cache\Cache;
use Cake\Utility\Security;
use Cake\Datasource\ConnectionManager;

/**
 * Resellers Controller
 *
 * @property \App\Model\Table\ResellerProgramsTable $ResellerPrograms
 */
class ResellerProgramsController extends ApiController
{
    public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
    $this->Auth->allow(['token']);
  }
  /**
  * This method is used to validaate reseller on the basis of client id and secret id
  * @param type $authToken string contains Basic token value
  * @return array contains token
  */
  public function validateReseller($authToken,$programId)
  {
    //explode token
    $authToken = explode(' ', $authToken);
    //validate basic token
    if(!isset($authToken[0]) || (isset($authToken[0]) && empty($authToken[0])) || strtolower($authToken[0])!='basic'){
      throw new UnauthorizedException(__('INVALID_TOKEN_PROVIDED'));
    }
    if(!isset($authToken[1]) || (isset($authToken[1]) && empty($authToken[1]))){
      throw new UnauthorizedException(__('INVALID_TOKEN_PROVIDED'));
    }
    //check for token element which will be present at 1st index
    $authToken = $authToken[1];
    //decode token
    $resellerTokenData = base64_decode($authToken,true);
    //extract client id and client secret
    $resellerTokenData = explode(':',$resellerTokenData);

    $clientId = $resellerTokenData[0];
    // pr($clientId); die();
    $clientSecret = $resellerTokenData[1];
    //find reseller
    $this->loadModel('Resellers');
    $reseller  = $this->Resellers->find()->where(['client_identifier'=>$clientId,'client_secret' =>$clientSecret ,'status'=>1])->first();
    // pr($reseller); die;
    $time = time() + 2000;
   
    if(!empty($reseller)){
      return array('reseller_id'=>$reseller->id,
      'program_id'=>$programId,
      'token'=>JWT::encode(['sub' => $programId,'exp' =>  $time],Security::salt()),
      'exp' =>  $time);
    }else{
      throw new UnauthorizedException(__('INVALID_TOKEN_PROVIDED'));
    }

  }

   /**
  * This method is used to verify whether a program belongs to a particular reseller or not.
  * @param integer $resellerId contains reseller id
  * @param integer $programId contains reseller program id
  *
  * @return Boolean return True if program belongs to the reseller else false
  */
  public function _isProgramAssociatedToReseller($resellerId,$programId){
    $this->loadModel('ResellerPrograms');
    $resellerInfo = $this->ResellerPrograms->find('all')->where(['id'=>$programId,'reseller_id' =>$resellerId])->first();
    if($resellerInfo) {
      return TRUE;
    }else{
      return FALSE;
    }

  }

  public function token()
  {
    if (!$this->request->is(['post'])) {
      throw new MethodNotAllowedException(__('BAD_REQUEST'));
    }
    //  $this->loadModel('Resellers');

    // $resellerId  = $this->ResellerPrograms->find()->where(['id'=>$data['reseller_program_id']])->first()->reseller_id;

    // $resellerData = $this->Resellers->findById($resellerId)->select(['client_identifier', 'client_secret'])->first();

    // $clientId = $resellerData->client_identifier;
    // $clientSecret = $resellerData->client_secret;

    // $value = $clientId.":".$clientSecret;
    
    // $encode = base64_encode($value);

    // $token = "Basic"." ".$encode;
     
    //grab basic token
    $token =  $this->request->header('Authorization');
    if(!$token){
      throw new UnauthorizedException(__('INVALID_TOKEN_PROVIDED'));
    }
    $data = $this->request->data;
    
    if(!$this->request->data){
      throw new BadRequestException(__('Request Data not found. Kindly Provide valid Request Data.'));
    }
    if(!isset($data['reseller_program_id']) || (isset($data['reseller_program_id']) && empty($data['reseller_program_id']))){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','reseller_program_id'));
    }

     $this->loadModel('ResellerPrograms');
    $validateResellerProgram  = $this->ResellerPrograms->find()->where(['id'=>$data['reseller_program_id']])->first();
    if(!$validateResellerProgram){
      throw new BadRequestException(__('INVALID_RESELLER_PROGRAM'));
    }
    //if token availablet then find out the reseller and create cache
    $resellerData = $this->validateReseller($token,$data['reseller_program_id']);
    // pr($resellerData); die;
    if(!$resellerData){
      throw new UnauthorizedException(__('INVALID_TOKEN_PROVIDED'));
    }
    $resellerId = $resellerData['reseller_id'];
    $programId = $resellerData['program_id'];
    $resellerInfo = $this->_isProgramAssociatedToReseller($resellerId,$programId);
    if(!$resellerInfo){
      throw new UnauthorizedException(__('UNAUTHORIZED_REQUEST'));
    }

    $data = ['reseller_id'=>$resellerId,'reseller_program_id'=>$programId]; 
    $data =array();
    $data['status']=true;
    $data['data']['token']=$resellerData['token'];
    $data['data']['expires']=$resellerData['exp'];
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);
  }

}