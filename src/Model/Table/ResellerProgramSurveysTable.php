<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResellerProgramSurveys Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ResellerPrograms
 * @property \Cake\ORM\Association\BelongsTo $Surveys
 * @property \Cake\ORM\Association\HasMany $ResellerProgramSurveyQuestions
 * @property \Cake\ORM\Association\HasMany $SurveyInstances
 *
 * @method \App\Model\Entity\ResellerProgramSurvey get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResellerProgramSurvey newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurvey[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurvey|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResellerProgramSurvey patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurvey[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurvey findOrCreate($search, callable $callback = null, $options = [])
 */
class ResellerProgramSurveysTable extends Table
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

        $this->table('reseller_program_surveys');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('ResellerPrograms', [
            'foreignKey' => 'reseller_program_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Surveys', [
            'foreignKey' => 'survey_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ResellerProgramSurveyQuestions', [
            'foreignKey' => 'reseller_program_survey_id'
        ]);
        $this->hasMany('SurveyInstances', [
            'foreignKey' => 'reseller_program_survey_id'
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
            ->requirePresence('survey_type', 'create')
            ->notEmpty('survey_type');

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
        $rules->add($rules->existsIn(['survey_id'], 'Surveys'));

        return $rules;
    }
}
