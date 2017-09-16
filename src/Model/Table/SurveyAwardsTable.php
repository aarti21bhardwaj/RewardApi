<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SurveyAwards Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SurveyInstances
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $BounteeTransactions
 *
 * @method \App\Model\Entity\SurveyAward get($primaryKey, $options = [])
 * @method \App\Model\Entity\SurveyAward newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SurveyAward[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SurveyAward|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SurveyAward patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyAward[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyAward findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SurveyAwardsTable extends Table
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

        $this->table('survey_awards');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SurveyInstances', [
            'foreignKey' => 'survey_instance_id',
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
        $rules->add($rules->existsIn(['survey_instance_id'], 'SurveyInstances'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
