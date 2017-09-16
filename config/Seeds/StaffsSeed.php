<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
/**

/**
 * Users seed.
 */
class StaffsSeed extends AbstractSeed
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
        $hasher = new DefaultPasswordHasher();
        $data = [
            [
                      'reseller_id' => 1,
                      'role_id'=>'1',
                      'first_name'    => 'admin',
                      'last_name'    => 'admin',
                      'username' => 'admin',
                      'email'   =>'admin@gmail.com',
                      'uuid'=>Text::uuid(),
                      'phone'=> '9999999999',
                      'password'   =>$hasher->hash('12345678'),
                      'status' => 1,
                      'created' => '2016-06-15 10:01:27',
                      'modified'=> '2016-06-15 10:01:27'
                      ],
                      [
                      'reseller_id' => 2,
                      'role_id'=>'2',
                      'first_name'    => 'qwerty',
                      'last_name'    => 'qwerty',
                      'username' => 'qwerty',
                      'email'   =>'qwerty@gmail.com',
                      'uuid'=>Text::uuid(),
                      'phone'=> '1(800)233-2742',
                      'password'   =>$hasher->hash('12345678'),
                      'status' => 1,
                      'created' => '2016-08-15 10:01:27',
                      'modified'=> '2016-08-15 10:01:27'
                      ]

        ];

        $table = $this->table('staffs');
        $table->insert($data)->save();
    }
}
