<?php
use Migrations\AbstractSeed;

/**
 * Resellers seed.
 */
class ResellersSeed extends AbstractSeed
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
                      'org_name' => 'admin',
                      'status'   => 1,
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      'client_identifier' => "1234567890",
                      'client_secret' => "1234567890",
                      'is_deleted' => NULL,
                      ],
                      [
                      'id'       => 2,
                      'org_name' => 'Qwerty',
                      'status'   => 1,
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                      'client_identifier' => "123456789",
                      'client_secret' => "123456789",
                      'is_deleted' => NULL,
                      ],

        ];

        $table = $this->table('resellers');
        $table->insert($data)->save();
    }
}
