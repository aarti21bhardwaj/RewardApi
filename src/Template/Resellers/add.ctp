<div class="row">
<div class="col-lg-12">
    <div class="hpanel">
        <div class="panel-body">
            <div class="panel-heading">
                <h5><?= __('Add Resellor') ?></h5>
            </div>
            <?= $this->Form->create($reseller, ['data-toggle'=>'validator','class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
            
                <div class="form-group">
                    <?= $this->Form->label('name', __('Organization Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('org_name', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                   <div class="form-group">
                    <?= $this->Form->label('name', __('Reseller Plan'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">

                       <?= $this->Form->select('reseller_plans.plan_id', $plans ,['label' => false, 'class' => ['form-control']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                   <div class="form-group">
                    <?= $this->Form->label('name', __('Pricing Type'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">

                       <?= $this->Form->select('reseller_pricing_rules.pricing_rule_id', $pricingRule ,['label' => false, 'class' => ['form-control']]); ?>
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
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('status', __('Status'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('status', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>

                <div class="panel-heading">
                <h5><?= __('Add Staff Admin') ?></h5>
                </div>
                <div class="hr-line-dashed"></div>
                   <div class="form-group">
                    <?= $this->Form->label('last_name', __('Last Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('user.last_name', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('first_name', __('First Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('user.first_name', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= $this->Form->label('email', __('Email'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('user.email', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= $this->Form->label('username', __('Username'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input("user.username", array(
                                        "label" => false, 
                                        'required' => true,
                                        "class" => "form-control"));
                    ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                 <div class="form-group">
                    <?= $this->Form->label('password', __('Password'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('user.password', ['label' => false, 'data-minlength' => 8, 'required' => true,'class' => ['form-control']]); ?>
                       <div class="help-block">Minimum of 8 characters</div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= $this->Form->label('phone', __('Phone'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('user.phone', array(
                                                "label" => false,
                                                'required' => true, 
                                                "placeholder" => "1(800)233-2742",
                                                "class" => "form-control"));
                        ?>
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