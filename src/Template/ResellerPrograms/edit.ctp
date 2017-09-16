<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-heading">
                <?= __('Edit Program') ?>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($resellerProgram, ['data-toggle'=>'validator','class' => 'form-horizontal']) ?>
                <?php if($loggedinUser)
                { 
                    ?>
                    <div class="form-group">
                     <!--  <?= $this->Form->label('reseller_id', __('Reseller Name'), ['class' => ['col-sm-2', 'control-label'], 'type' => 'hidden']); ?> -->
                     <div class="col-sm-10">
                         <?= $this->Form->input('reseller_id', ['label' => false, 'required' => true, 'class' => ['form-control'], 'options' => $resellers, 'value' => $loggedinUser['reseller_id'] , 'type' => 'hidden']); ?>
                     </div>
                 </div>
                 <?php } ?>
                 <div class="hr-line-dashed"></div>
                 <div class="form-group">
                    <?= $this->Form->label('program_name', __('Program Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                     <?= $this->Form->input('program_name', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
                 </div>
             </div>

             <div class="hr-line-dashed"></div>
             <div class="form-group">
                <?= $this->Form->label('features', __('Features'), ['class' => ['col-sm-2', 'control-label']]); ?>
            </div>
            <div class="form-group">

                <?php foreach($features as $feature): ?>
                    <div class="row col-lg-offset-3">
                        <div class="col-sm-10">
                            <?php 
                                $checked = false;
                                if(isset($checkedfeatures) && !empty($checkedfeatures))
                                {
                                    $checked = 'checked';
                                }
                                // pr($checked); die;
                            ?>
                            <div class="col-sm-1">
                             <?= $this->Form->checkbox('features[]', ['id' => isset($checkedfeatures[0]->id)? $checkedfeatures[0]->id:'','value' => $feature ,'multiple' => true, 'hiddenField' => false , 'checked'=>$checked,'class' => ['icheckbox_square-green checked']]); ?>
                         </div>
                         <div class="col-sm-4">
                            <?= $this->Form->label('features', __($feature)); ?>
                        </div>
                    </div>
                </div>


            <?php endforeach; ?>
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
