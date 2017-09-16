<div class="hpanel">
    <div class="panel-body">
        <div class="resellers index large-9 medium-8 columns content">
            <h3><?= __('Resellers') ?></h3>
            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('org_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                       <!--  <th scope="col"><?= $this->Paginator->sort('image_path') ?></th> -->
                        <th scope="col"><?= $this->Paginator->sort('image_name') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resellers as $reseller): ?>
                    <tr>
                        <td><?= $this->Number->format($reseller->id) ?></td>
                        <td><?= h($reseller->org_name) ?></td>
                        <td><?= h($reseller->status) ?></td>
                        <!-- <td><?= h($reseller->image_path) ?></td> -->
                        <td><a href="<?= $reseller->image_url ?>" target="_blank"><?= $this->Html->image($reseller->image_url, array('height' => 100, 'width' => 100))?></a></td>

                        <td><a href="<?= $reseller->image_url ?>" target="_blank"><?= $this->Html->image($reseller->image_url, array('height' => 100, 'width' => 100))?></a></td>
                        <!-- <td><?= h($reseller->image_name) ?></td> -->
                        <td class="actions">
                                    <?= '<a href='.$this->Url->build(['action' => 'view', $reseller->id]).' class="btn btn-xs btn-success">' ?>
                                    <i class="fa fa-eye fa-fw"></i>
                                </a>
                                <?= '<a href='.$this->Url->build(['action' => 'edit', $reseller->id]).' class="btn btn-xs btn-warning"">' ?>
                                <i class="fa fa-pencil fa-fw"></i>
                                </a>
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $reseller->id], [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $reseller->id),
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
    </div>
</div>

<script>

    $(function () {

        // Initialize Example 1
        $('#example1').dataTable( {
            "ajax": 'api/datatables.json',
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {extend: 'copy',className: 'btn-sm'},
                {extend: 'csv',title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print',className: 'btn-sm'}
            ]
        });

        // Initialize Example 2
        $('#example2').dataTable();

    });

</script>
