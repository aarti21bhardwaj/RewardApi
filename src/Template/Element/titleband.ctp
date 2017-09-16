<?php 
// pr($this->request);die; 
//Inflecting the names of the controller
$underscore = \Cake\Utility\Inflector::underscore($this->request->params['controller']);
$humanize = \Cake\Utility\Inflector::humanize($underscore);

$underscoreAction = \Cake\Utility\Inflector::underscore($this->request->params['action']);
$humanizeAction = \Cake\Utility\Inflector::humanize($underscoreAction);

?>
    <div class="transition animated fadeIn small-header">
        <div class="hpanel">
            <div class="panel-body">
                <h2 class="font-light m-b-xs">
                    <strong><?= $humanize; //ucfirst($this->request->params['action']) ?></strong>
                </h2>
                <div id="hbreadcrumb" >
                    <ol class="hbreadcrumb breadcrumb" style="margin-bottom: 0px;">
                        <li>
                            <a href="javascript:void(0)">Home</a>
                        </li>
                        <li><?= $this->Html->link($humanize,"/".$this->request->params['controller']); ?></li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
