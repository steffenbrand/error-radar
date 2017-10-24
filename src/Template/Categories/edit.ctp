<?php

use App\Model\Entity\Category;
use Cake\View\View;

/**
 * @var View $this
 * @var Category $category
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

                        <h2><?= __('Edit category') ?></h2>
                        <div class="well">
                            <?= $this->Form->create($category) ?>
                                <?= $this->Form->control('name', ['class' => 'form-control']) ?>
                                <?= $this->Form->button(__('Edit category'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                            <?= $this->Form->end() ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?= $this->element('Admin/fab') ?>
    </div>
</div>