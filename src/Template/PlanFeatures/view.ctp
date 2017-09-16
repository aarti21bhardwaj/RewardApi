<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Plan Feature'), ['action' => 'edit', $planFeature->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Plan Feature'), ['action' => 'delete', $planFeature->id], ['confirm' => __('Are you sure you want to delete # {0}?', $planFeature->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Plan Features'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan Feature'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="planFeatures view large-9 medium-8 columns content">
    <h3><?= h($planFeature->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Plan') ?></th>
            <td><?= $planFeature->has('plan') ? $this->Html->link($planFeature->plan->name, ['controller' => 'Plans', 'action' => 'view', $planFeature->plan->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feature') ?></th>
            <td><?= $planFeature->has('feature') ? $this->Html->link($planFeature->feature->name, ['controller' => 'Features', 'action' => 'view', $planFeature->feature->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($planFeature->id) ?></td>
        </tr>
    </table>
</div>
