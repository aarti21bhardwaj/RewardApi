<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResellerProgramMilestones Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ResellerPrograms
 * @property \Cake\ORM\Association\HasMany $MilestoneLevels
 *
 * @method \App\Model\Entity\ResellerProgramMilestone get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResellerProgramMilestone newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResellerProgramMilestone[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramMilestone|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResellerProgramMilestone patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramMilestone[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramMilestone findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResellerProgramMilestonesTable extends Table
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

        $this->table('reseller_program_milestones');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ResellerPrograms', [
            'foreignKey' => 'reseller_program_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('MilestoneLevels', [
            'foreignKey' => 'reseller_program_milestone_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->boolean('is_limited')
            ->requirePresence('is_limited', 'create')
            ->notEmpty('is_limited');

        $validator
            ->integer('duration')
            ->allowEmpty('duration');

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
