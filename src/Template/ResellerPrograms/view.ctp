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
                                        <h2><?= h($resellerProgram->program_name) ?></h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                    <dt><?= __('Reseller Name') ?>:</dt> 
                                        <dd>
                                            <span class="label label-success"><?= h($resellerProgram->reseller->org_name) ?></span>
                                        </dd>
                                    </dl> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt><?= __('Program Name') ?>:</dt> <dd> <?= h($resellerProgram->program_name) ?> </dd>
                                         <!-- <dt><?= __('Features') ?>:</dt> <dd> <?= h($resellerProgram->resellerProgramFeatures['id']) ?> </dd> -->
                                         <dt><?= __('Features') ?>:</dt>
                        <?php foreach ($resellerProgram->reseller_program_features as $key => $resellerProgramFeature) {?>
                             <dd> <?= h($resellerProgramFeature->feature->name) ?> </dd>
                        <?php } ?>
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
