<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PromotionAwardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PromotionAwardsTable Test Case
 */
class PromotionAwardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PromotionAwardsTable
     */
    public $PromotionAwards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.promotion_awards',
        'app.promotions',
        'app.reseller_programs',
        'app.resellers',
        'app.reseller_plans',
        'app.plans',
        'app.plan_features',
        'app.features',
        'app.plan_settings',
        'app.limit_elements',
        'app.staffs',
        'app.roles',
        'app.users',
        'app.manual_awards',
        'app.reseller_program_users',
        'app.tier_awards',
        'app.tiers',
        'app.tier_perks',
        'app.user_tiers',
        'app.bountee_transactions',
        'app.old_passwords',
        'app.reseller_program_features'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PromotionAwards') ? [] : ['className' => 'App\Model\Table\PromotionAwardsTable'];
        $this->PromotionAwards = TableRegistry::get('PromotionAwards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PromotionAwards);

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
