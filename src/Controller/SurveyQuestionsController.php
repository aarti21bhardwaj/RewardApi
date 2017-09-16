<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SurveyQuestions Controller
 *
 * @property \App\Model\Table\SurveyQuestionsTable $SurveyQuestions
 */
class SurveyQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Surveys', 'Questions']
        ];
        $surveyQuestions = $this->paginate($this->SurveyQuestions);

        $this->set(compact('surveyQuestions'));
        $this->set('_serialize', ['surveyQuestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Survey Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $surveyQuestion = $this->SurveyQuestions->get($id, [
            'contain' => ['Surveys', 'Questions', 'ResellerProgramSurveyQuestions']
        ]);

        $this->set('surveyQuestion', $surveyQuestion);
        $this->set('_serialize', ['surveyQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $surveyQuestion = $this->SurveyQuestions->newEntity();
        if ($this->request->is('post')) {
            $surveyQuestion = $this->SurveyQuestions->patchEntity($surveyQuestion, $this->request->data);
            if ($this->SurveyQuestions->save($surveyQuestion)) {
                $this->Flash->success(__('The survey question has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The survey question could not be saved. Please, try again.'));
            }
        }
        $surveys = $this->SurveyQuestions->Surveys->find('list', ['limit' => 200]);
        $questions = $this->SurveyQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('surveyQuestion', 'surveys', 'questions'));
        $this->set('_serialize', ['surveyQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Survey Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $surveyQuestion = $this->SurveyQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $surveyQuestion = $this->SurveyQuestions->patchEntity($surveyQuestion, $this->request->data);
            if ($this->SurveyQuestions->save($surveyQuestion)) {
                $this->Flash->success(__('The survey question has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The survey question could not be saved. Please, try again.'));
            }
        }
        $surveys = $this->SurveyQuestions->Surveys->find('list', ['limit' => 200]);
        $questions = $this->SurveyQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('surveyQuestion', 'surveys', 'questions'));
        $this->set('_serialize', ['surveyQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Survey Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $surveyQuestion = $this->SurveyQuestions->get($id);
        if ($this->SurveyQuestions->delete($surveyQuestion)) {
            $this->Flash->success(__('The survey question has been deleted.'));
        } else {
            $this->Flash->error(__('The survey question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
