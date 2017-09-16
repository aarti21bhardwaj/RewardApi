<?php
namespace App\Controller\Reseller;

    use App\Controller\Reseller\ApiController;
    use Cake\Network\Exception\MethodNotAllowedException;
    use Cake\Network\Exception\BadRequestException;
    use Cake\Network\Exception\InternalErrorException;
    use Cake\Collection\Collection;

    /**
     * Legacy Rewards Controller
     *
     * @property \App\Model\Table\LegacyRewardsTable $legacyRewards
     */
    class ResellerProgramsController extends ApiController
    {

     public function initialize()
     {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }

    public function view($id = null)
    {

        if(!$this->request->is('get')){
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $this->loadModel('ResellerProgramFeatures');
        $features = $this->ResellerProgramFeatures->findByResellerProgramId($id)->contain(['Features'])->all();
        $collection = new Collection($features);
        $features = $collection->extract('feature.name')->toArray();
        $this->set(compact('features'));
        $this->set('_serialize', ['features']);
    }




    public function add()
    {

      if (!$this->request->is('post')) {
        throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
        $programId = $this->request->data['program-id'];
        $programname = $this->request->data['program_name'];
        if(!$programId){
            throw new BadRequestException(__('bad request'));
        }else{
            $this->loadModel('ResellerProgramFeatures');
            $features =$this->ResellerProgramFeatures->findByResellerProgramId($programId)->contain(['Features'])->all(); 
            $collection = new Collection($features);
            $features = $collection->extract('feature.id')->toArray();
            foreach ($features as $feature) {

            $this->request->data['reseller_program_features'][] = ['feature_id' => $feature, 'reseller_id'=> $this->Auth->user('reseller_id')];
            }
            $resellerProgram = $this->ResellerPrograms->newEntity();
            $this->request->data['reseller_id'] = $this->Auth->user('reseller_id');
            $resellerProgram = $this->ResellerPrograms->patchEntity($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']]);
            if ($this->ResellerPrograms->save($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']])) {
                return $this->redirect(['action' => 'view', $resellerProgram->id]);
            } else {

            }
        }
    }


     public function addResellerProgram()
    {

      if (!$this->request->is('post')) {
        throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }
            if(!$this->request->data['program_name']){
            throw new BadRequestException(__('Program name is missing'));
            }
            if(!$this->request->data['features']){
            throw new BadRequestException(__('Features are missing'));
            }

            $features = $this->request->data('features');
            // pr($features); die;
            foreach ($features as $feature) {

            $this->request->data['reseller_program_features'][] = ['feature_id' => $feature, 'reseller_id'=> $this->Auth->user('reseller_id')];
            }
            // pr($this->request->data); die;
            $this->request->data['reseller_id'] = $this->Auth->user('reseller_id');
            $this->request->data['staff_id'] = $this->Auth->user('id');
            // pr($this->request->data); die;
            $resellerProgram = $this->ResellerPrograms->newEntity();
            $resellerProgram = $this->ResellerPrograms->patchEntity($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']]);
            if ($this->ResellerPrograms->save($resellerProgram, $this->request->data, ['associated' => ['ResellerProgramFeatures']])) {
                $this->set('resellerProgram', $resellerProgram);
                $this->set('response', ['status' => "OK"]);
            } else {
                throw new InternalErrorException(__('Internal Error'));
            }
            
                $data =array();
                $data['status']=true;
                $this->set('response',$data);
                $this->set('_serialize', ['response']);
    }



    public function invoice()
    {
        $resellerProgram = $this->ResellerPrograms->find()->all();
        pr($resellerProgram); die;
    }      
}

