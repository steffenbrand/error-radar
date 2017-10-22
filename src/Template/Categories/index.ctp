<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface $categories
 * @var string $columnClass
 */
?>

<div class="row">
    <?php if ($categories->count() > 0): ?>
        <?php foreach ($categories as $category): ?>
            <div class="col <?= $columnClass ?>">
                <h2><?= $category->name ?></h2>
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
                                <?php if (true === empty($plan->description)): ?>
                                    <span class="pmd-card-subtitle-text"><?= $plan->description ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-12">
            <h2><?= __('Oh snap!') ?></h2>
            <div class="alert alert-warning" role="alert">
                <?= __('No plans configured') ?>
            </div>
        </div>
    <?php endif; ?>
</div>

