<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LimitElements Model
 *
 * @property \Cake\ORM\Association\HasMany $PlanSettings
 *
 * @method \App\Model\Entity\LimitElement get($primaryKey, $options = [])
 * @method \App\Model\Entity\LimitElement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LimitElement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LimitElement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LimitElement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LimitElement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LimitElement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LimitElementsTable extends Table
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

        $this->table('limit_elements');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('PlanSettings', [
            'foreignKey' => 'limit_element_id'
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

        return $validator;
    }
}
