<?php

use Cake\View\View;

/**
 * @var View $this
 */
?>

<div class="menu pmd-floating-action" role="navigation">
    <a href="<?= $this->Html->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-danger" data-title="<?= __('Logout') ?>">
        <i class="material-icons">exit_to_app</i>
    </a>
    <a href="<?= $this->Html->Url->build(['controller' => 'Users', 'action' => 'changePassword']) ?>" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-warning" data-title="<?= __('Change password') ?>">
        <i class="material-icons">lock_outline</i>
    </a>
    <?php if ('/users/changePassword' === $this->request->getUri()->getPath()): ?>
        <a href="<?= $this->Html->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" data-title="<?= __('Back to settings') ?>">
            <i class="material-icons">settings</i>
        </a>
    <?php endif; ?>
    <a href="<?= $this->Html->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-success" data-title="<?= __('Back to dashboard') ?>">
        <i class="material-icons pmd-sm">view_comfy</i>
    </a>
</div>