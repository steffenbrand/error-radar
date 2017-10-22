<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface $categories
 * @var string $columnClass
 */
?>

<div class="row">
    <div class="col-md-12">
        <h1><?= __('Admin') ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    <?php if ($categories->count() > 0): ?>
        <h2><?= __('Categories') ?></h2>
        <?php foreach ($categories as $category): ?>
            <div class="pmd-card pmd-z-depth">
                <div class="pmd-card-title">
                    <h3 class="pmd-card-title-text">
                        <?= $category->name ?>
                        <span class="badge badge-inverse"><?= count($category->plans) ?></span>
                    </h3>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>

    <?php endif; ?>
</div>

<div class="pmd-floating-action">
    <a href="<?= $this->Html->Url->build('/') ?>" class="btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" type="button">
        <i class="material-icons pmd-sm">view_week</i>
    </a>
</div>