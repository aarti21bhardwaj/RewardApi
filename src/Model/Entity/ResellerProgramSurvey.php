<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResellerProgramSurvey Entity
 *
 * @property int $id
 * @property int $reseller_program_id
 * @property int $survey_id
 * @property string $survey_type
 *
 * @property \App\Model\Entity\ResellerProgram $reseller_program
 * @property \App\Model\Entity\Survey $survey
 * @property \App\Model\Entity\ResellerProgramSurveyQuestion[] $reseller_program_survey_questions
 * @property \App\Model\Entity\SurveyInstance[] $survey_instances
 */
class ResellerProgramSurvey extends Entity
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
