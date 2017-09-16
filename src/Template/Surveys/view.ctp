<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Survey'), ['action' => 'edit', $survey->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Survey'), ['action' => 'delete', $survey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $survey->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Surveys'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reseller Program Surveys'), ['controller' => 'ResellerProgramSurveys', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reseller Program Survey'), ['controller' => 'ResellerProgramSurveys', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['controller' => 'SurveyQuestions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey Question'), ['controller' => 'SurveyQuestions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="surveys view large-9 medium-8 columns content">
    <h3><?= h($survey->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($survey->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($survey->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reseller Program Surveys') ?></h4>
        <?php if (!empty($survey->reseller_program_surveys)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Reseller Program Id') ?></th>
                <th scope="col"><?= __('Survey Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($survey->reseller_program_surveys as $resellerProgramSurveys): ?>
            <tr>
                <td><?= h($resellerProgramSurveys->id) ?></td>
                <td><?= h($resellerProgramSurveys->reseller_program_id) ?></td>
                <td><?= h($resellerProgramSurveys->survey_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ResellerProgramSurveys', 'action' => 'view', $resellerProgramSurveys->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ResellerProgramSurveys', 'action' => 'edit', $resellerProgramSurveys->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ResellerProgramSurveys', 'action' => 'delete', $resellerProgramSurveys->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resellerProgramSurveys->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Survey Questions') ?></h4>
        <?php if (!empty($survey->survey_questions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Survey Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($survey->survey_questions as $surveyQuestions): ?>
            <tr>
                <td><?= h($surveyQuestions->id) ?></td>
                <td><?= h($surveyQuestions->survey_id) ?></td>
                <td><?= h($surveyQuestions->question_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SurveyQuestions', 'action' => 'view', $surveyQuestions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SurveyQuestions', 'action' => 'edit', $surveyQuestions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SurveyQuestions', 'action' => 'delete', $surveyQuestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $surveyQuestions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
