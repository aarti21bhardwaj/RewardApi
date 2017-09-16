<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResellerProgramUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResellerProgramUsersTable Test Case
 */
class ResellerProgramUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResellerProgramUsersTable
     */
    public $ResellerProgramUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reseller_program_users',
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
        'app.user_old_passwords'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResellerProgramUsers') ? [] : ['className' => 'App\Model\Table\ResellerProgramUsersTable'];
        $this->ResellerProgramUsers = TableRegistry::get('ResellerProgramUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResellerProgramUsers);

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
