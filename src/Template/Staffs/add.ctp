<div class="row">
<div class="col-lg-12">
    <div class="hpanel">
        <div class="panel-heading">
            <?= __('Add User') ?>
        </div>
        <div class="panel-body">
            <?= $this->Form->create($staff, ['data-toggle'=>'validator','class' => 'form-horizontal']) ?>
            <?php 
            //echo $this->Form->input('vendor_id', ['value' =>$loggedInUser['vendor_id'],'type'=>'hidden']); 
            //echo $this->Form->input('vendor_id', ['options' => $vendors]);
            ?>
                <div class="form-group">
                    <?php if($loggedInUser['role_id'] == 1){ ?>
                    <?= $this->Form->label('reseller_id', __('Reseller Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('reseller_id', ['label' => false, 'required' => true, 'class' => ['form-control'], 'options' => $resellers ]); ?>
                    </div>
                    <?php } else {?>
                    <?= $this->Form->input('reseller_id', ['value' =>$loggedInUser['reseller_id'],'type'=>'hidden']); ?>
                    <?php } ?>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('role_id', __('Role'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('role_id', ['label' => false,'class' => ['form-control m-b'], 'options' => $roles]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('first_name', __('First Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('first_name', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('last_name', __('Last Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('last_name', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="form-group">
                <?= $this->Form->label('username', __('Username'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('username', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="form-group">
                <?= $this->Form->label('email', __('Email'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('email', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('phone', __('Phone'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('phone', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                 <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('password', __('Password'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('password', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('status', __('Status'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('status', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                    <?= $this->Form->button(__('Submit'), ['id'=>'check_submit','class' => ['btn', 'btn-primary']]) ?>
                    <?= $this->Html->link('Cancel',$this->request->referer(),['id'=>'check_cancel','class' => ['btn', 'btn-danger']]);?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>
