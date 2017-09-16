<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GiftCoupons Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ResellerPrograms
 * @property \Cake\ORM\Association\HasMany $GiftCouponAwards
 *
 * @method \App\Model\Entity\GiftCoupon get($primaryKey, $options = [])
 * @method \App\Model\Entity\GiftCoupon newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GiftCoupon[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GiftCoupon|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GiftCoupon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GiftCoupon[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GiftCoupon findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GiftCouponsTable extends Table
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

        $this->table('gift_coupons');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ResellerPrograms', [
            'foreignKey' => 'reseller_program_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('GiftCouponAwards', [
            'foreignKey' => 'gift_coupon_id'
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
            ->integer('points')
            ->requirePresence('points', 'create')
            ->notEmpty('points');

        $validator
            ->integer('expiry_duration')
            ->requirePresence('expiry_duration', 'create')
            ->notEmpty('expiry_duration');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->allowEmpty('reason');

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
        $rules->add($rules->existsIn(['reseller_program_id'], 'ResellerPrograms'));

        return $rules;
    }
}
