<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface $plans
 */
?>

<?= $this->element('Admin/head') ?>
<div class="pmd-card pmd-z-depth">
    <?= $this->element('Admin/tabs') ?>
    <div class="pmd-card-body">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="plans-fixed">
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
        </div>
    </div>
</div>
<?= $this->element('Admin/fab') ?>