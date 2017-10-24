<?php

use Cake\View\View;

/**
 * @var View $this
 * @var bool $isAdmin
 */

$path = $this->request->getUri()->getPath();
?>

<div class="pmd-tabs pmd-tabs-bg">
    <div class="pmd-tab-active-bar"></div>
    <ul role="tablist" class="nav nav-tabs nav-justified">
        <li <?php if (strpos($path, '/categories') !== false): ?>class="active"<?php endif; ?> role="presentation">
            <a aria-controls="categories" href="<?= $this->Html->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>">
                <?= _('Categories') ?>
            </a>
        </li>
        <li <?php if (strpos($path, '/plans') !== false): ?>class="active"<?php endif; ?> role="presentation">
            <a aria-controls="plans" href="<?= $this->Html->Url->build(['controller' => 'Plans', 'action' => 'index']) ?>">
                <?= _('Plans') ?>
            </a>
        </li>
        <li <?php if (strpos($path, '/servers') !== false): ?>class="active"<?php endif; ?> role="presentation">
            <a href="<?= $this->Html->Url->build(['controller' => 'Servers', 'action' => 'index']) ?>">
                <?= _('Servers') ?>
            </a>
        </li>
        <?php if (true === $isAdmin): ?>
            <li <?php if (strpos($path, '/users') !== false): ?>class="active"<?php endif; ?> role="presentation">
                <a href="<?= $this->Html->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">
                    <?= _('Users') ?>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>