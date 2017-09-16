<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OldPasswordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OldPasswordsTable Test Case
 */
class OldPasswordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OldPasswordsTable
     */
    public $OldPasswords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.old_passwords',
        'app.staffs',
        'app.resellers',
        'app.reseller_programs',
        'app.reseller_program_features',
        'app.features',
        'app.plan_features',
        'app.plans',
        'app.plan_settings',
        'app.limit_elements',
        'app.reseller_plans',
        'app.roles',
        'app.users',
        'app.bountee_users',
        'app.manual_awards',
        'app.promotion_awards',
        'app.promotions',
        'app.bountee_transactions',
        'app.tier_awards',
        'app.tiers',
        'app.tier_perks',
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
        $config = TableRegistry::exists('OldPasswords') ? [] : ['className' => 'App\Model\Table\OldPasswordsTable'];
        $this->OldPasswords = TableRegistry::get('OldPasswords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OldPasswords);

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
