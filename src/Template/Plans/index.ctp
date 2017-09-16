
<div class="plans index large-9 medium-8 columns content">
  <h3><?= __('Plans') ?></h3>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pricing') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plans as $plan): ?>
                    <tr>
                        <td><?= $this->Number->format($plan->id) ?></td>
                        <td><?= h($plan->name) ?></td>
                        <td><a href="<?= $plan->image_url ?>" target="_blank"><?= $this->Html->image($plan->image_url, array('height' => 100, 'width' => 100))?></a></td>
                        <td><?= $this->Number->format($plan->pricing) ?></td>
                        <td><?= h($plan->status) ?></td>
                        <td class="actions">
                                    <?= '<a href='.$this->Url->build(['action' => 'view', $plan->id]).' class="btn btn-xs btn-success">' ?>
                                    <i class="fa fa-eye fa-fw"></i>
                                </a>
                                <?= '<a href='.$this->Url->build(['action' => 'edit', $plan->id]).' class="btn btn-xs btn-warning"">' ?>
                                <i class="fa fa-pencil fa-fw"></i>
                                </a>
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $plan->id], [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $plan->id),
                                    'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?> 
                                </a>
                        </td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    
</div>