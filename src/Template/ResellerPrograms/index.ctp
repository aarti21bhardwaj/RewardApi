<div class="resellerPrograms index large-9 medium-8 columns content">
    <h3><?= __('Reseller Programs') ?></h3>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Reseller Name</th>
                <th scope="col">Program Name</th>
                <th>Clone Program</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resellerPrograms as $resellerProgram): ?>
                <tr>
                    <td><?= $this->Number->format($resellerProgram->id) ?></td>
                    <td><?= h($resellerProgram->reseller->org_name)?></td>
                    <td><?= h($resellerProgram->program_name) ?></td>
                            <td><?= $this->Form->input(__('Clone'), ['class' => "btn btn-primary clone-program","label"=>false, "data-program-id"=>$resellerProgram->id,'type' => 'button']) ?></td>
                    <td class="actions">
                        <?= '<a href='.$this->Url->build(['action' => 'view', $resellerProgram->id]).' class="btn btn-xs btn-success">' ?>
                        <i class="fa fa-eye fa-fw"></i></a>
                        <?= '<a href='.$this->Url->build(['action' => 'edit', $resellerProgram->id]).' class="btn btn-xs btn-warning"">' ?>
                        <i class="fa fa-pencil fa-fw"></i></a>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $resellerProgram->id], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $resellerProgram->id),
                            'class' => ['btn', 'btn-sm', 'btn-danger', 'fa', 'fa-trash-o', 'fa-fh']]) ?> </a>
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

    <!-- Model Window -->


    <div class="modal fade" tabindex="-1" role="dialog" id="cloneModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?= __('Clone Program')?></h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-sm-3">
                    <?= $this->Form->label('program_name', __('Program Name')); ?>
                </div>

                <div class="col-sm-9">
                <?= $this->Form->hidden('selected-program-id',['id' => 'selected-program-id']);?>
                 <?= $this->Form->input("program_name", array(
                    "label" => false,
                    'required' => true,
                    'id'=>'program_name',
                    "type"=>"text",
                    "class" => "form-control",
                    'placeholder'=>"Enter New Program Name"));
                    ?>
                </div>    
            </div>
            <div class="row m-t-lg">
                <div class="col-sm-15">
                    <?= $this->Form->label('Features', __('Features in Selected Program'),['id'=>'featureListInProgram']); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer text-center">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <?= $this->Form->button(__('Submit'), ['class' => ['btn', 'btn-primary'],'id'=>"submitCloneRequest"]) ?>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
