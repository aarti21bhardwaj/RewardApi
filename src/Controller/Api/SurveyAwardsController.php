<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Core\Exception\Exception;
use Cake\Collection\Collection;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\Log\Log;

/**
 * ComplianceSurvey Controller: Apis pertaining to compliance survey and awarding milestones through it.
 *
 * @property \App\Model\Table\ComplianceSurveyTable $ComplianceSurvey
 */
class SurveyAwardsController extends ApiController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
   * @api {post} Save compliance survey responses and give the required reward
   * @apiName SaveResponses
   *
   * @apiParam {Number} patients_peoplehub_id Redeemers unique ID on peoplehub.
   * @apiParam {String} patient_name Redeemers name.
   * @apiParam {String} attribute_type Either email address, phone number or card.
   * @apiParam {Mixed} attribute Value of the attribute to which the points are to be awarded on peoplehub.
   * @apiParam {Array} survey_instance_responses All the responses in an array of object where each object has keys: vendor_survey_question_id and response.
   *
   * @apiSuccess {String} message Success message string "ok".
   * @apiSuccess {Object} data
   * @apiSuccess {Number} data.id Unique vendor_survey_instance id.
   *
   * @apiSuccessExample Success-Response:
   *     HTTP/1.1 200 OK
   *     {
   *       "message" : "ok",
   *       "data" : {
   *                  "id" : 1
   *                }
   *     }
   */
    public function saveResponses(){

        if(!$this->request->is('post')){
             throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        if(!isset($this->request->data['user_id'])){
            throw new BadRequestException(__('MANDATORY_FIELD_MISSING', 'user_id'));
        }
        if(!isset($this->request->data['survey_instance_responses'])){
            throw new BadRequestException(__('MANDATORY_FIELD_MISSING','survey_instance_responses'));
        }else{
            foreach ($this->request->data['survey_instance_responses'] as $response) {
                if(!isset($response['reseller_program_survey_question_id'])){
                    throw new BadRequestException(__('MANDATORY_FIELD_MISSING','reseller program survey question id'));      
                }
                if(!isset($response['response'])){
                    throw new BadRequestException(__('MANDATORY_FIELD_MISSING','response'));
                }
            }
        }

        Log::write('debug', 'saving the responses for the survey');
        $resellerProgramId = $this->Auth->user('id');
        //$this->request->data['reseller_program_id'] = $resellerProgramId;

        $this->loadModel('ResellerProgramSurveys');
        $resellerProgramSurveyData = $this->ResellerProgramSurveys->findByResellerProgramId($resellerProgramId)->contain(['SurveyInstances', 'ResellerProgramSurveyQuestions'])->first();
        
        if(!$resellerProgramSurveyData){
            Log::write('debug', 'got bad data');
            throw new BadRequestException(__('RECORD_NOT_FOUND'));
        }

        $resellerProgramSurveyId = $resellerProgramSurveyData->id;
        $iteration = 1; 
        //find the number of iterations for the survey. If no surveys have been taken yet, $iteration=1. 
        if(count($resellerProgramSurveyData->survey_instances) > 0){
            $temp = new Collection($resellerProgramSurveyData->survey_instances);
            $temp = $temp->last();
            $temp = ($temp->toArray());
            $iteration = $temp['iteration'];
            Log::write('debug', 'number of iterations are more than 1');
        }
        //for creating a new survey instance and making entry in SurveyInstances.

        $surveyInstanceData = ['reseller_program_survey_id' => $resellerProgramSurveyId, 'user_id' => $this->request->data['user_id'], 'iteration' => $iteration+1, 'survey_instance_responses' => $this->request->data['survey_instance_responses'], 'perfect_user' => 0];
        //pr($surveyInstanceData); die;

        
        $this->loadModel('SurveyInstances');
        $surveyInstance = $this->SurveyInstances->newEntity($surveyInstanceData, ['associated' => 'SurveyInstanceResponses']);
        //proceed only if entity has no errors.
        if($surveyInstance->errors()){
            Log::write('debug', 'found errors while preparing data to save survey instance');
            throw new InternalErrorException(__('ENTITY_INTERNAL_ERRORS'));
        }
        //if save attempt is successful, proceed to find out the rule that should be applied.
        $surveyInstances = $this->SurveyInstances->save($surveyInstance);
        //pr($surveyInstance); die;
        if(!$surveyInstances){
            Log::write('debug', 'survey instance was not saved even though entity reported no errors');
            throw new InternalErrorException(__('ENTITY_ERROR', 'vendor survey instance'));
        }
        Log::write('debug', 'survey instance saved successfully. now will go to set the rule');

        //Extract features everytime when a survey saved
        $data = $this->SurveyInstances->findByUserId($surveyInstanceData['user_id'])->contain(['ResellerProgramSurveys.ResellerPrograms.ResellerProgramFeatures.Features'])->last();
        //pr($data); die;
        $features = $data->reseller_program_survey->reseller_program->reseller_program_features;
        $collection = new Collection($features);
        $enabledfeatures = $collection->extract('feature')->toArray();
        //pr($enabledfeatures); die;
        $enabledMilestone = false;
        //check if milestone is feature  is enabled or not
        foreach ($enabledfeatures as $value) {
            if($value->name == 'milestone'){
                $enabledMilestone = true;
            }
        }

                $surveyStartDate = NULL;
                $resellerProgramMilestones = NULL;
                //pr($enabledMilestone); die;
                //If feature is enabled, make an entry in UserMilestones.
                if($enabledMilestone == true){
                    //pr('i m here'); die;
                $this->loadModel('ResellerProgramMilestones');
                $resellerProgramMilestones = $this->ResellerProgramMilestones->findByResellerProgramId($resellerProgramId)->contain(['MilestoneLevels.MilestoneLevelRewards', 'MilestoneLevels.MilestoneLevelRules', 'MilestoneLevels.MilestoneLevelAwards' =>                                          function($x) use($surveyInstances){
                                                      return $x->where(['user_id' => $surveyInstances['user_id']]);
                                                    }]
                                                  )->last();
                $resellerprogId = $data->reseller_program_survey->reseller_program_id;
                $resellerProgramMilestoneId = $this->ResellerProgramMilestones->findByResellerProgramId($resellerprogId)->extract('id')->toArray();
                $usermilestoneData= ['reseller_program_milestone_id' => $resellerProgramMilestoneId[0], 'user_id' => $surveyInstances['user_id'], 'start_date' => $surveyInstances->created, 'end_date' => NULL];
                //pr($usermilestoneData); die;

                $this->loadModel('UserMilestonePrograms');
                //check if user already exists.
                $user = $this->UserMilestonePrograms->findByUserId($surveyInstances['user_id'])->last();
                //pr($user); die;
                //save a user only if it does not exist.
                //pr($user->end_date); die;
                if(!isset($user) || empty($user) || $user->end_date != NULL)
                {
                    // pr('fghj'); die;
                    $surveyStartDate = $surveyInstance->created;
                    $userMilestonePrograms = $this->UserMilestonePrograms->newEntity($usermilestoneData);
                    $userMilestonePrograms = $this->UserMilestonePrograms->save($userMilestonePrograms);
                    //pr($userMilestonePrograms); die;
                } else{
                // pr(' i m here '); die;
                    $this->loadModel('UserMilestonePrograms');
                    $userMilestoneProgramId = $this->UserMilestonePrograms->findByUserId($surveyInstanceData['user_id'])->last(); 
                    $surveyStartDate = $userMilestoneProgramId['start_date'];
                    //  where  for enddate ==null
                    // pr($surveyStartDate); die;
                    $milestoneDuration = $this->ResellerProgramMilestones->findByResellerProgramId($resellerprogId)->extract('duration')->toArray();
                   // pr($milestoneDuration); die;
                    $surveys = $this->SurveyInstances->findByUserId($surveyInstanceData['user_id'])->where(['created >='=>$surveyStartDate])->all();
                    // pr($surveys); die;
                    $noOfSurveys = count($surveys);
                    //pr($noOfSurveys); die;
                    // Check if milestone duration is completed
                    if(($milestoneDuration[0] == $noOfSurveys) && ($resellerProgramMilestones->is_limited ==1)){
                        //pr('i m here'); die;
                        
                        $usermilestoneData = ['end_date'=>$data->created];
                        $userMilestonePrograms = $this->UserMilestonePrograms->patchEntity($userMilestoneProgramId, $usermilestoneData);
                        // pr($userMilestoneProgramId); die;
                        $userMilestonePrograms = $this->UserMilestonePrograms->save($userMilestonePrograms);
                        //pr($userMilestonePrograms); die;
                    }
                //Log::write('debug', 'found errors while preparing data to save survey instance');
                // throw new BadRequestException(__('User already exist with this program'));
                }

            }else{
                //pr('i m here'); die;
                $this->loadModel('UserMilestonePrograms');
                $userMilestoneProgramId = $this->UserMilestonePrograms->findByUserId($surveyInstanceData['user_id'])->last();
                $surveyStartDate = $userMilestoneProgramId->start_date;
                //pr($userMilestoneProgramId); die;
                if($userMilestoneProgramId) {
                 $usermilestoneData = ['end_date'=>$data->created];
                 $userMilestonePrograms = $this->UserMilestonePrograms->patchEntity($userMilestoneProgramId, $usermilestoneData);
                 $userMilestonePrograms = $this->UserMilestonePrograms->save($userMilestonePrograms);
                } else  {
                   throw new BadRequestException(__('Milestone feature is disabled for this user'));  
                }

            }
            

//************************************************* set rule*************************************
        $responseOfSetRule = $this->_setRule();
        if(!$responseOfSetRule){
            Log::write('debug', 'back from set rule.. some error occured');
            throw new InternalErrorException(__('BAD_REQUEST'));
        }

        $rule = $responseOfSetRule['rule'];
        // $isMilestoneEnabled = $responseOfSetRule['isMilestoneEnabled'];
        Log::write('debug', 'back from set rule.. no error found and proceeding to awardPointsForSurvey');


        //In case of milestone, first calculate award points for survey and then make entry in survey. If after survey is complete and responses saved, the perfect user count equals any milestone level rule that hasn't yet been awarded to that patient, give milestone reward. 
        $responseOfAwardPointsForSurvey = $this->_awardPointsForSurvey($resellerProgramSurveyData->reseller_program_survey_questions, $this->request->data['survey_instance_responses'], $surveyInstance->id, $this->request->data['user_id'], $resellerProgramSurveyId, $rule);

        if(!$responseOfAwardPointsForSurvey){
            Log::write('debug', 'back form awardPointsForSurvey..no response from the award point method');
            throw new InternalErrorException(__('BAD_REQUEST'));
        }

        // $peoplehubTransactionId = $responseOfAwardPointsForSurvey['peoplehubTransactionId'];
        $points = $responseOfAwardPointsForSurvey['points'];
         if($enabledMilestone == true){
             Log::write('debug', 'going to go over to _awardPointsForMilestone now');
             $responseFromMilestoneAwards = $this->_awardPointsForMilestone($this->request->data['user_id'], $resellerProgramSurveyId, $points, $surveyStartDate, $resellerProgramMilestones);
             // pr($surveyStartDate); die;
             if($responseFromMilestoneAwards){
                 $response = ['message' => 'Ok', 'data' => ['id' => $surveyInstance->id]];
                 $this->set('response', $response);
                 Log::write('debug', 'back from awardPointsForMilestone. points should be awarded for Milestone');
                 Log::write('debug', 'bbye from this function surveyAwards');
             }else{
                 Log::write('debug', 'awardPointsForMilestone returned an impossible condition of false');
                 throw new InternalErrorException(__('BAD_REQUEST'));
             }
         }else{
              $response = ['message' => 'Ok', 'data' => ['id' => $surveyInstance->id]];
                $this->set('response', $response);

         }
        // $response = ['message' => 'Ok', 'data' => ['id' => $surveyInstance->id]];
        //         $this->set('response', $response);
           
        $this->set('_serialize', ['response']);
    } 

    /**
    *
    *
    *
    */
    private function _setRule(){
        // $this->loadModel('ResellerProgramFeatures');
        $this->loadModel('ResellerProgramSurveys');
                    Log::write('debug', 'welcome to set rule');
        $resellerProgramId = $this->Auth->user('id');
        // $resellerProgramId = $resellerData['reseller_program_id'];
        $surveyType = $this->ResellerProgramSurveys->findByResellerProgramId($resellerProgramId)->where(['survey_type'=> 'perfect'])->all();
        // $checkMilestoneFeature = $this->ResellerProgramFeatures->findByResellerProgramId($resellerProgramId)->where(['feature_id'=>2])->all();

        // $isMilestoneEnabled = FALSE;
        // if($checkMilestoneFeature){
        //     $isMilestoneEnabled = TRUE;
        //         Log::write('debug', 'milestone is enabled');
        // }

        foreach ($surveyType as $value) {
            if($value){
              $rule = 'perfectUser'; 
              Log::write('debug', 'rule is perfectPatient'); 
            }else {
               $rule = 'perQuestion';
               Log::write('debug', 'rule is perQUestion');
            }
        }

        Log::write('debug', 'bbye now from setRule');
        return ['rule' => $rule];   
    }


    /**
    *
    *
    *
    */

    private function _awardPointsForSurvey($quesData, $responseData, $surveyInstId, $userId, $resellerProgramSurveyId, $rule){

        Log::write('debug', 'welcome to AwardPointForSurvey');
        $pointsToAward = 0;
        $questionsAnswered = 0;
            Log::write('debug', 'will start calculating totalpoints to award');        
        foreach ($responseData as $response){
            // pr($response);
            if($response['response'] == true) {
                $questionsAnswered++;
                $temp = new Collection($quesData);
                 //Calculation of points for a response
                 $temp = $temp->reduce(function($pointsOfQues, $valueOfQuesData) use($response){
                     if($valueOfQuesData->id == $response['reseller_program_survey_question_id'] && $response['response'] == true){
                         return $pointsOfQues+$valueOfQuesData->points;
                     }
                     return $pointsOfQues;
                 }, 0);
                $pointsToAward = $pointsToAward+$temp; 
            } 
        }
            Log::write('debug', 'totalpoints to award have been calculated');
        $perfectUser = 0;
        if(count($quesData) == $questionsAnswered){
            $perfectUser = 1;
        }
                    Log::write('debug', 'just figured out with the perfectUser is true or not for the survey');
        //check in vendorSettings if points are to be awarded per questions, per perfect complaince survey or per milestone level.
        //if rule is to awardPoints only when a survey has perfect responses.
        if($rule == 'perfectUser' && !$perfectUser){
            $pointsToAward = 0;    
        }

                    Log::write('debug', 'Now i know if i have to award points or not based on the last step');

        // pr('$perfectUser '.$perfectUser.'and points are '.$pointsToAward);
                                Log::write('debug', 'Now handing control to AwardPoints function');
        $response = $this->_awardPoints($pointsToAward, $surveyInstId, $perfectUser, $userId, $resellerProgramSurveyId, $rule);
                    Log::write('debug', 'back from AwardPoints function.. will send response back to saveResponses function');
        if($response){
            Log::write('debug', 'bbye from function _awardPointsForSurvey');
            return true;
        } else{
                        Log::write('debug', 'Some problem... couldnt send response back to saveResponses');
            throw new InternalErrorException(__('in _awardPointsForSurvey'));
        }
    }


   
    /**
    *
    *
    *
    */
    private function _awardPoints($points, $surveyInstId = null, $perfectUser=null, $userId, $resellerProgramSurveyId, $rule){
        // echo 'in _awardPoints'; pr($rule); die;
                    Log::write('debug', 'welcome to AwardPoints');
        Log::write('debug', 'now we are going to over to surveyAwards');        
        
        $response = $this->_surveyAwards($surveyInstId, $points, $perfectUser, $userId, $resellerProgramSurveyId, $rule);
        Log::write('debug', 'back from surveyAwards.. hope everything worked out fine');        

        if($response){
            Log::write('debug', 'bbye from this function _awardPoints');
            return true;
        } else{
            Log::write('debug', 'some error occured in surveyAwards');        
            throw new InternalErrorException(__('in _awardPoints'));
        }        
    }

    /**
    *
    *
    *
    */
    private function _surveyAwards($surveyInstId, $points, $perfectUser, $userId, $resellerProgramSurveyId, $rule){
        // pr($perfectUser);
        Log::write('debug', 'welcome to surveyAwards');        
        $surveyAwardData = ['survey_instance_id' => $surveyInstId, 'user_id' => $userId, 'points' => $points, 'bountee_transaction_id' => null];

        $resellerProgramSurveyData = ['perfect_user' => $perfectUser];
        
        $this->loadModel('SurveyInstances');
        Log::write('debug', 'we will now update the survey instance based on whether the survey was perfect or not');
        $resellerProgramSurvey = $this->SurveyInstances->get($surveyInstId);
        $resellerProgramSurvey = $this->SurveyInstances->patchEntity($resellerProgramSurvey, $resellerProgramSurveyData);
        
        $statusOfSurveyInstances = $this->SurveyInstances->save($resellerProgramSurvey); 
        if(!$statusOfSurveyInstances){
            Log::write('debug', 'survey instance did not update ');            
           throw new InternalErrorException(__('ENTITY_ERROR', 'vendor survey instance'));
        }
        Log::write('debug', 'survey instance updated');
        
        $this->loadModel('SurveyAwards');
        $surveyAward = $this->SurveyAwards->newEntity($surveyAwardData);
        
        if($surveyAward->errors()){
            Log::write('debug', 'survey award entity has errors');
            throw new InternalErrorException(__('ENTITY_INTERNAL_ERRORS'.'in survey award'));
        }
        // pr($surveyAward); die;
        $surveyAward = $this->SurveyAwards->save($surveyAward);
        // pr($surveyAward);
        if(!$surveyAward){
            Log::write('debug', 'survey award table couldnt save data');
            throw new InternalErrorException(__('ENTITY_ERROR', 'survey awards'));
        }

        return ['user_id' => $userId, 'points' => $points];
        echo $rule=='milestone' ? 'milestone' : 'not milestone'; die;
        if(!($rule == 'milestone' && $perfectUser)){
            Log::write('debug', 'found that milestone rule is not true and the user was perfect.');
            Log::write('debug', 'bbye surveyAwards');
          return true;
        }
    }


     /**
    *
    *
    *
    */
     private function _awardPointsForMilestone($userId, $resellerProgramSurveyId, $points, $surveyStartDate, $resellerProgramMilestones){
        Log::write('debug', 'welcome to awardPointsForMilestone');

        $this->loadModel('ResellerProgramSurveys');
        
        $resellerProgramId = $this->Auth->user('id');

        $resellerProgramSurveysData = $this->ResellerProgramSurveys->findByResellerProgramId($resellerProgramId)                                                       ->contain(['SurveyInstances' =>                                                           function($x) use($surveyStartDate){
                                                                    return $x->where(['perfect_user' => 1], ['created >='=> $surveyStartDate]);
                                                                    //TODO: a where condition to fetch the surveys taken after created of UserMilestone
                                                                    }])->first();
        //pr($resellerProgramSurveysData); die;
        
        // pr($resellerProgramMilestones); die;
         $perfectUserSurveyInstances = $resellerProgramSurveysData->survey_instances;
        // pr($perfectUserSurveyInstances);
         if(!isset($resellerProgramMilestones->milestone_levels)){
            Log::write('debug', 'no reseller program milestone found');
            Log::write('debug', 'bbye from this function');

             return true;
         }

         $milestoneLevelsData = $resellerProgramMilestones->milestone_levels;
         //check the number of perfect user surveys. 
         //TODO: Don't consider any perfect surveys prior to the creation of milestone program.
         
         $previousPerfectUserCount = count($perfectUserSurveyInstances);
         //Initializing $rewards
         $rewards = NULL;
         foreach ($milestoneLevelsData as $milestoneLevel) {
            if((empty($milestoneLevel->milestone_level_awards) && $resellerProgramMilestones->is_limited == 1) || $resellerProgramMilestones->is_limited == 0){
              if(empty($milestoneLevel->milestone_level_rules)){
                Log::write('debug', 'no rule set for the milestone level');
                throw new BadRequestException(__('Set the rule for milestone level '.$milestoneLevel->name));
              }
                $this->loadModel('UserMilestonePrograms');
                //$endDate = $this->UserMilestonePrograms;
              if($resellerProgramMilestones->is_limited == 1 && $milestoneLevel->milestone_level_rules[0]->level_rule == $previousPerfectUserCount && empty($milestoneLevel->milestone_level_awards)){

                                Log::write('debug', 'islimited and perfect user count is equal');
                 $levelAcheived = $milestoneLevel->id;
                 $rewards = $milestoneLevel->milestone_level_rewards;          
                 //pr($rewards); die;
                 break;
              }else{
                Log::write('debug', 'this is either not limited or perfect user count is not equal to rule');
              }

               
                if($resellerProgramMilestones->is_limited == 0 && (($previousPerfectUserCount % $milestoneLevel->milestone_level_rules[0]->level_rule) == 0 && $previousPerfectUserCount != 0))
                {
                Log::write('debug', 'this is unlimited term and perfect user count is equal');

                   $levelAcheived = $milestoneLevel->id;
                   $rewards = $milestoneLevel->milestone_level_rewards;
                   break;
                }else{
                    Log::write('debug', 'this is either not unlimited term or perfect patient count is not equal to rule');

                }
            } else {
                Log::write('debug', 'this is either not fixed term or perfect patient count is not equal');
            }
          }

            Log::write('debug', 'rewards found.. see json'.json_encode($rewards));

            Log::write('debug', 'we will save milestone awards now');

         if($rewards){
            Log::write('debug', 'ready to give award');
            $milestoneLevelAwardData = [];
            foreach ($rewards as $key => $value) {
               $milestoneLevelAwardData[$key]['milestone_level_id'] = $value['milestone_level_id'];
               $milestoneLevelAwardData[$key]['user_id'] = $userId;
               $milestoneLevelAwardData[$key]['points'] = $value['points'];
               $milestoneLevelAwardData[$key]['amount'] = $value['amount'];
            }
               $this->loadModel('MilestoneLevelAwards');
            $milestoneLevelAwards = $this->MilestoneLevelAwards->newEntities($milestoneLevelAwardData);
              Log::write('debug', 'attempting to save the milestone Award now. Here is the entity'.json_encode($milestoneLevelAwards));
              if($this->MilestoneLevelAwards->saveMany($milestoneLevelAwards)){
                // pr($milestoneLevelAwards); die;
                Log::write('debug', "the following milestoneLevelAwards were given".json_encode($milestoneLevelAwards));
              } else{
                Log::write('debug', "ENTITY_ERROR",'milestone awards');
              }
         }else{
            Log::write('debug', 'there are no rewards');

         }
         Log::write('debug', 'Milestone awarded... bbye this function - _awardPointsForMilestone');
         return true;
     }

   
}
