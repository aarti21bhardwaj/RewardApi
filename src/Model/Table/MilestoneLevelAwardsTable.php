<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MilestoneLevelAwards Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MilestoneLevels
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $BounteeTransactions
 *
 * @method \App\Model\Entity\MilestoneLevelAward get($primaryKey, $options = [])
 * @method \App\Model\Entity\MilestoneLevelAward newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MilestoneLevelAward[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MilestoneLevelAward|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MilestoneLevelAward patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MilestoneLevelAward[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MilestoneLevelAward findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MilestoneLevelAwardsTable extends Table
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

        $this->table('milestone_level_awards');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MilestoneLevels', [
            'foreignKey' => 'milestone_level_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        // $this->belongsTo('BounteeTransactions', [
        //     'foreignKey' => 'bountee_transaction_id'
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
            ->integer('points')
            ->allowEmpty('points');

        $validator
            ->integer('amount')
            ->allowEmpty('amount');

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
        $rules->add($rules->existsIn(['milestone_level_id'], 'MilestoneLevels'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        // $rules->add($rules->existsIn(['bountee_transaction_id'], 'BounteeTransactions'));

        return $rules;
    }
}
