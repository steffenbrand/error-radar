<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Server[]|\Cake\Datasource\ResultSetInterface $servers
 * @var \App\Model\Entity\Server $server
 */

$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>

<div class="row">
    <div class="col-md-12">
        <?= $this->element('Admin/head') ?>
        <div class="pmd-card pmd-z-depth">
            <?= $this->element('Admin/tabs') ?>
            <div class="pmd-card-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="servers-fixed">

                        <?= $this->Flash->render() ?>

                        <h2><?= __('Create server') ?></h2>
                        <div class="well">
                            <?= $this->Form->create($server) ?>
                            <?= $this->Form->control('name', ['class' => 'form-control']) ?>
                            <?= $this->Form->control('type', ['type' => 'select', 'options' => ['bamboo' => 'Bamboo'], 'label' => __('Type')]) ?>
                            <?= $this->Form->control('url', ['class' => 'form-control']) ?>
                            <?= $this->Form->control('username', ['class' => 'form-control']) ?>
                            <?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control']) ?>
                            <?= $this->Form->button(__('Add server'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                            <?= $this->Form->end() ?>
                        </div>

                        <h2><?= __('Servers') ?></h2>
                        <?php if ($servers->count() > 0): ?>
                            <?php foreach ($servers as $server): ?>
                                <div class="pmd-card pmd-z-depth Info">
                                    <div class="pmd-card-title">
                                        <h3 class="pmd-card-title-text">
                                            <?= $server->name ?>
                                            <span class="badge badge-inverse"><?= count($server->plans) ?></span>
                                            <a class="btn btn-sm pmd-ripple-effect btn-danger"
                                               href="<?= $this->Html->Url->build(['controller' => 'Servers', 'action' => 'delete', $server->id]) ?>">
                                                <?= __('delete') ?>
                                            </a>
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
    </div>
</div>