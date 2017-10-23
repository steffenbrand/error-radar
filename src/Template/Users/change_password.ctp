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
        <h1><?= __('Change password') ?></h1>
        <div class="pmd-card pmd-card-default pmd-z-depth pmd-card-custom-form">
            <div class="pmd-card-body">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create() ?>
                    <?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control']) ?>
                    <?= $this->Form->control('password-repeat', ['type' => 'password', 'class' => 'form-control']) ?>
                    <?= $this->Form->button(__('Change password'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->element('Admin/fab') ?>