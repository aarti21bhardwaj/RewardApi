<?php
use Migrations\AbstractSeed;

/**
 * LimitElements seed.
 */
class LimitElementsSeed extends AbstractSeed
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
                      'name' => 'Programs',
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                    ],
                     [
                      'name' => 'Users',
                      'created'  => date('Y-m-d H:i:s'),
                      'modified' => date('Y-m-d H:i:s'),
                    ]

                 ];

        $table = $this->table('limit_elements');
        $table->insert($data)->save();
    }
}
