<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 * @var string $columnClass
 */
?>

<div class="row">
    <?php foreach ($categories as $category): ?>
        <div class="col <?= $columnClass ?>">
            <h2><?= $category->name ?></h2>
            <?php foreach ($category->plans as $plan): ?>
                <div class="pmd-card pmd-z-depth" id="<?= $plan->key ?>">
                    <div class="pmd-card-title">
                        <h3 class="pmd-card-title-text"><?= $plan->key ?></h3>
                        <?php if (true === isset($plan->description)): ?>
                            <span class="pmd-card-subtitle-text"><?= $plan->description ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>

