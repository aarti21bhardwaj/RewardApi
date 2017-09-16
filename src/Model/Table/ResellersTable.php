<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * Resellers Model
 *
 * @property \Cake\ORM\Association\HasMany $ResellerPrograms


/**
 * Resellers Model
 *

 * @property \Cake\ORM\Association\HasMany $StaffUsers
 *
 * @method \App\Model\Entity\Reseller get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reseller newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reseller[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reseller|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reseller patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reseller[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reseller findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResellersTable extends Table
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

        $this->table('resellers');
        $this->displayField('id');
        $this->primaryKey('id');
         $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'is_deleted'
            ]);
        $this->addBehavior('Timestamp');

        $this->addBehavior('Muffin/Trash.Trash', [
      'field' => 'is_deleted'
        ]);

        $this->hasMany('ResellerPrograms', [
            'foreignKey' => 'reseller_id'
        ]);
        $this->hasMany('ResellerPlans', [
            'foreignKey' => 'reseller_id'
        ]);
        $this->hasMany('Staffs', [
            'foreignKey' => 'reseller_id'
        ]);
         $this->hasMany('ResellerProgramFeatures', [

            'foreignKey' => 'reseller_id'
        ]);
         $this->hasMany('ResellerPricingRules', [
            'foreignKey' => 'reseller_id'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
      'image_name' => [

        'path' => Configure::read('ImageUpload.uploadPathForResellerLogos'),

        'fields' => [
          'dir' => 'image_path'
        ],
        'nameCallback' => function ($data, $settings) {
          return time(). $data['name'];
        },
      ],
    ]);
    }

  // public function beforeMarshal( \Cake\Event\Event $event, \ArrayObject $data, \ArrayObject $options){
  //         if(!isset($data['client_identifier']) && !empty($data['client_identifier'])){
  //           $data['client_identifier'] = $this->_generateSalt(16);
  //         }
  //         if(!isset($data['client_secret']) && !empty($data['client_secret'])){
  //         $data['client_secret'] = $this->_generateSalt(20);
  //       }
  //   }

    public function beforeSave( \Cake\Event\Event $event, $entity, \ArrayObject $options){
      $entity->client_identifier = $this->_cryptographicString('alnum',32);
      $entity->client_secret = $this->_cryptographicString('alnum',32);
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

       $token = "";
       $max   = strlen( $pool );
       for ( $i = 0; $i < $length; $i++ ) {
         $token .= $pool[$crypto_rand_secure( 0, $max )];
       }
       return $token;
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
            ->requirePresence('org_name', 'create')
            ->notEmpty('org_name');

        $validator
            ->allowEmpty('client_identifier');

        $validator
            ->allowEmpty('client_secret');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('image_path');

        $validator
            ->allowEmpty('image_name');

        $validator
            ->allowEmpty('is_deleted');

        return $validator;
    }
}
