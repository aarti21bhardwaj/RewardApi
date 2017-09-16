<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PlanFeatures Controller
 *
 * @property \App\Model\Table\PlanFeaturesTable $PlanFeatures
 */
class PlanFeaturesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Plans', 'Features']
        ];
        $planFeatures = $this->paginate($this->PlanFeatures);

        $this->set(compact('planFeatures'));
        $this->set('_serialize', ['planFeatures']);
    }

    /**
     * View method
     *
     * @param string|null $id Plan Feature id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $planFeature = $this->PlanFeatures->get($id, [
            'contain' => ['Plans', 'Features']
        ]);

        $this->set('planFeature', $planFeature);
        $this->set('_serialize', ['planFeature']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $planFeature = $this->PlanFeatures->newEntity();
        if ($this->request->is('post')) {
            $planFeature = $this->PlanFeatures->patchEntity($planFeature, $this->request->data);
            if ($this->PlanFeatures->save($planFeature)) {
                $this->Flash->success(__('The plan feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The plan feature could not be saved. Please, try again.'));
            }
        }
        $plans = $this->PlanFeatures->Plans->find('list', ['limit' => 200]);
        $features = $this->PlanFeatures->Features->find('list', ['limit' => 200]);
        $this->set(compact('planFeature', 'plans', 'features'));
        $this->set('_serialize', ['planFeature']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Plan Feature id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $planFeature = $this->PlanFeatures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $planFeature = $this->PlanFeatures->patchEntity($planFeature, $this->request->data);
            if ($this->PlanFeatures->save($planFeature)) {
                $this->Flash->success(__('The plan feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The plan feature could not be saved. Please, try again.'));
            }
        }
        $plans = $this->PlanFeatures->Plans->find('list', ['limit' => 200]);
        $features = $this->PlanFeatures->Features->find('list', ['limit' => 200]);
        $this->set(compact('planFeature', 'plans', 'features'));
        $this->set('_serialize', ['planFeature']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Plan Feature id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $planFeature = $this->PlanFeatures->get($id);
        if ($this->PlanFeatures->delete($planFeature)) {
            $this->Flash->success(__('The plan feature has been deleted.'));
        } else {
            $this->Flash->error(__('The plan feature could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
