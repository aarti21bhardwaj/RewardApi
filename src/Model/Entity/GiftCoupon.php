<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GiftCoupon Entity
 *
 * @property int $id
 * @property int $reseller_program_id
 * @property int $points
 * @property int $expiry_duration
 * @property string $description
 * @property string $reason
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Reseller $reseller
 * @property \App\Model\Entity\Staff $staff
 * @property \App\Model\Entity\GiftCouponAward[] $gift_coupon_awards
 */
class GiftCoupon extends Entity
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
