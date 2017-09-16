<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResellerProgramTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResellerProgramTypesTable Test Case
 */
class ResellerProgramTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResellerProgramTypesTable
     */
    public $ResellerProgramTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reseller_program_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResellerProgramTypes') ? [] : ['className' => 'App\Model\Table\ResellerProgramTypesTable'];
        $this->ResellerProgramTypes = TableRegistry::get('ResellerProgramTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResellerProgramTypes);

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
