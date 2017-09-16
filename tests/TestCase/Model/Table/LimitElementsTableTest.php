<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LimitElementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LimitElementsTable Test Case
 */
class LimitElementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LimitElementsTable
     */
    public $LimitElements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.limit_elements',
        'app.plan_settings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LimitElements') ? [] : ['className' => 'App\Model\Table\LimitElementsTable'];
        $this->LimitElements = TableRegistry::get('LimitElements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LimitElements);

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
