<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-heading">
                <?= __('Edit Staff') ?>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($staff, ['data-toggle'=>'validator','class' => 'form-horizontal']) ?>
                <?php 
                //echo $this->Form->input('vendor_id', ['value' =>$loggedInUser['vendor_id'],'type'=>'hidden']); 
                //echo $this->Form->input('vendor_id', ['options' => $vendors]);
                ?>
                    <div class="hr-line-dashed"></div>
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
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <?= $this->Form->label('username', __('Username'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('username', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
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
                    <?php
                    if($loggedInUser['id'] == $staff->id)
                    {
                    ?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <?= $this->Form->label('name', __('Password'), ['class' => ['col-sm-2', 'control-label']]); ?>
                        <div class="col-sm-3">
                            <div class="">
                              <a data-toggle="modal" id="changePasswordButton" class="btn btn-primary" href="#changePasswordModal">Change Password</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                    <?= $this->Form->label('status', __('Status'), ['class' => ['col-sm-2', 'control-label']]); ?>
                        <div class="col-sm-3">
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
<!-- Model Window -->

</div>
<?= $this->Form->hidden('staffId',['value' => $staff->id]);?>
<div class="modal fade" tabindex="-1" role="dialog" id="changePasswordModal">
  <div class="modal-dialog" role="document">
    <?= $this->Form->create(null, ['class' => 'form-horizontal','data-toggle'=>"validator"]) ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= __('CHANGE_PASSWORD')?></h4>
      </div>

      <div class="modal-body">
      <div class="alert" id="rsp_msg" style=''>

        </div>
        <div class="form-group">
          <?= $this->Form->label('name', __('Old Password'), ['class' => ['col-sm-4', 'control-label']]); ?>
          <div class="col-sm-8">
           <?= $this->Form->input("old_pwd", array(
            "label" => false,
            'required' => true,
            'id'=>'old_pwd',
            "type"=>"password",
            "class" => "form-control",'data-minlength'=>8,
            'placeholder'=>"Enter Old Password"));
            ?>
            <div class="help-block with-errors"><?= __('PASSWORD_LENGTH')?></div>
          </div>
        </div>

        <div class="form-group">
          <?= $this->Form->label('name', __('New Password'), ['class' => ['col-sm-4', 'control-label']]); ?>
          <div class="col-sm-8">
           <?= $this->Form->input("new_pwd", array(
            "label" => false,
            'id'=>'new_pwd',
            "type"=>"password",
            'required' => true,
            "class" => "form-control",'data-minlength'=>8,
            'placeholder'=>"Enter New Password"));
            ?>
            <div class="help-block with-errors"><?= __('PASSWORD_LENGTH')?></div>
          </div>
        </div>

        <div class="form-group">
          <?= $this->Form->label('name', __('Confirm New Password'), ['class' => ['col-sm-4', 'control-label']]); ?>
          <div class="col-sm-8">
           <?= $this->Form->input("cnf_new_pwd", array(
            "label" => false,
            "type"=>"password",
            'id'=>'cnf_new_pwd',
            'required' => true,
            "class" => "form-control",'data-minlength'=>8,'data-match'=>"#new_pwd",'data-match-error'=>"__('MISMATCH')",'placeholder'=>"Confirm Password"));
            ?>
            <div class="help-block with-errors"><?= __('PASSWORD_LENGTH')?></div>
          </div>
        </div>


      </div>

      <div class="modal-footer text-center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <?= $this->Form->button(__('Submit'), ['class' => ['btn', 'btn-primary'],'id'=>"saveUserPassword"]) ?>
      </div>
      <?= $this->Form->end() ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
