<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface $categories
 * @var string $columnClass
 */
?>

<h1><?= __('Admin') ?></h1>

<div class="pmd-card pmd-z-depth">
    <div class="pmd-tabs pmd-tabs-bg">
        <div class="pmd-tab-active-bar"></div>
        <ul role="tablist" class="nav nav-tabs nav-justified">
            <li class="active" role="presentation">
                <a data-toggle="tab" role="tab" aria-controls="categories" href="#categories-fixed">
                    <?= _('Categories') ?>
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" role="tab" aria-controls="plans" href="#plans-fixed">
                    <?= _('Plans') ?>
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" role="tab" aria-controls="servers" href="#servers-fixed">
                    <?= _('Servers') ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="pmd-card-body">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="categories-fixed">
                <h2><?= __('Categories') ?></h2>
                <?php if ($categories->count() > 0): ?>
                    <?php foreach ($categories as $category): ?>
                        <div class="pmd-card pmd-z-depth Info">
                            <div class="pmd-card-title">
                                <h3 class="pmd-card-title-text">
                                    <?= $category->name ?>
                                    <span class="badge badge-inverse"><?= count($category->plans) ?></span>
                                </h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        <?= __('No categories.') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="plans-fixed">
                Fixed tabs have equal width, calculated either as the view width divided
                by the number of tabs, or based on the widest tab label.
                To navigate between fixed tabs, touch the tab or swipe the content area left or right.
            </div>
            <div role="tabpanel" class="tab-pane" id="servers-fixed">
                To navigate between scrollable tabs, touch the tab or swipe the
                content area left or right. To scroll the tabs without navigating,
                swipe the tabs left or right.
            </div>
        </div>
    </div>
</div>

<div class="pmd-floating-action">
    <a href="<?= $this->Html->Url->build('/') ?>" class="btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" type="button">
        <i class="material-icons pmd-sm">view_week</i>
    </a>
</div>