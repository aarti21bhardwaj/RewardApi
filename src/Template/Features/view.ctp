<div class = "row">
    <div class="col-lg-12">
         <div class="hpanel">
            <div class="panel-body">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <h2><?= h($feature->name) ?></h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                    <dt><?= __('Feature Name') ?>:</dt> 
                                        <dd>
                                            <span class="label label-success"><?= h($feature->name) ?></span>
                                        </dd>
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
</div>
