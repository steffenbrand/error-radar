<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface $categories
 * @var \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface $plans
 * @var \App\Model\Entity\Server[]|\Cake\Datasource\ResultSetInterface $servers
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
                <h2><?= __('Plans') ?></h2>
                <?php if ($plans->count() > 0): ?>
                    <?php foreach ($plans as $plan): ?>
                        <div class="pmd-card pmd-z-depth Info">
                            <div class="pmd-card-title">
                                <h3 class="pmd-card-title-text">
                                    <?= $plan->key ?>
                                    <span class="badge badge-inverse">
                                        <i class="material-icons md-light pmd-xxs">
                                            style
                                        </i>
                                        <?= $plan->category->name ?>
                                    </span>
                                    <span class="badge badge-inverse">
                                        <i class="material-icons md-light pmd-xxs">
                                            laptop_mac
                                        </i>
                                        <?= $plan->server->name ?>
                                    </span>
                                </h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        <?= __('No plans.') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="servers-fixed">
                <h2><?= __('Servers') ?></h2>
                <?php if ($servers->count() > 0): ?>
                    <?php foreach ($servers as $server): ?>
                        <div class="pmd-card pmd-z-depth Info">
                            <div class="pmd-card-title">
                                <h3 class="pmd-card-title-text">
                                    <?= $server->name ?>
                                    <span class="badge badge-inverse"><?= count($server->plans) ?></span>
                                </h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        <?= __('No plans.') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="pmd-floating-action">
    <a href="<?= $this->Html->Url->build('/') ?>" class="btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" type="button">
        <i class="material-icons pmd-sm">view_week</i>
    </a>
</div>