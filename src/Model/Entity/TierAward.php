<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TierAward Entity
 *
 * @property int $id
 * @property int $reseller_id
 * @property int $tier_id
 * @property int $user_id
 * @property string $points
 * @property int $bountee_transaction_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Reseller $reseller
 * @property \App\Model\Entity\Tier $tier
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BounteeTransaction $bountee_transaction
 */
class TierAward extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
