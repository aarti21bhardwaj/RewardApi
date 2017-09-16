<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeaturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeaturesTable Test Case
 */
class FeaturesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeaturesTable
     */
    public $Features;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.features',
        'app.plan_features'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Features') ? [] : ['className' => 'App\Model\Table\FeaturesTable'];
        $this->Features = TableRegistry::get('Features', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Features);

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
