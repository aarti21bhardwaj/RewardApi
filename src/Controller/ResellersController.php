<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Controller;
use Cake\Collection\Collection;
use Cake\I18n\Date;
use Cake\Core\Configure;
use Integrateideas\Invoice\Controller\Component;
use Integrateideas\Invoice\Controller\AuthorizeNetProfilesController as Invoice;
/**
 * Resellers Controller
 *
 * @property \App\Model\Table\ResellersTable $Resellers
 */
class ResellersController extends AppController
{

    public function initialize(){
        parent::initialize();
        // $this->loadComponent('Auth');
        // $this->Auth->config('authorize', ['Controller']);
        $this->loadComponent('Integrateideas/Invoice.BillGenerate');
     }
    public function index()
    {   

        $resellers = $this->paginate($this->Resellers);
        $this->set(compact('resellers'));
        $this->set('_serialize', ['resellers']);
    }
    /**
     * View method
     *
     * @param string|null $id Reseller id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reseller = $this->Resellers->get($id, [
            'contain' => ['ResellerPrograms', 'Staffs']
        ]);
        $this->set('reseller', $reseller);
        $this->set('_serialize', ['reseller']);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $this->_resellerBilling();
        $reseller = $this->Resellers->newEntity();
        $plans = $this->Resellers->ResellerPlans->Plans->find()->all()->combine('id', 'name');
        $pricingRule = $this->Resellers->ResellerPricingRules->PricingRules->find()->all()->combine('id', 'name');
        // pr($pricingRule); die;

        if ($this->request->is('post')) {
             $this->loadModel('Roles');
        $this->request->data['reseller_plans'][] = ['plan_id' => $this->request->data['reseller_plans']['plan_id']];
        unset($this->request->data['reseller_plans']['plan_id']);
        $this->request->data['reseller_pricing_rules'][] = ['pricing_rule_id' => $this->request->data['reseller_pricing_rules']['pricing_rule_id']];

        unset($this->request->data['reseller_pricing_rules']['pricing_rule_id']);
        
        //User registered with Reseller will have the role Satff Admin
        $role=$this->Roles->findByName("staff_admin")->select(['id'])->first();
        
        $this->request->data['staffs'][0]= $this->request->data['user'];
        $this->request->data['staffs'][0]['status']= $this->request->data['status'];
        $this->request->data['staffs'][0]['role_id']=$role->id;
        $reseller = $this->Resellers->newEntity($this->request->data,['associated' => ['Staffs', 'ResellerPlans', 'ResellerPricingRules']]);
        $reseller = $this->Resellers->patchEntity($reseller, $this->request->data,['associated' => ['Staffs','ResellerPlans', 'ResellerPricingRules']]);
        // pr($reseller); die;
            $reseller = $this->Resellers->patchEntity($reseller, $this->request->data);
            if ($this->Resellers->save($reseller)) {
                $this->Flash->success(__('The reseller has been saved.'));
                $this->redirect(['action' => 'index']);
                return ;
            } else {
                $this->Flash->error(__('The reseller could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('reseller', 'plans', 'pricingRule'));
        $this->set('_serialize', ['reseller']);
        $this->set('plans', $plans);
    }
    /**
     * Edit method
     *
     * @param string|null $id Reseller id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reseller = $this->Resellers->findById($id)->contain(['Staffs'])->first();
        $plans = $this->Resellers->ResellerPlans->Plans->find()->all()->combine('id', 'name');
        $pricingRule = $this->Resellers->ResellerPricingRules->PricingRules->find()->all()->combine('id', 'name');

        //If old image is available, unlink the path(and delete the image) and and  upload image from "upload" folder in webroot.
        $oldImageName = $reseller->image_name;
        $path = Configure::read('ImageUpload.unlinkPathForVendorLogos');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $reseller = $this->Resellers->patchEntity($reseller, $this->request->data);
            if ($this->Resellers->save($reseller)) {

                $this->Flash->success(__('The reseller has been saved.'));
                return $this->redirect(['action' => 'index']);

            } else {
                $this->Flash->error(__('The reseller could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('reseller', 'plans', 'pricingRule'));
        $this->set('_serialize', ['reseller']);
    }
    /**
     * Delete method
     *
     * @param string|null $id Reseller id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reseller = $this->Resellers->get($id);
        if ($this->Resellers->delete($reseller)) {
            $this->Flash->success(__('The reseller has been deleted.'));
        } else {
            $this->Flash->error(__('The reseller could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    private function _resellerBilling()
    {
        $resellerData = $this->Resellers->ResellerPricingRules->findByResellerId($this->Auth->user('id'))->contain(['PricingRules'])->first();
        $resellerPricing = $resellerData->pricing_rule;
        $resellerProgram = $this->Resellers->ResellerPrograms->findByResellerId($this->Auth->user('id'))->select(['program_name', 'created'])->all()->toArray();
        $count = count($resellerProgram);
        $totaldays = new Date();
        $totaldays = date("t");
        $invoiceItem = [];
        $collection = new Collection($resellerProgram);
        $data = $collection->toArray();
        foreach ($data as $value1) {
            $date = new Date($value1->created);
            $day = date_format($date, 'd');
            $totalDay =  $totaldays - $day;
            $qty = ((1/$totaldays) * $totalDay);
            $qty = round($qty, 2);
            $qtySum = $qty + ((1/$totaldays) * $totalDay);
            $invoiceData[] = ['name' => $value1->program_name, 'quantity' => $qty ];
        }
        $this->loadModel('InvoiceItems');
        $this->InvoiceItems->addBehavior('Timestamp');
        $invoiceItem = $this->InvoiceItems->newEntities($invoiceData);
        $invoiceItem = $this->InvoiceItems->patchEntities($invoiceItem,$invoiceData);
        $invoiceItem = $this->InvoiceItems->saveMany($invoiceItem);
        // pr($invoiceItem); 
        switch($resellerPricing->name){
            case 'Fixed Rate':
                $data = $this->BillGenerate->fixedRate($qtySum);
                pr($data);
            break;

            case 'Overage Rate':
                $data = $this->BillGenerate->overageRate($qtySum);
                pr($data);
            break;

            case 'Bulk Rate':
                $data = $this->BillGenerate->bulkRate($qtySum);
                pr($data); 
            break;
        }
        $invoice = new Invoice;
        $invoice->generateInvoice($data);
    }
}