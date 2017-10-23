<?php
/** @var $this Cake\View\View */
/** @var $user \App\Model\Entity\User */

$this->layout = 'Backend/default';
$this->assign('title', __('Add user'));
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <?= $this->Form->create($user, ['data-toggle' => 'validator']) ?>
                    <div class="form-group">
                        <?= $this->Form->control('username', ['label' => __('Username'), 'class' => 'form-control', 'required', 'data-remote' => $this->Url->build('/users/validate-username'), 'data-error' => __('This field is mandatory and unique.')]) ?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('role', ['label' => __('Role'), 'options' => ['admin' => __('Admin'), 'user' => __('User')], 'class' => 'form-control', 'required', 'data-error' => __('This field is mandatory.')]) ?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('password', ['type' => 'password', 'label' => __('Password'), 'class' => 'form-control', 'required', 'data-remote' => $this->Url->build('/users/validate-password'), 'data-error' => __('This field is mandatory and must match password policy.')]) ?>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="row form-submit">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-block btn-default"><i class="fa fa-plus"></i> <?= __('Add user') ?></button>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>