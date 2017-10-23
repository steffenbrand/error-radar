<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface $categories
 * @var \App\Model\Entity\Category $category
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
            <div role="tabpanel" class="tab-pane active" id="categories-fixed">

                <h2><?= __('Create Category') ?></h2>
                <div class="well">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create($category) ?>
                        <?= $this->Form->control('name', ['class' => 'form-control']) ?>
                        <?= $this->Form->button(__('Add category'), ['class' => 'btn pmd-btn-raised pmd-ripple-effect btn-success']) ?>
                    <?= $this->Form->end() ?>
                </div>

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
        </div>
    </div>
</div>
<?= $this->element('Admin/fab') ?>