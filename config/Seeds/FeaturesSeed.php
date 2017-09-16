<?php
use Migrations\AbstractSeed;

/**
 * Features seed.
 */
class FeaturesSeed extends AbstractSeed
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
                        'name'=> 'promotions',
                    ],
                    [
                        'name'=> 'milestone',
                    ],
                    [
                        'name'=> 'tiers',
                    ],
                    [
                        'name'=> 'compliancesurvey',
                    ],
                    [
                        'name'=> 'review',
                    ],
                    [
                        'name'=> 'manualpoints',
                    ],

                    [
                        'name'=> 'addpatient',
                    ]


        ];

        $table = $this->table('features');
        $table->insert($data)->save();
    }
}
