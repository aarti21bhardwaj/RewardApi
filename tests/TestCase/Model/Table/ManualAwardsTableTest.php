<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManualAwardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManualAwardsTable Test Case
 */
class ManualAwardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManualAwardsTable
     */
    public $ManualAwards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.manual_awards',
        'app.resellers',
        'app.reseller_programs',
        'app.reseller_program_features',
        'app.features',
        'app.plan_features',
        'app.plans',
        'app.plan_settings',
        'app.limit_elements',
        'app.reseller_plans',
        'app.staffs',
        'app.roles',
        'app.users',
        'app.promotion_awards',
        'app.promotions',
        'app.reseller_program_users',
        'app.tier_awards',
        'app.tiers',
        'app.tier_perks',
        'app.user_tiers',
        'app.bountee_transactions',
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
        $config = TableRegistry::exists('ManualAwards') ? [] : ['className' => 'App\Model\Table\ManualAwardsTable'];
        $this->ManualAwards = TableRegistry::get('ManualAwards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ManualAwards);

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
