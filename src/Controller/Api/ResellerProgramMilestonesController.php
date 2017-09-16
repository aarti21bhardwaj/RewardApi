<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\InternalErrorException;

/**
* Reseller Program Milestones Controller
*
* @property \App\Model\Table\ResellerProgramMilestonesTable $resellerProgramMilestone
*/
class ResellerProgramMilestonesController extends ApiController
{
    public function addmilestone()
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException(__('BAD_REQUEST'));
        }

        $resellerProgramId = $this->Auth->user('id');
        $this->request->data['reseller_program_id'] = $resellerProgramId;

        $resellerProgramMilestone = $this->ResellerProgramMilestones->newEntity();

        $resellerProgramMilestone = $this->ResellerProgramMilestones->patchEntity($resellerProgramMilestone, $this->request->data, ['associated' => ['MilestoneLevels', 'MilestoneLevels.MilestoneLevelRewards', 'MilestoneLevels.MilestoneLevelRules']]);
        //pr($resellerProgramMilestone); die;

        if($this->ResellerProgramMilestones->save($resellerProgramMilestone, ['associated' => ['MilestoneLevels', 'MilestoneLevels.MilestoneLevelRewards', 'MilestoneLevels.MilestoneLevelRules']])){

            $response['message'] = __('ENTITY_SAVED');
            $this->set('response', ['status' => "OK"]);
            $this->set('_serialize', ['response']);

          } else {
            pr($resellerProgramMilestone->errors()); die;
            throw new InternalErrorException(__('Internal Error'));
          }
      }
}