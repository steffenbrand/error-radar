<?php

use App\Model\Entity\Server;
use Cake\View\View;
use Cake\Datasource\ResultSetInterface;

/**
 * @var View $this
 * @var Server[]|ResultSetInterface $servers
 * @var Server $server
 * @var bool $isAdmin
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
                    <div role="tabpanel" class="tab-pane active">

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
                                            <div class="cta-actions pull-right">
                                                <a class="btn btn-sm pmd-ripple-effect btn-warning" href="<?= $this->Html->Url->build(['controller' => 'Servers', 'action' => 'edit', $server->id]) ?>">
                                                    <?= __('edit') ?>
                                                </a>
                                                <?php if (true === $isAdmin): ?>
                                                    <button data-target="#alert-dialog-<?= $server->id ?>" data-toggle="modal" class="btn btn-sm pmd-ripple-effect btn-danger" type="button"><?= __('delete') ?></button>
                                                    <div tabindex="-1" class="modal fade" id="alert-dialog-<?= $server->id ?>" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h2 class="pmd-card-title-text"><?= __('Confirm deletion') ?></h2>
                                                                </div>
                                                                <div class="modal-body"><?= count($server->plans) . ' ' . __('plans of this server will be deleted.') ?></div>
                                                                <div class="pmd-modal-action pmd-modal-bordered text-right">
                                                                    <a href="<?= $this->Html->Url->build(['controller' => 'Servers', 'action' => 'delete', $server->id]) ?>" class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="button"><?= __('confirm') ?></a>
                                                                    <button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="button"><?= __('discard') ?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
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