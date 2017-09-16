<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Survey Question'), ['action' => 'edit', $surveyQuestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Survey Question'), ['action' => 'delete', $surveyQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Surveys'), ['controller' => 'Surveys', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey'), ['controller' => 'Surveys', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reseller Program Survey Questions'), ['controller' => 'ResellerProgramSurveyQuestions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reseller Program Survey Question'), ['controller' => 'ResellerProgramSurveyQuestions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="surveyQuestions view large-9 medium-8 columns content">
    <h3><?= h($surveyQuestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Survey') ?></th>
            <td><?= $surveyQuestion->has('survey') ? $this->Html->link($surveyQuestion->survey->name, ['controller' => 'Surveys', 'action' => 'view', $surveyQuestion->survey->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $surveyQuestion->has('question') ? $this->Html->link($surveyQuestion->question->id, ['controller' => 'Questions', 'action' => 'view', $surveyQuestion->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($surveyQuestion->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reseller Program Survey Questions') ?></h4>
        <?php if (!empty($surveyQuestion->reseller_program_survey_questions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Reseller Program Survey Id') ?></th>
                <th scope="col"><?= __('Survey Question Id') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($surveyQuestion->reseller_program_survey_questions as $resellerProgramSurveyQuestions): ?>
            <tr>
                <td><?= h($resellerProgramSurveyQuestions->id) ?></td>
                <td><?= h($resellerProgramSurveyQuestions->reseller_program_survey_id) ?></td>
                <td><?= h($resellerProgramSurveyQuestions->survey_question_id) ?></td>
                <td><?= h($resellerProgramSurveyQuestions->points) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ResellerProgramSurveyQuestions', 'action' => 'view', $resellerProgramSurveyQuestions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ResellerProgramSurveyQuestions', 'action' => 'edit', $resellerProgramSurveyQuestions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ResellerProgramSurveyQuestions', 'action' => 'delete', $resellerProgramSurveyQuestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resellerProgramSurveyQuestions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
