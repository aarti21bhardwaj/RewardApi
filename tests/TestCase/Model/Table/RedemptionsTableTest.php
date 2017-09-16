<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RedemptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RedemptionsTable Test Case
 */
class RedemptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RedemptionsTable
     */
    public $Redemptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.redemptions',
        'app.resellers',
        'app.reseller_programs',
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
        'app.users',
        'app.manual_awards',
        'app.promotion_awards',
        'app.promotions',
        'app.tier_awards',
        'app.tiers',
        'app.tier_perks',
        'app.user_tiers',
        'app.milestone_level_rewards',
        'app.reward_types',
        'app.milestone_level_rules',
        'app.staffs',
        'app.roles',
        'app.old_passwords'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Redemptions') ? [] : ['className' => 'App\Model\Table\RedemptionsTable'];
        $this->Redemptions = TableRegistry::get('Redemptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Redemptions);

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
