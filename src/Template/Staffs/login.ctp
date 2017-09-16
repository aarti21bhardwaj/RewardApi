<div class="row">
    <div class="col-md-12">
        <div class="text-center m-b-md">
            <h3><?= __('Login')?></h3>
        </div>
        <div class="hpanel">
            <div class="panel-body">
                    <?= $this->Form->create(null); ?>
                        <div class="form-group">
                            <label class="control-label" for="username">Username</label>
                            <?= $this->Form->Input('username', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Username', 'required'=>'required']); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <?= $this->Form->Input('password', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Password', 'required'=>'required']) ?>
                        </div>
                        <button class="btn btn-success btn-block">Login</button>
                    <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>