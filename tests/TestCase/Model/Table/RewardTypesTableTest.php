<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RewardTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RewardTypesTable Test Case
 */
class RewardTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RewardTypesTable
     */
    public $RewardTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reward_types',
        'app.milestone_level_rewards',
        'app.milestone_levels',
        'app.reseller_program_milestones',
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
        'app.milestone_level_awards',
        'app.bountee_transactions',
        'app.milestone_level_rules'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RewardTypes') ? [] : ['className' => 'App\Model\Table\RewardTypesTable'];
        $this->RewardTypes = TableRegistry::get('RewardTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RewardTypes);

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
}
