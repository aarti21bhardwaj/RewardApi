<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('plugins/fontawesome/css/font-awesome.css') ?>
    <?= $this->Html->css('plugins/metisMenu/dist/metisMenu.css') ?>
    <?= $this->Html->css('plugins/animate.css/animate.css') ?>
    <?= $this->Html->css('plugins/bootstrap/dist/css/bootstrap.css') ?>
    <?= $this->Html->css('plugins/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') ?>

    <?= $this->Html->script('plugins/jquery/dist/jquery.min.js') ?>
    <?= $this->Html->script('plugins/jquery-ui/jquery-ui.min.js"') ?>
    <?= $this->Html->script('plugins/slimScroll/jquery.slimscroll.min.js') ?>
    <?= $this->Html->script('plugins/bootstrap/dist/js/bootstrap.min.js') ?>
    <?= $this->Html->script('plugins/jquery-flot/jquery.flot.js') ?>
    <?= $this->Html->script('plugins/jquery-flot/jquery.flot.resize.js') ?>
    <?= $this->Html->script('plugins/jquery-flot/jquery.flot.pie.js') ?>
    <?= $this->Html->script('plugins/flot.curvedlines/curvedLines.js') ?>
    <?= $this->Html->script('plugins/jquery.flot.spline/index.js') ?>
    <?= $this->Html->script('plugins/metisMenu/dist/metisMenu.min.js') ?>
    <?= $this->Html->script('plugins/iCheck/icheck.min.js') ?>
    <?= $this->Html->script('plugins/peity/jquery.peity.min.js') ?>
    <?= $this->Html->script('plugins/sparkline/index.js') ?>
   
    <?= $this->Html->script('homer.js') ?>
    <?= $this->Html->script('charts.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="blank">
<div class="color-line"></div>
    <?= $this->Flash->render('auth', ['element' => 'Flash/error']) ?>
    <?= $this->Flash->render() ?>
    <div class="login-container">

        <?= $this->fetch('content') ?>
    </div>
</body>
</html>