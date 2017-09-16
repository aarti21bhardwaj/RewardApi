<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlanSettings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Plans
 * @property \Cake\ORM\Association\BelongsTo $LimitElements
 *
 * @method \App\Model\Entity\PlanSetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlanSetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PlanSetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlanSetting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlanSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlanSetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlanSetting findOrCreate($search, callable $callback = null, $options = [])
 */
class PlanSettingsTable extends Table
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

        $this->table('plan_settings');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LimitElements', [
            'foreignKey' => 'limit_element_id',
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
            ->integer('min_limit')
            ->requirePresence('min_limit', 'create')
            ->notEmpty('min_limit');

        $validator
            ->integer('max_limit')
            ->requirePresence('max_limit', 'create')
            ->notEmpty('max_limit');

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
        $rules->add($rules->existsIn(['plan_id'], 'Plans'));
        $rules->add($rules->existsIn(['limit_element_id'], 'LimitElements'));

        return $rules;
    }
}
