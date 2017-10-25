<?php

use App\Model\Entity\User;
use Cake\View\View;

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
        <h1><?= __('Change password') ?></h1>
        <div class="pmd-card pmd-card-default pmd-z-depth pmd-card-custom-form">
            <div class="pmd-card-body">
                <?= $this->Flash->render() ?>

                <div role="alert" class="alert alert-info ">
                    <?= __('The password must be between 8 and 30 characters long and have at lest one uppercase character, one lowercase character, one digit and finally one special character.') ?>
                </div>

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