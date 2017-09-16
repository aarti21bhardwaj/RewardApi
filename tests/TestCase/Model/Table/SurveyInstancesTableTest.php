<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SurveyInstancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SurveyInstancesTable Test Case
 */
class SurveyInstancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SurveyInstancesTable
     */
    public $SurveyInstances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.survey_instances',
        'app.reseller_program_surveys',
        'app.users',
        'app.reseller_programs',
        'app.resellers',
        'app.reseller_plans',
        'app.plans',
        'app.plan_features',
        'app.features',
        'app.plan_settings',
        'app.limit_elements',
        'app.staffs',
        'app.roles',
        'app.old_passwords',
        'app.reseller_program_features',
        'app.manual_awards',
        'app.promotion_awards',
        'app.promotions',
        'app.tier_awards',
        'app.tiers',
        'app.tier_perks',
        'app.user_tiers',
        'app.survey_awards',
        'app.bountee_transactions',
        'app.survey_instance_responses',
        'app.reseller_program_survey_questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SurveyInstances') ? [] : ['className' => 'App\Model\Table\SurveyInstancesTable'];
        $this->SurveyInstances = TableRegistry::get('SurveyInstances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SurveyInstances);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
