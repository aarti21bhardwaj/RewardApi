<?php
use Migrations\AbstractSeed;

/**
 * ResellerPrograms seed.
 */
class ResellerProgramsSeed extends AbstractSeed
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
                      'reseller_id' => 1,
                      'staff_id' => 2,
                      'program_name'=> 'Program one',
                      'credit_type'=>'wallet',
                      'appid'    => 123456789,
                      'created' => '2016-08-15 10:01:27',
                      'modified'=> '2016-08-15 10:01:27'
                      ],
                      [
                      'reseller_id' => 2,
                      'staff_id' => 2,
                      'program_name'=>'Program two',
                      'credit_type'=>'store',
                      'appid'    => 123456789,
                      'created' => '2016-08-15 10:01:27',
                      'modified'=> '2016-08-15 10:01:27'
                      ]

        ];

        $table = $this->table('reseller_programs');
        $table->insert($data)->save();
    }
}
