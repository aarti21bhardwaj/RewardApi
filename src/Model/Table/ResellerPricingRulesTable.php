<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResellerPricingRules Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Resellers
 * @property \Cake\ORM\Association\BelongsTo $PricingRules
 *
 * @method \App\Model\Entity\ResellerPricingRule get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResellerPricingRule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResellerPricingRule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResellerPricingRule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResellerPricingRule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerPricingRule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerPricingRule findOrCreate($search, callable $callback = null, $options = [])
 */
class ResellerPricingRulesTable extends Table
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

        $this->table('reseller_pricing_rules');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Resellers', [
            'foreignKey' => 'reseller_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PricingRules', [
            'foreignKey' => 'pricing_rule_id',
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
        $rules->add($rules->existsIn(['reseller_id'], 'Resellers'));
        $rules->add($rules->existsIn(['pricing_rule_id'], 'PricingRules'));

        return $rules;
    }
}
