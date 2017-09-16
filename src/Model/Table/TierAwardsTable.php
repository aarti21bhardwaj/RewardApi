<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TierAwards Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Resellers
 * @property \Cake\ORM\Association\BelongsTo $Tiers
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $BounteeTransactions
 *
 * @method \App\Model\Entity\TierAward get($primaryKey, $options = [])
 * @method \App\Model\Entity\TierAward newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TierAward[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TierAward|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TierAward patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TierAward[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TierAward findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TierAwardsTable extends Table
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

        $this->table('tier_awards');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Resellers', [
            'foreignKey' => 'reseller_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tiers', [
            'foreignKey' => 'tier_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        // $this->belongsTo('BounteeTransactions', [
        //     'foreignKey' => 'bountee_transaction_id',
        //     'joinType' => 'INNER'
        // ]);
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
            ->requirePresence('points', 'create')
            ->notEmpty('points');

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
        $rules->add($rules->existsIn(['reseller_id'], 'Resellers'));
        $rules->add($rules->existsIn(['tier_id'], 'Tiers'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        // $rules->add($rules->existsIn(['bountee_transaction_id'], 'BounteeTransactions'));

        return $rules;
    }
}
