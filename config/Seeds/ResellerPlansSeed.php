<?php
use Migrations\AbstractSeed;

/**
 * ResellerPlans seed.
 */
class ResellerPlansSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
                     [
                      'id'       => 1,
                      'reseller_id' => 1,
                      'plan_id'   => 2,
                      'end_time' => NULL,
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s')
                      ],
                      [
                      'id'       => 2,
                      'reseller_id' => 2,
                      'plan_id'   => 3,
                      'end_time' => NULL,
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s')
                      ],

        ];

        $table = $this->table('reseller_plans');
        $table->insert($data)->save();
    }
}
