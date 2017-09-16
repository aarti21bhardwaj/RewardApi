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
?>
<div id="wrapper">
<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Invoice <small>IN-<?= $invoiceId ?></small></h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body p-xl">
                    <div class="row m-b-xl">
                        <div class="col-sm-6">
                            <h4>IN-<?= $invoiceId ?></h4>

                            <address>
                                <strong>Reward Api</strong><br>
                                <abbr title="Phone">Phone:</abbr> (831) 758-7200
                            </address>
                        </div>
                        <div class="col-sm-6 text-right">
                            <span>To:</span>
                            <address>
                                <abbr title="Name">Name:<strong><?= $resellerName ?></strong><br>
                                <abbr title="Email">Email:</abbr><?= $emailId ?><br>
                                <br>
                                <abbr title="Phone">Phone:</abbr> <?= $phoneNo ?>
                            </address>
                            <p>
                                <span><strong>Invoice Date:</strong> May 16, 2016</span><br/>
                                <span><strong>Due Date:</strong> May 24, 2016</span>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Item List</th>
                                <th>Amount</th>
                                <th>Tax</th>
                                <th>Total Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            	<tr>
                                <td>
                                   Plan
                                </td>
                                <td><?= $amount?></td>
                                <td>$5.98</td>
                                <td>$31,98</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row m-t">
                        <div class="col-md-4 col-md-offset-8">
                            <table class="table table-striped text-right">
                                <tbody>
                                <tr>
                                    <td><strong>Sub Total :</strong></td>
                                    <td><?= $amount ?></td>
                                </tr>
                                <tr>
                                    <td><strong>TAX :</strong></td>
                                    <td>$235.98</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>$1261.98</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="text-right">
                            	<a href = "localhost/rewardApis/invoice/authorize-net-profiles">Make Payment</a>
                                <!-- button class="btn btn-primary btn-sm"><i class="fa fa-dollar"></i> Make A Payment</button> -->
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

