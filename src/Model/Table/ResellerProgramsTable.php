<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * ResellerPrograms Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Resellers
 * @property \Cake\ORM\Association\BelongsTo $ResellerProgramTypes
 * @property \Cake\ORM\Association\HasMany $Promotions
 * @property \Cake\ORM\Association\HasMany $ResellerProgramCharges
 * @property \Cake\ORM\Association\HasMany $ResellerProgramFeatures
 * @property \Cake\ORM\Association\HasMany $ResellerProgramMilestones
 * @property \Cake\ORM\Association\HasMany $ResellerProgramSurveys
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\ResellerProgram get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResellerProgram newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResellerProgram[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgram|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResellerProgram patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgram[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResellerProgram findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResellerProgramsTable extends Table
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

        $this->table('reseller_programs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Resellers', [
            'foreignKey' => 'reseller_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ResellerProgramTypes', [
            'foreignKey' => 'reseller_program_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Promotions', [
            'foreignKey' => 'reseller_program_id'
        ]);
        $this->hasMany('ResellerProgramCharges', [
            'foreignKey' => 'reseller_program_id'
        ]);
        $this->hasMany('ResellerProgramFeatures', [
            'foreignKey' => 'reseller_program_id'
        ]);
        $this->hasMany('ResellerProgramMilestones', [
            'foreignKey' => 'reseller_program_id'
        ]);
        $this->hasMany('ResellerProgramSurveys', [
            'foreignKey' => 'reseller_program_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'reseller_program_id'
        ]);
        $this->hasMany('GiftCoupons', [
            'foreignKey' => 'reseller_program_id'
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
            ->requirePresence('program_name', 'create')
            ->notEmpty('program_name');

        $validator
            ->integer('appid')
            ->allowEmpty('appid');

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
        $rules->add($rules->existsIn(['reseller_program_type_id'], 'ResellerProgramTypes'));

        return $rules;
    }
    
    public function beforeSave( \Cake\Event\Event $event, $entity, \ArrayObject $options){
      $entity->appid = $this->_cryptographicString('alnum',32);
     }
     private function _cryptographicString( $type = 'alnum', $length = 8 )
     {
       switch ( $type ) {
         case 'alnum':
         $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         break;
         case 'alpha':
         $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         break;
         case 'hexdec':
         $pool = '0123456789abcdef';
         break;
         case 'numeric':
         $pool = '0123456789';
         break;
         case 'nozero':
         $pool = '123456789';
         break;
         case 'distinct':
         $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
         break;
         default:
         $pool = (string) $type;
         break;
       }


       $crypto_rand_secure = function ( $min, $max ) {
         $range = $max - $min;
         if ( $range < 0 ) return $min; // not so random...
         $log    = log( $range, 2 );
         $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
         $bits   = (int) $log + 1; // length in bits
         $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
         do {
           $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
           $rnd = $rnd & $filter; // discard irrelevant bits
         } while ( $rnd >= $range );
         return $min + $rnd;
       };

       $appId = "";
       $max   = strlen( $pool );
       for ( $i = 0; $i < $length; $i++ ) {
         $appId .= $pool[$crypto_rand_secure( 0, $max )];
       }
       return $appId;
     } 
}
