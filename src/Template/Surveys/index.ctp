<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Survey'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reseller Program Surveys'), ['controller' => 'ResellerProgramSurveys', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reseller Program Survey'), ['controller' => 'ResellerProgramSurveys', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Survey Questions'), ['controller' => 'SurveyQuestions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Survey Question'), ['controller' => 'SurveyQuestions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="surveys index large-9 medium-8 columns content">
    <h3><?= __('Surveys') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveys as $survey): ?>
            <tr>
                <td><?= $this->Number->format($survey->id) ?></td>
                <td><?= h($survey->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $survey->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $survey->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $survey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $survey->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
