<?php
/**
 * @var \App\View\AppView $this
 * @var bool $isAdmin
 */

$path = $this->request->getUri()->getPath();
?>

<div class="pmd-tabs pmd-tabs-bg">
    <div class="pmd-tab-active-bar"></div>
    <ul role="tablist" class="nav nav-tabs nav-justified">
        <li <?php if ('/categories' === $path): ?>class="active"<?php endif; ?> role="presentation">
            <a aria-controls="categories" href="<?= $this->Html->Url->build(['controller' => 'Categories']) ?>">
                <?= _('Categories') ?>
            </a>
        </li>
        <li <?php if ('/plans' === $path): ?>class="active"<?php endif; ?> role="presentation">
            <a aria-controls="plans" href="<?= $this->Html->Url->build(['controller' => 'Plans']) ?>">
                <?= _('Plans') ?>
            </a>
        </li>
        <li <?php if ('/servers' === $path): ?>class="active"<?php endif; ?> role="presentation">
            <a href="<?= $this->Html->Url->build(['controller' => 'Servers']) ?>">
                <?= _('Servers') ?>
            </a>
        </li>
        <?php if (true === $isAdmin): ?>
            <li <?php if ('/users' === $path): ?>class="active"<?php endif; ?> role="presentation">
                <a href="<?= $this->Html->Url->build(['controller' => 'Users']) ?>">
                    <?= _('Users') ?>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>