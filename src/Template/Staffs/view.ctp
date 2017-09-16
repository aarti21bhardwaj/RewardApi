<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Staff'), ['action' => 'edit', $staff->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Staff'), ['action' => 'delete', $staff->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Staffs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Staff'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Resellers'), ['controller' => 'Resellers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reseller'), ['controller' => 'Resellers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Old Passwords'), ['controller' => 'UserOldPasswords', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Old Password'), ['controller' => 'UserOldPasswords', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="staffs view large-9 medium-8 columns content">
    <h3><?= h($staff->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Reseller') ?></th>
            <td><?= $staff->has('reseller') ? $this->Html->link($staff->reseller->id, ['controller' => 'Resellers', 'action' => 'view', $staff->reseller->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $staff->has('role') ? $this->Html->link($staff->role->name, ['controller' => 'Roles', 'action' => 'view', $staff->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($staff->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($staff->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($staff->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($staff->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($staff->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uuid') ?></th>
            <td><?= h($staff->uuid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($staff->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($staff->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($staff->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($staff->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($staff->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $staff->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User Old Passwords') ?></h4>
        <?php if (!empty($staff->user_old_passwords)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Staff Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($staff->user_old_passwords as $userOldPasswords): ?>
            <tr>
                <td><?= h($userOldPasswords->id) ?></td>
                <td><?= h($userOldPasswords->password) ?></td>
                <td><?= h($userOldPasswords->staff_id) ?></td>
                <td><?= h($userOldPasswords->created) ?></td>
                <td><?= h($userOldPasswords->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserOldPasswords', 'action' => 'view', $userOldPasswords->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserOldPasswords', 'action' => 'edit', $userOldPasswords->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserOldPasswords', 'action' => 'delete', $userOldPasswords->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userOldPasswords->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
