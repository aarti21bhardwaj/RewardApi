<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserMilestoneProgram Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $reseller_program_milestone_id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ResellerProgramMilestone $reseller_program_milestone
 */
class UserMilestoneProgram extends Entity
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
