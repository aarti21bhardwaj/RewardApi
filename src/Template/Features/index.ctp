<div class="features index large-9 medium-8 columns content">
    <h3><?= __('Features') ?></h3>
    <table class="table table-striped table-bordered table-hover">
         <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($features as $feature): ?>
            <tr>
                <td><?= $this->Number->format($feature->id) ?></td>
                <td><?= h($feature->name) ?></td>
                <td class="actions">
                        <?= '<a href='.$this->Url->build(['action' => 'view', $feature->id]).' class="btn btn-xs btn-success">' ?>
                        <i class="fa fa-eye fa-fw"></i>
                    </a>
                    <?= '<a href='.$this->Url->build(['action' => 'edit', $feature->id]).' class="btn btn-xs btn-warning"">' ?>
                    <i class="fa fa-pencil fa-fw"></i>
                    </a>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $feature->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $feature->id),
                        'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?> 
                    </a>
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

