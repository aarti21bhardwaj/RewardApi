<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResellerProgramCharges Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ResellerPrograms
 *
 * @method \App\Model\Entity\ResellerProgramCharge get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResellerProgramCharge newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResellerProgramCharge[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramCharge|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResellerProgramCharge patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramCharge[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramCharge findOrCreate($search, callable $callback = null, $options = [])
 */
class ResellerProgramChargesTable extends Table
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

        $this->table('reseller_program_charges');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('ResellerPrograms', [
            'foreignKey' => 'reseller_program_id',
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
            ->numeric('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
