<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reseller->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reseller->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Resellers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reseller Programs'), ['controller' => 'ResellerPrograms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reseller Program'), ['controller' => 'ResellerPrograms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="resellers form large-9 medium-8 columns content">
    <?= $this->Form->create($reseller) ?>
    <fieldset>
        <legend><?= __('Edit Reseller') ?></legend>
        <?php
            echo $this->Form->input('org_name');
            echo $this->Form->input('status');
            echo $this->Form->input('image_path');
            echo $this->Form->input('image_name');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div> -->

<div class="row">
<div class="col-lg-12">
    <div class="hpanel">
        <div class="panel-heading">
            <?= __('Edit Resellor') ?>
        </div>
        <div class="panel-body">
            <?= $this->Form->create($reseller, ['data-toggle'=>'validator','class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
            <?php 
            //echo $this->Form->input('vendor_id', ['value' =>$loggedInUser['vendor_id'],'type'=>'hidden']); 
            //echo $this->Form->input('vendor_id', ['options' => $vendors]);
            ?>
                <div class="form-group">
                    <?= $this->Form->label('name', __('Organization Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('org_name', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('image_path', __('Image Upload'), ['class' => 'col-sm-2 control-label','id'=>'upload-img']); ?>

                    <div class="col-sm-4">
                        <div class="img-thumbnail">
                            <?= $this->Html->image($reseller->image_url, array('height' => 100, 'width' => 100,'id'=>'upload-img')); ?>
                        </div>
                        <br> </br>
                        <?= $this->Form->input('image_name', ['accept'=>"image/*",'label' => false,'required' => true,['class' => 'form-control'],'type' => "file",'id'=>'imgChange']); ?>
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
<style type ="text/style">
.img-thumbnail {
background: #fff none repeat scroll 0 0;
height: 200px;
margin: 10px 5px;
padding: 0;
position: relative;
width: 200px;
}
.img-thumbnail img {
border: 1px solid #dcdcdc;
max-width: 100%;
object-fit: cover;
}
</style>
<script type ="text/javascript">
    /**
    * @method uploadImage
    @return null
    */    
    function uploadImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#upload-img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgChange").change(function(){
        uploadImage(this);
    });
</script>
