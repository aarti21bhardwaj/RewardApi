<div class="row">
<div class="col-lg-9">
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-b-md">
                            <h2><?= h($reseller->org_name) ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                            <dt><?= __('Reseller Name') ?>:</dt> <dd> <span class="label label-primary"><?= h($reseller->org_name) ?></span> </dd></br>
                            <dt><?= __('Image') ?>:</dt> <dd> <a href="<?= $reseller ?>" target="_blank"><?= $this->Html->image($reseller->image_url, array('height' => 100, 'width' => 100))?></a></dd></br>
                            <dt><?= __('Status') ?>:</dt> <dd><?= h($reseller->status) ? 'Enabled' : 'Disabled' ?></dd></br>
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