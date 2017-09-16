<div class="row">
<div class="col-lg-9">
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-b-md">
                            <h2><?= h($plan->name) ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                            <dt><?= __('Plan') ?>:</dt> <dd> <span class="label label-primary"><?= h($plan->name) ?></span> </dd></br>
                            <dt><?= __('Image') ?>:</dt> <dd> <a href="<?= $plan ?>" target="_blank"><?= $this->Html->image($plan->image_url, array('height' => 100, 'width' => 100))?></a></dd></br>
                            <dt><?= __('Status') ?>:</dt> <dd><?= h($plan->status) ? 'Enabled' : 'Disabled' ?></dd></br>
                            <dt><?= __('Pricing') ?>:</dt> <dd><?= h($plan->pricing) ?></dd></br>
                            </dl>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-lg-12 text-center">
                        <?= $this->Html->link('Back',$this->request->referer(),['class' => ['btn', 'btn-warning']]);?>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
