<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PromotionAwards Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Promotions
 * @property \Cake\ORM\Association\BelongsTo $Resellers
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $BounteeTransactions
 *
 * @method \App\Model\Entity\PromotionAward get($primaryKey, $options = [])
 * @method \App\Model\Entity\PromotionAward newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PromotionAward[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PromotionAward|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PromotionAward patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PromotionAward[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PromotionAward findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PromotionAwardsTable extends Table
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

        $this->table('promotion_awards');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Promotions', [
            'foreignKey' => 'promotion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Resellers', [
            'foreignKey' => 'reseller_id',
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
            ->integer('points')
            ->requirePresence('points', 'create')
            ->notEmpty('points');

        $validator
            ->dateTime('is_deleted')
            ->allowEmpty('is_deleted');

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
        $rules->add($rules->existsIn(['promotion_id'], 'Promotions'));
        $rules->add($rules->existsIn(['reseller_id'], 'Resellers'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
