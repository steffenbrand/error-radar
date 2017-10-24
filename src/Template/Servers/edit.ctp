<?php

use App\Model\Entity\Server;
use Cake\View\View;

/**
 * @var View $this
 * @var Server $server
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

                        <h2><?= __('Edit server') ?></h2>
                        <div class="well">
                            <?= $this->Form->create($server) ?>
                                <?= $this->Form->control('name', ['class' => 'form-control']) ?>
                                <?= $this->Form->control('type', ['type' => 'select', 'options' => ['bamboo' => 'Bamboo'], 'label' => __('Type')]) ?>
                                <?= $this->Form->control('url', ['class' => 'form-control']) ?>
                                <?= $this->Form->control('username', ['class' => 'form-control']) ?>
                                <?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control']) ?>
                                <?= $this->Form->button(__('Edit server'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                            <?= $this->Form->end() ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?= $this->element('Admin/fab') ?>
    </div>
</div>