<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanSettingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanSettingsTable Test Case
 */
class PlanSettingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanSettingsTable
     */
    public $PlanSettings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.plan_settings',
        'app.plans',
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
        $config = TableRegistry::exists('PlanSettings') ? [] : ['className' => 'App\Model\Table\PlanSettingsTable'];
        $this->PlanSettings = TableRegistry::get('PlanSettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlanSettings);

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
