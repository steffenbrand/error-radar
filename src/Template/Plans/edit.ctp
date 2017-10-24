<?php

use App\Model\Entity\Category;
use App\Model\Entity\Server;
use Cake\Datasource\ResultSetInterface;
use Cake\View\View;

/**
 * @var View $this
 * @var Category[]|ResultSetInterface $categories
 * @var Server[]|ResultSetInterface $servers
 * @var \App\Model\Entity\Plan $plan
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

                        <h2><?= __('Edit plan') ?></h2>
                        <div class="well">
                            <?= $this->Form->create($plan) ?>
                            <?= $this->Form->control('key', ['class' => 'form-control']) ?>
                            <?= $this->Form->control('error_text', ['class' => 'form-control']) ?>
                            <?= $this->Form->control('server_id', ['type' => 'select', 'options' => $servers]) ?>
                            <?= $this->Form->control('category_id', ['type' => 'select', 'options' => $categories]) ?>
                            <?= $this->Form->button(__('Edit plan'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                            <?= $this->Form->end() ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?= $this->element('Admin/fab') ?>
    </div>
</div>