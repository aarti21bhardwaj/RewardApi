<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Question Types'), ['controller' => 'QuestionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Type'), ['controller' => 'QuestionTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['controller' => 'SurveyQuestions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Survey Question'), ['controller' => 'SurveyQuestions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Question Type') ?></th>
            <td><?= $question->has('question_type') ? $this->Html->link($question->question_type->name, ['controller' => 'QuestionTypes', 'action' => 'view', $question->question_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($question->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Frequency') ?></th>
            <td><?= $this->Number->format($question->frequency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points') ?></th>
            <td><?= $this->Number->format($question->points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($question->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($question->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Text->autoParagraph(h($question->text)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Survey Questions') ?></h4>
        <?php if (!empty($question->survey_questions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Survey Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->survey_questions as $surveyQuestions): ?>
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
