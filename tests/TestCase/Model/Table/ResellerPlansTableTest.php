<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResellerPlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResellerPlansTable Test Case
 */
class ResellerPlansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResellerPlansTable
     */
    public $ResellerPlans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reseller_plans',
        'app.resellers',
        'app.reseller_programs',
        'app.users',
        'app.roles',
        'app.user_old_passwords',
        'app.plans',
        'app.plan_features',
        'app.features',
        'app.plan_settings',
        'app.limit_elements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResellerPlans') ? [] : ['className' => 'App\Model\Table\ResellerPlansTable'];
        $this->ResellerPlans = TableRegistry::get('ResellerPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResellerPlans);

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
