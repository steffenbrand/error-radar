<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>

<div class="row">
    <div class="col-md-12">
        <h1><?= __('Login') ?></h1>
        <div class="pmd-card pmd-card-default pmd-z-depth pmd-card-custom-form">
            <div class="pmd-card-body">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create() ?>
                    <?= $this->Form->control('username', ['class' => 'form-control']) ?>
                    <?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control']) ?>
                    <?= $this->Form->button(__('Login'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<div class="menu pmd-floating-action">
    <a href="<?= $this->Html->Url->build(['controller' => 'Dashboard']) ?>" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-success" data-title="<?= __('Back to dashboard') ?>">
        <i class="material-icons pmd-sm">view_comfy</i>
    </a>
</div>