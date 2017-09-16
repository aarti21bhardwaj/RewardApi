<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Plan Feature'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="planFeatures index large-9 medium-8 columns content">
    <h3><?= __('Plan Features') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plan_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('feature_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($planFeatures as $planFeature): ?>
            <tr>
                <td><?= $this->Number->format($planFeature->id) ?></td>
                <td><?= $planFeature->has('plan') ? $this->Html->link($planFeature->plan->name, ['controller' => 'Plans', 'action' => 'view', $planFeature->plan->id]) : '' ?></td>
                <td><?= $planFeature->has('feature') ? $this->Html->link($planFeature->feature->name, ['controller' => 'Features', 'action' => 'view', $planFeature->feature->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $planFeature->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $planFeature->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $planFeature->id], ['confirm' => __('Are you sure you want to delete # {0}?', $planFeature->id)]) ?>
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
