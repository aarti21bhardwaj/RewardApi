<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanFeaturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanFeaturesTable Test Case
 */
class PlanFeaturesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanFeaturesTable
     */
    public $PlanFeatures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.plan_features',
        'app.plans',
        'app.features'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PlanFeatures') ? [] : ['className' => 'App\Model\Table\PlanFeaturesTable'];
        $this->PlanFeatures = TableRegistry::get('PlanFeatures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlanFeatures);

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
