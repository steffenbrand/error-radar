<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Server[]|\Cake\Datasource\ResultSetInterface $servers
 */

$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>

<?= $this->element('Admin/head') ?>
<div class="pmd-card pmd-z-depth">
    <?= $this->element('Admin/tabs') ?>
    <div class="pmd-card-body">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="servers-fixed">
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
                        <?= __('No servers.') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Admin/fab') ?>