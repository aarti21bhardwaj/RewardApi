<?php
use Migrations\AbstractSeed;

/**
 * PlanSettings seed.
 */
class PlanSettingsSeed extends AbstractSeed
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
                      'plan_id' => 1,
                      'limit_element_id'=> 1,
                      'min_limit'    => 3,
                      'max_limit'    => 5,
                    ],
                    [
                      'plan_id' => 2,
                      'limit_element_id'=> 2,
                      'min_limit'    => 2,
                      'max_limit'    => 3,
                    ],


        ];

        $table = $this->table('plan_settings');
        $table->insert($data)->save();
    }
}
