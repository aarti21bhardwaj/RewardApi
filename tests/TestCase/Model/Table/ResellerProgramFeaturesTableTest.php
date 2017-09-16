<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResellerProgramFeaturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResellerProgramFeaturesTable Test Case
 */
class ResellerProgramFeaturesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResellerProgramFeaturesTable
     */
    public $ResellerProgramFeatures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reseller_program_features',
        'app.features',
        'app.plan_features',
        'app.plans',
        'app.plan_settings',
        'app.limit_elements',
        'app.reseller_programs',
        'app.resellers',
        'app.users',
        'app.roles',
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
        $config = TableRegistry::exists('ResellerProgramFeatures') ? [] : ['className' => 'App\Model\Table\ResellerProgramFeaturesTable'];
        $this->ResellerProgramFeatures = TableRegistry::get('ResellerProgramFeatures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResellerProgramFeatures);

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
