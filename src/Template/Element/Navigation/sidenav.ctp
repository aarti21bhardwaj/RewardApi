<!-- Navigation -->
<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">
            <a href="#">
                <!-- <img src="img/profile.jpg" class="img-circle m-b" alt="logo"> -->
                <?= $this->Html->image("profile.jpeg", ['class'=>"img-circle m-b",'width'=>'80px']); ?>
            </a>

            <div class="stats-label text-color">
                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
        <span class="clear"> <span class="font-extra-bold font-uppercase"> <strong class="font-bold"><?= $sideNavData['first_name']?></strong>
        </span>  </span> </a>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <small class="text-muted"><b class="caret"></b></small>
                    </a>
                    <ul class="dropdown-menu animated flipInX m-t-xs">
                         <li><?= $this->Html->link(__('Profile'), ['controller' => 'Staffs', 'action' => 'edit', $sideNavData['id']]) ?></li>
                         <li><?= $this->Html->link(__('Logout'), ['controller'=>'Staffs','action' => 'logout']) ?></li>
                    </ul>
                </div>
            </div>
        </div>






        <ul class="nav" id="side-menu">
            <li class="active">
                <a href="#"> <span class="nav-label">Dashboard</span></a>
            </li>
            <!-- <li>
                <a href="analytics.html"> <span class="nav-label">Analytics</span><span class="label label-warning pull-right">NEW</span> </a>
            </li> -->
            <?php if($sideNavData['id'] == 1){ ?>
            <li>
                <a href="#"><span class="nav-label">Resellers</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                     <li><?= $this->Html->link(__('View All'), ['controller'=>'Resellers','action' => 'index']) ?></li>
                     <li><?= $this->Html->link(__('Add Reseller'), ['controller'=>'Resellers','action' => 'add']) ?></li>
                </ul>
            </li>
            <?php }?>
            <li>
                <a href="#"><span class="nav-label">Staff</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                     <li><?= $this->Html->link(__('View All'), ['controller'=>'Staffs','action' => 'index']) ?></li>
                     <li><?= $this->Html->link(__('Add Staff'), ['controller'=>'Staffs','action' => 'add']) ?></li>
                </ul>
            </li>
            <?php if($sideNavData['id'] == 1){ ?>
            <li>
                <a href="#"><span class="nav-label">Plans</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                     <li><?= $this->Html->link(__('View All'), ['controller'=>'Plans','action' => 'index']) ?></li>
                     <li><?= $this->Html->link(__('Add Plan'), ['controller'=>'Plans','action' => 'add']) ?></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">Features</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                     <li><?= $this->Html->link(__('View All'), ['controller'=>'Features','action' => 'index']) ?></li>
                     <li><?= $this->Html->link(__('Add Feature'), ['controller'=>'Features','action' => 'add']) ?></li>
                </ul>
            </li>
            <li>
                <a href="#"><span class="nav-label">Roles</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                     <li><?= $this->Html->link(__('View All'), ['controller'=>'Roles','action' => 'index']) ?></li>
                     <li><?= $this->Html->link(__('Add Role'), ['controller'=>'Roles','action' => 'add']) ?></li>
                </ul>
            </li>
            <?php }?>
            <li>
                <a href="#"><span class="nav-label">Programs</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                     <li><?= $this->Html->link(__('View All'), ['controller'=>'ResellerPrograms','action' => 'index']) ?></li>
            <?php if($sideNavData['id'] != 1){ ?>
                     <li><?= $this->Html->link(__('Add Program'), ['controller'=>'ResellerPrograms','action' => 'add']) ?></li>
             <?php }?>
                </ul>
            </li>
        </ul>
    </div>
</aside>
