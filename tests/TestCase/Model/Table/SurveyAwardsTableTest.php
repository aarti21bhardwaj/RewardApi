<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SurveyAwardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SurveyAwardsTable Test Case
 */
class SurveyAwardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SurveyAwardsTable
     */
    public $SurveyAwards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.survey_awards',
        'app.survey_instances',
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
        'app.bountee_transactions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SurveyAwards') ? [] : ['className' => 'App\Model\Table\SurveyAwardsTable'];
        $this->SurveyAwards = TableRegistry::get('SurveyAwards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SurveyAwards);

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
