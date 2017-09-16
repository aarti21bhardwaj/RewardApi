<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reseller Programs'), ['controller' => 'ResellerPrograms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reseller Program'), ['controller' => 'ResellerPrograms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Manual Awards'), ['controller' => 'ManualAwards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manual Award'), ['controller' => 'ManualAwards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Promotion Awards'), ['controller' => 'PromotionAwards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Promotion Award'), ['controller' => 'PromotionAwards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tier Awards'), ['controller' => 'TierAwards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tier Award'), ['controller' => 'TierAwards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Tiers'), ['controller' => 'UserTiers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Tier'), ['controller' => 'UserTiers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('phone');
            echo $this->Form->input('reseller_program_id', ['options' => $resellerPrograms]);
            echo $this->Form->input('bountee_user_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
