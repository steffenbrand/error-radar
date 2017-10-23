<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface $categories
 * @var string $columnClass
 * @var \App\Model\Entity\Plan[] $errors
 */
?>

<?php if (count($errors) > 0): ?>
    <div class="row">
        <div class="col col-sm-12">
            <h2><?= __('Errors') ?></h2>
            <?php foreach ($errors as $plan): ?>
                <?php
                    if ('Failed' === $plan->state) {
                        $errorsClass = 'alert-danger';
                    } else {
                        $errorsClass = 'alert-warning';
                    }
                ?>
                <div role="alert" class="alert <?= $errorsClass ?>">
                    <strong><?= $plan->key ?></strong>
                    <?= $plan->error_text ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <?php if ($categories->count() > 0): ?>
        <?php foreach ($categories as $category): ?>
            <div class="col <?= $columnClass ?>">
                <h2><?= $category->name ?></h2>
                <?php if (count($category->plans) > 0): ?>
                    <?php foreach ($category->plans as $plan): ?>
                        <div class="pmd-card pmd-z-depth <?= $plan->state ?>" id="<?= $plan->key ?>">
                            <div class="pmd-card-title">
                                <?php if (null !== $plan->name): ?>
                                    <h3 class="pmd-card-title-text">
                                        <?= $plan->name ?>
                                        <?php if (null !== $plan->number && count($category->plans) > 8): ?>
                                            <span class="badge badge-inverse"><?= $plan->number ?></span>
                                        <?php endif; ?>
                                    </h3>
                                <?php else: ?>
                                    <h3 class="pmd-card-title-text"><?= $plan->key ?></h3>
                                <?php endif; ?>
                                <?php if (count($category->plans) <= 8): ?>
                                    <h4>
                                        <?= $plan->key ?>
                                        <?php if (null !== $plan->number): ?>
                                            <span class="badge badge-inverse"><?= $plan->number ?></span>
                                        <?php endif; ?>
                                    </h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-12">
            <h2><?= __('Silence') ?></h2>
            <div class="alert alert-warning" role="alert">
                <?= __('No plans configured') ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="pmd-floating-action">
    <a href="<?= $this->Html->Url->build(['controller' => 'Categories']) ?>" class="btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" type="button">
        <i class="material-icons pmd-sm">edit</i>
    </a>
</div>