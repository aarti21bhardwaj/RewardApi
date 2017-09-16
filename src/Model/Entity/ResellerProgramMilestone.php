<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResellerProgramMilestone Entity
 *
 * @property int $id
 * @property int $reseller_program_id
 * @property string $name
 * @property bool $is_limited
 * @property int $duration
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\ResellerProgram $reseller_program
 * @property \App\Model\Entity\MilestoneLevel[] $milestone_levels
 */
class ResellerProgramMilestone extends Entity
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
