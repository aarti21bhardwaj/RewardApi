<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GiftCouponAward Entity
 *
 * @property int $id
 * @property int $gift_coupon_id
 * @property int $reseller_id
 * @property int $staff_id
 * @property int $user_id
 * @property int $transaction_number
 * @property bool $status
 * @property string $reason
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\GiftCoupon $gift_coupon
 * @property \App\Model\Entity\Reseller $reseller
 * @property \App\Model\Entity\Staff $staff
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\GiftCouponRedemption[] $gift_coupon_redemptions
 */
class GiftCouponAward extends Entity
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
