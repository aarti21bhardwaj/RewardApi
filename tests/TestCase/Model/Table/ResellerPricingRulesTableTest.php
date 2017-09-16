<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResellerPricingRulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResellerPricingRulesTable Test Case
 */
class ResellerPricingRulesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResellerPricingRulesTable
     */
    public $ResellerPricingRules;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reseller_pricing_rules',
        'app.resellers',
        'app.reseller_programs',
        'app.reseller_program_types',
        'app.promotions',
        'app.promotion_awards',
        'app.users',
        'app.manual_awards',
        'app.tier_awards',
        'app.tiers',
        'app.tier_perks',
        'app.user_tiers',
        'app.reseller_program_charges',
        'app.reseller_program_features',
        'app.features',
        'app.plan_features',
        'app.plans',
        'app.plan_settings',
        'app.limit_elements',
        'app.reseller_plans',
        'app.reseller_program_milestones',
        'app.milestone_levels',
        'app.milestone_level_awards',
        'app.milestone_level_rewards',
        'app.reward_types',
        'app.milestone_level_rules',
        'app.reseller_program_surveys',
        'app.surveys',
        'app.survey_questions',
        'app.questions',
        'app.question_types',
        'app.reseller_program_survey_questions',
        'app.survey_instance_responses',
        'app.survey_instances',
        'app.survey_awards',
        'app.staffs',
        'app.roles',
        'app.old_passwords',
        'app.pricing_rules'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResellerPricingRules') ? [] : ['className' => 'App\Model\Table\ResellerPricingRulesTable'];
        $this->ResellerPricingRules = TableRegistry::get('ResellerPricingRules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResellerPricingRules);

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
