<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResellerProgramSurveyQuestions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ResellerProgramSurveys
 * @property \Cake\ORM\Association\BelongsTo $SurveyQuestions
 * @property \Cake\ORM\Association\HasMany $SurveyInstanceResponses
 *
 * @method \App\Model\Entity\ResellerProgramSurveyQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResellerProgramSurveyQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurveyQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurveyQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResellerProgramSurveyQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurveyQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramSurveyQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class ResellerProgramSurveyQuestionsTable extends Table
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

        $this->table('reseller_program_survey_questions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('ResellerProgramSurveys', [
            'foreignKey' => 'reseller_program_survey_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SurveyQuestions', [
            'foreignKey' => 'survey_question_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('SurveyInstanceResponses', [
            'foreignKey' => 'reseller_program_survey_question_id'
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
        $rules->add($rules->existsIn(['survey_question_id'], 'SurveyQuestions'));

        return $rules;
    }
}
