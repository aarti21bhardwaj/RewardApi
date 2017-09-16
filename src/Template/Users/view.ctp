<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reseller Programs'), ['controller' => 'ResellerPrograms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reseller Program'), ['controller' => 'ResellerPrograms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Manual Awards'), ['controller' => 'ManualAwards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manual Award'), ['controller' => 'ManualAwards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Promotion Awards'), ['controller' => 'PromotionAwards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promotion Award'), ['controller' => 'PromotionAwards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tier Awards'), ['controller' => 'TierAwards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tier Award'), ['controller' => 'TierAwards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Tiers'), ['controller' => 'UserTiers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Tier'), ['controller' => 'UserTiers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reseller Program') ?></th>
            <td><?= $user->has('reseller_program') ? $this->Html->link($user->reseller_program->id, ['controller' => 'ResellerPrograms', 'action' => 'view', $user->reseller_program->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bountee User Id') ?></th>
            <td><?= $this->Number->format($user->bountee_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Manual Awards') ?></h4>
        <?php if (!empty($user->manual_awards)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Reseller Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Bountee Transaction Id') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->manual_awards as $manualAwards): ?>
            <tr>
                <td><?= h($manualAwards->id) ?></td>
                <td><?= h($manualAwards->reseller_id) ?></td>
                <td><?= h($manualAwards->user_id) ?></td>
                <td><?= h($manualAwards->bountee_transaction_id) ?></td>
                <td><?= h($manualAwards->points) ?></td>
                <td><?= h($manualAwards->created) ?></td>
                <td><?= h($manualAwards->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ManualAwards', 'action' => 'view', $manualAwards->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ManualAwards', 'action' => 'edit', $manualAwards->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ManualAwards', 'action' => 'delete', $manualAwards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manualAwards->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Promotion Awards') ?></h4>
        <?php if (!empty($user->promotion_awards)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Promotion Id') ?></th>
                <th scope="col"><?= __('Reseller Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col"><?= __('Bountee Transaction Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->promotion_awards as $promotionAwards): ?>
            <tr>
                <td><?= h($promotionAwards->id) ?></td>
                <td><?= h($promotionAwards->promotion_id) ?></td>
                <td><?= h($promotionAwards->reseller_id) ?></td>
                <td><?= h($promotionAwards->user_id) ?></td>
                <td><?= h($promotionAwards->points) ?></td>
                <td><?= h($promotionAwards->bountee_transaction_id) ?></td>
                <td><?= h($promotionAwards->created) ?></td>
                <td><?= h($promotionAwards->modified) ?></td>
                <td><?= h($promotionAwards->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PromotionAwards', 'action' => 'view', $promotionAwards->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PromotionAwards', 'action' => 'edit', $promotionAwards->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PromotionAwards', 'action' => 'delete', $promotionAwards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promotionAwards->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tier Awards') ?></h4>
        <?php if (!empty($user->tier_awards)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Reseller Id') ?></th>
                <th scope="col"><?= __('Tier Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col"><?= __('Bountee Transaction Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->tier_awards as $tierAwards): ?>
            <tr>
                <td><?= h($tierAwards->id) ?></td>
                <td><?= h($tierAwards->reseller_id) ?></td>
                <td><?= h($tierAwards->tier_id) ?></td>
                <td><?= h($tierAwards->user_id) ?></td>
                <td><?= h($tierAwards->points) ?></td>
                <td><?= h($tierAwards->bountee_transaction_id) ?></td>
                <td><?= h($tierAwards->created) ?></td>
                <td><?= h($tierAwards->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TierAwards', 'action' => 'view', $tierAwards->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TierAwards', 'action' => 'edit', $tierAwards->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TierAwards', 'action' => 'delete', $tierAwards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tierAwards->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Tiers') ?></h4>
        <?php if (!empty($user->user_tiers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Tier Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Amount Spent') ?></th>
                <th scope="col"><?= __('Effective Discount Rate') ?></th>
                <th scope="col"><?= __('Year') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_tiers as $userTiers): ?>
            <tr>
                <td><?= h($userTiers->id) ?></td>
                <td><?= h($userTiers->tier_id) ?></td>
                <td><?= h($userTiers->user_id) ?></td>
                <td><?= h($userTiers->amount_spent) ?></td>
                <td><?= h($userTiers->effective_discount_rate) ?></td>
                <td><?= h($userTiers->year) ?></td>
                <td><?= h($userTiers->start_date) ?></td>
                <td><?= h($userTiers->end_date) ?></td>
                <td><?= h($userTiers->created) ?></td>
                <td><?= h($userTiers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserTiers', 'action' => 'view', $userTiers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserTiers', 'action' => 'edit', $userTiers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserTiers', 'action' => 'delete', $userTiers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userTiers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
