<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Staff Users') ?></h3>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Reseller Id</th>
                <th scope="col">Role Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffs as $staff): ?>
            <tr>
                <td><?= $this->Number->format($staff->id) ?></td>
                <td><?= h($staff->reseller->org_name) ?></td>
                <td><?= h($staff->role->label) ?></td>
                <td><?= h($staff->first_name) ?></td>
                <td><?= h($staff->last_name) ?></td>
                <td><?= h($staff->username) ?></td>
                <td><?= h($staff->email) ?></td>
                <td><?= h($staff->phone) ?></td>
                <td class="actions">
                        <?= '<a href='.$this->Url->build(['action' => 'view', $staff->id]).' class="btn btn-xs btn-success">' ?>
                        <i class="fa fa-eye fa-fw"></i>
                    </a>
                    <?= '<a href='.$this->Url->build(['action' => 'edit', $staff->id]).' class="btn btn-xs btn-warning"">' ?>
                    <i class="fa fa-pencil fa-fw"></i>
                    </a>
                    <?php if($loggedInUser['id'] != $staff->id){ ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $staff->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $staff->id),
                        'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?> 
                        <?php }?>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
