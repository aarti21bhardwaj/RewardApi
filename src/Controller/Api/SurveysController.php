<?php
namespace App\Controller\Api;

    use App\Controller\Api\ApiController;
    use Cake\Network\Exception\MethodNotAllowedException;
    use Cake\Network\Exception\BadRequestException;

    /**
     * Surveys Controller
     *
     */
    class SurveysController extends ApiController
    {

     public function initialize()
     {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }

//***************************************** Surveys (crud) *****************************************************
     public function add()
    {
        // pr($this->request->data); die("blabla");
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $survey = $this->Surveys->newEntity();

       $survey = $this->Surveys->patchEntity($survey, $this->request->data);
        if ($this->Surveys->save($survey)) {

            $this->set('survey', $survey);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$survey->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }  

        public function edit($id = null)
        {
        $survey = $this->Surveys->find('all')->where(['id'=>$id])->first();
        if(!$survey){
           throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }
        if ($this->request->is('put')) {
            $survey = $this->Surveys->patchEntity($survey, $this->request->data);
            if ($this->Surveys->save($survey)) {
               $this->set('survey', $survey);
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

//***************************************** Questions (crud) **************************************************
    public function add_questions()
    {
       $this->loadModel('Questions');
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $question=$this->request->data;
        $question = $this->Questions->newEntity($question);
        if ($this->Questions->save($question)) {
            $this->set('question', $question);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$question->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }  

    public function edit_questions($id = null)
    {
        $this->loadModel('Questions');
        if (!$this->request->is('put')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $question=$this->request->data;
        $question = $this->Questions->newEntity($question);
        if ($this->Questions->save($question)) {
            $this->set('question', $question);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
    }

//***************************************** Survey Questions (crud)********************************************
    public function add_survey_question()
    {
        $this->loadModel('SurveyQuestions');
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $surveyQuestion=$this->request->data;
        $surveyQuestion = $this->SurveyQuestions->newEntities($surveyQuestion);
        if ($this->SurveyQuestions->saveMany($surveyQuestion)) {
            $this->set('surveyQuestion', $surveyQuestion);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
    }  

    public function edit_survey_question($id = null)
    {   
        $this->loadModel('SurveyQuestions');
        $surveyQuestion = $this->SurveyQuestions->find('all')->where(['id'=>$id])->first();
        if(!$surveyQuestion){
           throw new NotFoundException(__('RECORD_NOT_FOUND'));
        }
        if ($this->request->is('put')) {
            $surveyQuestion = $this->SurveyQuestions->patchEntity($surveyQuestion, $this->request->data);
            if ($this->SurveyQuestions->save($surveyQuestion)) {
               $this->set('surveyQuestion', $surveyQuestion);
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

//***************************************** Reseller Program Surveys (crud) ***********************************
    public function add_reseller_program_survey()
    {
       $this->loadModel('ResellerProgramSurveys');
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        
        $resellerProgramId = $this->Auth->user('id');
        $this->request->data['reseller_program_id'] = $resellerProgramId;
        $resellerProgramSurveys=$this->request->data;

        $resellerProgramSurveys = $this->ResellerProgramSurveys->newEntity($resellerProgramSurveys);
        //pr($resellerProgramSurveys); die;
        if ($this->ResellerProgramSurveys->save($resellerProgramSurveys)) {
            $this->set('resellerProgramSurveys', $resellerProgramSurveys);
            $this->set('response', ['status' => "OK"]);
        } else {
            //pr($resellerProgramSurveys->errors()); die;
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$resellerProgramSurveys->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }  

    public function edit_reseller_program_survey($id = null)
    {
        $this->loadModel('ResellerProgramSurveys');
        if (!$this->request->is('put')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $resellerProgramSurveys=$this->request->data;
        $resellerProgramSurveys = $this->ResellerProgramSurveys->newEntity($resellerProgramSurveys);
        if ($this->ResellerProgramSurveys->save($resellerProgramSurveys)) {
            $this->set('resellerProgramSurveys', $resellerProgramSurveys);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
    }

    //***************************************** Reseller Program Survey Questions (crud) **********************
    public function add_reseller_program_survey_question()
    {
       $this->loadModel('ResellerProgramSurveyQuestions');
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $resellerProgramSurveyQuestion=$this->request->data;
        $resellerProgramSurveyQuestion = $this->ResellerProgramSurveyQuestions->newEntity($resellerProgramSurveyQuestion);
        if ($this->ResellerProgramSurveyQuestions->save($resellerProgramSurveyQuestion)) {
            $this->set('resellerProgramSurveyQuestion', $resellerProgramSurveyQuestion);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $data['data']['id']=$resellerProgramSurveyQuestion->id;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
        }  

    public function edit_reseller_program_survey_question($id = null)
    {
        $this->loadModel('ResellerProgramSurveys');
        if (!$this->request->is('put')) {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $resellerProgramSurveyQuestion=$this->request->data;
        $resellerProgramSurveyQuestion = $this->ResellerProgramSurveyQuestions->newEntity($resellerProgramSurveyQuestion);
        if ($this->ResellerProgramSurveyQuestions->save($resellerProgramSurveyQuestion)) {
            $this->set('resellerProgramSurveyQuestion', $resellerProgramSurveyQuestion);
            $this->set('response', ['status' => "OK"]);
        } else {
            throw new InternalErrorException(__('Internal Error'));
        }
                $data =array();
                $data['status']=true;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
    }

}

