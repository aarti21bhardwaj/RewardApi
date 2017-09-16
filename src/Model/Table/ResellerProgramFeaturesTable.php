<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResellerProgramFeatures Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Features
 * @property \Cake\ORM\Association\BelongsTo $ResellerPrograms
 * @property \Cake\ORM\Association\BelongsTo $Resellers
 *
 * @method \App\Model\Entity\ResellerProgramFeature get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResellerProgramFeature newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResellerProgramFeature[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramFeature|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResellerProgramFeature patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramFeature[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgramFeature findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResellerProgramFeaturesTable extends Table
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

        $this->table('reseller_program_features');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Features', [
            'foreignKey' => 'feature_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ResellerPrograms', [
            'foreignKey' => 'reseller_program_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Resellers', [
            'foreignKey' => 'reseller_id',
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
        $rules->add($rules->existsIn(['feature_id'], 'Features'));
        $rules->add($rules->existsIn(['reseller_program_id'], 'ResellerPrograms'));
        $rules->add($rules->existsIn(['reseller_id'], 'Resellers'));

        return $rules;
    }
}
