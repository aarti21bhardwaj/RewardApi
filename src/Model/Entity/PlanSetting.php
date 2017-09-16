<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlanSetting Entity
 *
 * @property int $id
 * @property int $plan_id
 * @property int $limit_element_id
 * @property int $min_limit
 * @property int $max_limit
 *
 * @property \App\Model\Entity\Plan $plan
 * @property \App\Model\Entity\LimitElement $limit_element
 */
class PlanSetting extends Entity
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
