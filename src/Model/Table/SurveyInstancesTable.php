<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SurveyInstances Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ResellerProgramSurveys
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $SurveyAwards
 * @property \Cake\ORM\Association\HasMany $SurveyInstanceResponses
 *
 * @method \App\Model\Entity\SurveyInstance get($primaryKey, $options = [])
 * @method \App\Model\Entity\SurveyInstance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SurveyInstance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SurveyInstance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SurveyInstance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyInstance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyInstance findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SurveyInstancesTable extends Table
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

        $this->table('survey_instances');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ResellerProgramSurveys', [
            'foreignKey' => 'reseller_program_survey_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('SurveyAwards', [
            'foreignKey' => 'survey_instance_id'
        ]);
        $this->hasMany('SurveyInstanceResponses', [
            'foreignKey' => 'survey_instance_id'
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
            ->integer('iteration')
            ->requirePresence('iteration', 'create')
            ->notEmpty('iteration');

        $validator
            ->boolean('perfect_user')
            ->requirePresence('perfect_user', 'create')
            ->notEmpty('perfect_user');

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
        $rules->add($rules->existsIn(['reseller_program_survey_id'], 'ResellerProgramSurveys'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
