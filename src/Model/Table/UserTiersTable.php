<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;
use Cake\Core\Configure;

/**
 * UserTiers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tiers
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserTier get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserTier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserTier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserTier|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserTier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserTier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserTier findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserTiersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('user_tiers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tiers', [
            'foreignKey' => 'tier_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('amount_spent')
            ->requirePresence('amount_spent', 'create')
            ->notEmpty('amount_spent');

        $validator
            ->numeric('effective_discount_rate')
            ->requirePresence('effective_discount_rate', 'create')
            ->notEmpty('effective_discount_rate');

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmpty('year');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['tier_id'], 'Tiers'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

     public function calculate($trans)
    {
        //$this->Log('Here we are');
        $sm = $this->findByUserId($trans['user_id'])
                   ->contain(['Tiers' => function($q) use($trans){
                                                                 return $q->where(['reseller_id' => $trans['reseller_id']]);
                                                                }
                                      ])
                   ->last();

        $yrChange = false;
        $tierChange = false;
        
        if(!$sm) // If no entry found in UserTiers
        {
            //$this->Log('No entry found in usertiers', 'debug');
            //Calculate tier for the new entity
            $baseTier = $this->Tiers->findByResellerId($trans['reseller_id'])->first();
            //pr($baseTier); die;
            $tierInfo = $this->Tiers->givePoints($baseTier->id, 0, $trans['amount'], 0);
            //pr($tierInfo);die;

            $arr = ['amount_spent' => $trans['amount'],
                    'year' => '0',
                    'effective_discount_rate' => $tierInfo['discount'],
                    'start_date' => Date::now(),
                    'end_date' => Date::now()->modify('+364 days'),
                    'user_id' => $trans['user_id'],
                    'tier_id' => $tierInfo['tierId'],
                    ];
                    
            $tierChange = true;    
            $sm = $this->newEntity($arr);
        }else{

            
            $getNewYear = $this->newYear($sm);
            if($getNewYear[0]) // check new year and update year and dates if needed
            {
               $sm = $getNewYear[1];
               if($sm->year > 1){

                    $sm = $this->checkTierMaintained($sm, $trans['reseller_id']); 
                }
               $sm->amount_spent = 0;
               $yrChange= true; 
            }
            $tierInfo = $this->Tiers->givePoints($sm->tier_id, $sm->amount_spent, $trans['amount'], 0); 
            $sm->amount_spent += $trans['amount'];
            $tierChange = $this->tierChange($tierInfo['tierId'], $sm->tier_id);
            if($tierChange || $yrChange)// If tier or year has changed create new entity
            {
               $arr = ['amount_spent' => $sm->amount_spent,
                    'year' => $sm->year,
                    'effective_discount_rate' => $tierInfo['discount'],
                    'start_date' => $sm->start_date,
                    'end_date' => $sm->end_date,
                    'user_id' => $sm->user_id,
                    'tier_id' => $tierInfo['tierId'],
                    ];
                $sm = $this->newEntity($arr);
            }else
            {
                $sm->tier_id = $tierInfo['tierId'];
                $sm->effective_discount_rate= $tierInfo['discount'];
            }
        }
        $this->save($sm);
        $points = $tierInfo['points'] * Configure::read('pointsValue');
        //pr($points); die;
        return [
                    'points' => (int) $points, 
                    'tierId' => $tierInfo['tierId'],
                    'tierName' => $tierInfo['tierName'],
                    'tierChange' => $tierChange, 
                    'yearChange' => $yrChange
                ];   
    }

    public function newYear($data) // do this if its a new year
    {
        if(Date::now() <= $data->end_date && Date::now() >= $data->start_date)
        {
            return false;
        }
        $data->year+=1; //Increment year by one
        //Update start and end date
        $data->start_date = $data->start_date->modify('+365 days');
        $data->end_date = $data->end_date->modify('+365 days');
        return [true, $data];
    }

    public function tierChange($current, $previous)
    {

        if($current != $previous)
        {   
            return true;
        }
        return false;

    }

    //Comaparing the tiers of last two years to determine tier for the new year
    public function checkTierMaintained($data, $resellerId)
    {

        $previousYr = $this->findByUserId($data->user_id)
                           ->where(['year' => $data->year-2])
                           ->contain(['Tiers' => function($q) use($resellerId) {
                                                                 return $q->where(['reseller_id' => $resellerId]);
                                                                }
                                      ])
                           ->last();

        $currentYr = $this->findByUserId($data->user_id)
                          ->where(['year' => $data->year-1])
                          ->contain(['Tiers' => function($q) use($resellerId){
                                                                 return $q->where(['reseller_id' => $resellerId]);
                                                                }
                                      ])
                          ->last();

        $currentTier = $this->Tiers->calTier($currentYr->amount_spent, $resellerId);

        $previousTier = $previousYr->tier_id;
        
        if($currentTier[0] != $previousTier[0])
        {
            $data->tier_id = $currentTier[0];
            $data->effective_discount_rate = $currentTier[1];
            
        }

        return $data;
    }
}
