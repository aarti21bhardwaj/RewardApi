<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Plan Features'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="planFeatures form large-9 medium-8 columns content">
    <?= $this->Form->create($planFeature) ?>
    <fieldset>
        <legend><?= __('Add Plan Feature') ?></legend>
        <?php
            echo $this->Form->input('plan_id', ['options' => $plans]);
            echo $this->Form->input('feature_id', ['options' => $features]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
