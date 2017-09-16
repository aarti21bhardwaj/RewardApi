<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResellerProgramSurveysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResellerProgramSurveysTable Test Case
 */
class ResellerProgramSurveysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResellerProgramSurveysTable
     */
    public $ResellerProgramSurveys;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reseller_program_surveys',
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
        'app.users',
        'app.manual_awards',
        'app.promotion_awards',
        'app.promotions',
        'app.tier_awards',
        'app.tiers',
        'app.tier_perks',
        'app.user_tiers',
        'app.old_passwords',
        'app.reseller_program_features',
        'app.surveys',
        'app.survey_questions',
        'app.questions',
        'app.question_types',
        'app.reseller_program_survey_questions',
        'app.survey_instances',
        'app.survey_awards',
        'app.bountee_transactions',
        'app.survey_instance_responses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResellerProgramSurveys') ? [] : ['className' => 'App\Model\Table\ResellerProgramSurveysTable'];
        $this->ResellerProgramSurveys = TableRegistry::get('ResellerProgramSurveys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResellerProgramSurveys);

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
