<?php

use App\View\AppView;

/**
 * @var AppView $this
 */
?>

<div class="menu pmd-floating-action" role="navigation">
    <a href="<?= $this->Html->Url->build(['controller' => 'Users', 'action' => 'changePassword']) ?>" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-warning" data-title="<?= __('Change password') ?>">
        <i class="material-icons">lock</i>
    </a>
    <a href="<?= $this->Html->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-warning" data-title="<?= __('Logout') ?>">
        <i class="material-icons">cancel</i>
    </a>
    <a href="<?= $this->Html->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" data-title="<?= __('Back to settings') ?>">
        <i class="material-icons">settings</i>
    </a>
    <a href="<?= $this->Html->Url->build(['controller' => 'Dashboard']) ?>" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-success" data-title="<?= __('Back to dashboard') ?>">
        <i class="material-icons pmd-sm">view_comfy</i>
    </a>
</div>