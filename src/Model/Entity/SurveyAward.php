<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SurveyAward Entity
 *
 * @property int $id
 * @property int $survey_instance_id
 * @property int $user_id
 * @property int $points
 * @property int $bountee_transaction_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\SurveyInstance $survey_instance
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BounteeTransaction $bountee_transaction
 */
class SurveyAward extends Entity
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
