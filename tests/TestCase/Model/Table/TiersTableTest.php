<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TiersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TiersTable Test Case
 */
class TiersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TiersTable
     */
    public $Tiers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.staffs',
        'app.roles',
        'app.users',
        'app.bountee_users',
        'app.manual_awards',
        'app.promotion_awards',
        'app.promotions',
        'app.bountee_transactions',
        'app.tier_awards',
        'app.user_tiers',
        'app.user_old_passwords',
        'app.tier_perks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tiers') ? [] : ['className' => 'App\Model\Table\TiersTable'];
        $this->Tiers = TableRegistry::get('Tiers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tiers);

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
