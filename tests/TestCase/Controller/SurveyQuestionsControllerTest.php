<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SurveyQuestionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SurveyQuestionsController Test Case
 */
class SurveyQuestionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.survey_questions',
        'app.surveys',
        'app.reseller_program_surveys',
        'app.questions',
        'app.question_types',
        'app.reseller_program_survey_questions'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
