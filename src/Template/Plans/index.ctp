<?php

use App\Model\Entity\Category;
use App\Model\Entity\Plan;
use App\Model\Entity\Server;
use Cake\View\View;
use Cake\Datasource\ResultSetInterface;

/**
 * @var View $this
 * @var Plan[]|ResultSetInterface $plans
 * @var Plan $plan
 * @var Category[]|ResultSetInterface $categories
 * @var Server[]|ResultSetInterface $servers
 * @var bool $isAdmin
 * @var array $planDropdownList
 * @var int $selectedServerId
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

                        <h2><?= __('Create plan') ?></h2>
                        <?php if ($categories->count() > 0 && $servers->count() > 0): ?>
                            <div class="well">
                                <?= $this->Form->create($plan) ?>
                                    <?= $this->Form->control('name', ['class' => 'form-control']) ?>
                                    <?= $this->Form->control('server_id', ['type' => 'select', 'options' => $servers]) ?>
                                    <?= $this->Form->control('category_id', ['type' => 'select', 'options' => $categories]) ?>
                                    <?= $this->Form->control('key', ['label' => __('Plan'), 'type' => 'select', 'options' => $planDropdownList, 'class' => 'form-control']) ?>
                                    <?= $this->Form->control('error_text', ['class' => 'form-control']) ?>
                                    <?= $this->Form->button(__('Add plan'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        <?php else: ?>
                            <div role="alert" class="alert alert-danger">
                                <?= __('Create at least one category and server before you can create plans.') ?>
                            </div>
                        <?php endif; ?>

                        <h2><?= __('Plans') ?></h2>
                        <?php if ($plans->count() > 0): ?>
                            <?php foreach ($plans as $plan): ?>
                                <div class="pmd-card pmd-z-depth Info">
                                    <div class="pmd-card-title">
                                        <h3 class="pmd-card-title-text">
                                            <?= $plan->key ?>
                                            <span class="badge badge-inverse">
                                                <i class="material-icons md-light pmd-xxs">
                                                    local_offer
                                                </i>
                                                <?= $plan->category->name ?>
                                            </span>
                                            <span class="badge badge-inverse">
                                                <i class="material-icons md-light pmd-xxs">
                                                    laptop_mac
                                                </i>
                                                <?= $plan->server->name ?>
                                            </span>
                                            <div class="cta-actions pull-right">
                                                <a class="btn btn-sm pmd-ripple-effect btn-warning" href="<?= $this->Html->Url->build(['controller' => 'Plans', 'action' => 'edit', $plan->id]) ?>">
                                                    <?= __('edit') ?>
                                                </a>
                                                <?php if (true === $isAdmin): ?>
                                                    <button data-target="#alert-dialog-<?= $plan->id ?>" data-toggle="modal" class="btn btn-sm pmd-ripple-effect btn-danger" type="button"><?= __('delete') ?></button>
                                                    <div tabindex="-1" class="modal fade" id="alert-dialog-<?= $plan->id ?>" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h2 class="pmd-card-title-text"><?= __('Confirm deletion') ?></h2>
                                                                </div>
                                                                <div class="modal-body"><?= __('The following plan will be deleted: ') . $plan->key ?></div>
                                                                <div class="pmd-modal-action pmd-modal-bordered text-right">
                                                                    <a href="<?= $this->Html->Url->build(['controller' => 'Plans', 'action' => 'delete', $plan->id]) ?>" class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="button"><?= __('confirm') ?></a>
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
                                <?= __('No plans.') ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <?= $this->element('Admin/fab') ?>
    </div>
</div>