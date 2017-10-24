<?php

use App\Model\Entity\User;
use Cake\View\View;
use Cake\Datasource\ResultSetInterface;

/**
 * @var View $this
 * @var User $user
 */

$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>

<div class="row">
    <div class="col-md-12">
        <?= $this->element('Admin/head') ?>
        <div class="pmd-card pmd-z-depth">
            <?= $this->element('Admin/tabs') ?>
            <div class="pmd-card-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="users-fixed">

                        <?= $this->Flash->render() ?>

                        <h2><?= __('Edit user') ?></h2>
                        <div class="well">
                            <?= $this->Form->create($user) ?>
                                <?= $this->Form->control('username', ['class' => 'form-control']) ?>
                                <?= $this->Form->control('role', ['label' => __('Role'), 'options' => ['admin' => __('Admin'), 'user' => __('User')], 'class' => 'form-control', 'required', 'data-error' => __('This field is mandatory.')]) ?>
                                <?= $this->Form->button(__('Edit user'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-warning']) ?>
                            <?= $this->Form->end() ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?= $this->element('Admin/fab') ?>
    </div>
</div>