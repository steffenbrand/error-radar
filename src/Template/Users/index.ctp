<?php

use App\Model\Entity\User;
use App\View\AppView;
use Cake\Datasource\ResultSetInterface;

/**
 * @var AppView $this
 * @var User[]|ResultSetInterface $users
 * @var User $user
 * @var User $backendUser
 * @var bool $isAdmin
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
                    <div role="tabpanel" class="tab-pane active" id="servers-fixed">

                        <?= $this->Flash->render() ?>

                        <h2><?= __('Create user') ?></h2>
                        <div class="well">
                            <?= $this->Form->create($user) ?>
                                <?= $this->Form->control('username', ['class' => 'form-control']) ?>
                                <?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control']) ?>
                                <?= $this->Form->control('role', ['label' => __('Role'), 'options' => ['admin' => __('Admin'), 'user' => __('User')], 'class' => 'form-control', 'required', 'data-error' => __('This field is mandatory.')]) ?>
                                <?= $this->Form->button(__('Add user'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                            <?= $this->Form->end() ?>
                        </div>

                        <h2><?= __('Users') ?></h2>
                        <?php if ($users->count() > 0): ?>
                            <?php foreach ($users as $user): ?>
                                <div class="pmd-card pmd-z-depth Info">
                                    <div class="pmd-card-title">
                                        <h3 class="pmd-card-title-text">
                                            <?= $user->username ?>
                                            <?php if (true === $isAdmin && $user->id !== $backendUser['id']): ?>
                                                <a class="btn btn-sm pmd-ripple-effect btn-danger" href="<?= $this->Html->Url->build(['controller' => 'Users', 'action' => 'delete', $user->id]) ?>">
                                                    <?= __('delete') ?>
                                                </a>
                                            <?php endif; ?>
                                        </h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-warning" role="alert">
                                <?= __('No users.') ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <?= $this->element('Admin/fab') ?>
    </div>
</div>