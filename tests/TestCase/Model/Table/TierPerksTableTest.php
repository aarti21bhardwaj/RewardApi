<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TierPerksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TierPerksTable Test Case
 */
class TierPerksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TierPerksTable
     */
    public $TierPerks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tier_perks',
        'app.tiers',
        'app.resellers',
        'app.reseller_programs',
        'app.reseller_program_features',
        'app.features',
        'app.plan_features',
        'app.plans',
        'app.plan_settings',
        'app.limit_elements',
        'app.reseller_plans',
        'app.users',
        'app.manual_awards',
        'app.promotion_awards',
        'app.promotions',
        'app.bountee_transactions',
        'app.tier_awards',
        'app.user_tiers',
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
        $config = TableRegistry::exists('TierPerks') ? [] : ['className' => 'App\Model\Table\TierPerksTable'];
        $this->TierPerks = TableRegistry::get('TierPerks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TierPerks);

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
