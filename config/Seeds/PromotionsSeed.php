<?php
use Migrations\AbstractSeed;

/**
 * Promotions seed.
 */
class PromotionsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    ['id' => '1','name' => 'For Check In','description' => 'For Check In','points' => '50','reseller_program_id' => '1','frequency' => '2','is_deleted' => NULL,'created' => date('Y-m-d H:i:s'),'modified' => date('Y-m-d H:i:s')],
                    ['id' => '2','name' => 'Patient Referral (50]','description' => 'For Referral','points' => '50','reseller_program_id' => '2','frequency' => '3','is_deleted' => NULL,'created' => date('Y-m-d H:i:s'),'modified' => date('Y-m-d H:i:s')],
                    ['id' => '3','name' => 'For Review','description' => 'For Review','points' => '50','reseller_program_id' => '2','frequency' => '4','is_deleted' => NULL,'created' => date('Y-m-d H:i:s'),'modified' => date('Y-m-d H:i:s')],
                    ['id' => '4','name' => 'For Social','description' => 'For Social','points' => '50','reseller_program_id' => '2','frequency' => '2','is_deleted' => NULL,'created' => date('Y-m-d H:i:s'),'modified' => date('Y-m-d H:i:s')],
                    ['id' => '5','name' => 'User liked the practice on Facebook','description' => 'User liked the practice on Facebook','points' => '0','reseller_program_id' => '1','frequency' => '10','is_deleted' => '2016-12-30 07:26:34','created' => date('Y-m-d H:i:s'),'modified' => date('Y-m-d H:i:s')],
                    
        ];

        $table = $this->table('promotions');
        $table->insert($data)->save();
    }
}
