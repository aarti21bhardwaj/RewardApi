<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RewardTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $MilestoneLevelRewards
 *
 * @method \App\Model\Entity\RewardType get($primaryKey, $options = [])
 * @method \App\Model\Entity\RewardType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RewardType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RewardType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RewardType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RewardType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RewardType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RewardTypesTable extends Table
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

        $this->table('reward_types');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MilestoneLevelRewards', [
            'foreignKey' => 'reward_type_id'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }
}
