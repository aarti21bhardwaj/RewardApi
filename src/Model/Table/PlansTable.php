<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * Plans Model
 *
 * @property \Cake\ORM\Association\HasMany $PlanFeatures
 * @property \Cake\ORM\Association\HasMany $PlanSettings
 *
 * @method \App\Model\Entity\Plan get($primaryKey, $options = [])
 * @method \App\Model\Entity\Plan newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Plan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plan|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Plan[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plan findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlansTable extends Table
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

        $this->table('plans');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('PlanFeatures', [
            'foreignKey' => 'plan_id'
        ]);

        $this->hasMany('PlanSettings', [
            'foreignKey' => 'plan_id'
        ]);
         $this->addBehavior('Josegonzalez/Upload.Upload', [
      'image_name' => [
        'path' => Configure::read('ImageUpload.uploadPathForPlanLogos'),
        'fields' => [
          'dir' => 'image_path'
        ],
        'nameCallback' => function ($data, $settings) {
          return time(). $data['name'];
        },
      ],
    ]);

        $this->hasMany('ResellerPlans', [
            'foreignKey' => 'plan_id'
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
            ->allowEmpty('image_path');

        $validator
            ->allowEmpty('image_name');

        $validator
            ->numeric('pricing')
            ->requirePresence('pricing', 'create')
            ->notEmpty('pricing');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
