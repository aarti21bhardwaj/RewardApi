<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * ResellerPrograms Controller
 *
 * @property \App\Model\Table\ResellerProgramsTable $ResellerPrograms
 * @property \Alaxos\Controller\Component\FilterComponent $Filter
 */
class ResellerProgramsController extends AppController
{

    /**
    * Index method
    *
    * @return void
    */
    public function index()
    {
        $this->loadModel('ResellerPlans');
        $loggedinUser = $this->Auth->user();
        
        $features = $this->ResellerPlans->findByResellerId($this->Auth->user('reseller_id'))->contain([ 'Plans.PlanFeatures.Features'])->find('all')->first();
        if($features){
            $features = $features->plan->plan_features;
            $collection = new Collection($features);
            $features = $collection->extract('feature.name')->toArray();
           
            if($loggedinUser['role_id'] == 1) {
                $this->paginate = [
                                'contain' => ['Resellers']
                              ]; 
            } else {
               $this->paginate = [
                                'contain' => ['Resellers'],
                                'conditions' => ['reseller_id' => $this->Auth->user('reseller_id')]
                              ];  
                    
            }
        }
        $resellerPrograms = $this->paginate($this->ResellerPrograms); 
        $this->set(compact('resellerPrograms', 'features', 'resellers'));
        $this->set('_serialize', ['resellerPrograms']);

    }

    /**
     * View method
     *
     * @param string|null $id Reseller Program id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resellerProgram = $this->ResellerPrograms->get($id, [
            'contain' => ['Resellers', 'ResellerProgramFeatures.Features']
            ]);
        $this->set('resellerProgram', $resellerProgram);
        $this->set('_serialize', ['resellerProgram']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    { 
        $loggedinUser = $this->Auth->user();
        $this->loadModel('Features');
        $this->loadModel('ResellerPlans');

        $resellerProgram = $this->ResellerPrograms->newEntity();
        if ($this->request->is('post')) {
            $postFeatures = $this->request->data['features'];
            foreach ($postFeatures as $postFeature) {
                $featureId = $this->Features->find('all')->where(['name' => $postFeature])->first()->id;
                $this->request->data['reseller_program_features'][] = ['feature_id' => $featureId, 'reseller_id'=> $loggedinUser['reseller_id']];
            }

            $resellerProgram = $this->ResellerPrograms->patchEntity($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']]);
            // pr($resellerProgram); die;

            if ($this->ResellerPrograms->save($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']])) {
                $this->Flash->success('the reseller program has been saved');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('the reseller program could not be saved. Please, try again.');
            }
        }

        $features = $this->ResellerPlans->findByResellerId($this->Auth->user('reseller_id'))->contain([ 'Plans.PlanFeatures.Features'])->find('all')->first()->plan->plan_features;
        $collection = new Collection($features);
        $features = $collection->extract('feature.name')->toArray();

        $resellers = $this->ResellerPrograms->Resellers->find('list', ['limit' => 200]);
        
        $this->set(compact('resellerProgram', 'resellers', 'features'));
        $this->set('_serialize', ['resellerProgram']);
        $this->set('loggedinUser', $loggedinUser);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reseller Program id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
       $loggedinUser = $this->Auth->user();
       $this->loadModel('Features');
       $this->loadModel('ResellerPlans');
       $resellerProgram = $this->ResellerPrograms->get($id, [
        'contain' => ['ResellerProgramFeatures.Features']
        ]);


       $collection = new Collection($resellerProgram->reseller_program_features);
        // pr($collection->toArray()); die;
       $checkedfeatures = $collection->extract('feature')->toArray();
       
       
       if ($this->request->is(['patch', 'post', 'put'])) {

        $postFeatures = $this->request->data['features'];
        foreach ($postFeatures as $postFeature) {
            $featureId = $this->Features->find('all')->where(['name' => $postFeature])->first()->id;
            $this->request->data['reseller_program_features'][] = ['feature_id' => $featureId, 'reseller_id'=> $loggedinUser['reseller_id']];
        }

        $resellerProgram = $this->ResellerPrograms->patchEntity($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']]);

        if ($this->ResellerPrograms->save($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']])) {
            $this->Flash->success('the reseller program has been saved');
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('the reseller program could not be saved. Please, try again.');
        }
    }

    $features = $this->ResellerPlans->findByResellerId($this->Auth->user('reseller_id'))->contain([ 'Plans.PlanFeatures.Features'])->find('all')->first()->plan->plan_features;
    $collection = new Collection($features);
    $features = $collection->extract('feature.name')->toArray();

    $resellers = $this->ResellerPrograms->Resellers->find('list', ['limit' => 200]);
    

    $this->set(compact('resellerProgram', 'resellers', 'features', 'checkedfeatures'));
    $this->set('_serialize', ['resellerProgram']);
    $this->set('loggedinUser', $loggedinUser);
}

    /**
     * Delete method
     *
     * @param string|null $id Reseller Program id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
   
    /**
     * Delete all method
     */
  public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resellerProgram = $this->ResellerPrograms->get($id);
        if ($this->ResellerPrograms->delete($resellerProgram)) {
            $this->Flash->success(__('The program has been deleted.'));
        } else {
            $this->Flash->error(__('The program could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
