<?php

use App\Model\Entity\Category;
use App\Model\Entity\Plan;
use Cake\View\View;
use Cake\Datasource\ResultSetInterface;

/**
 * @var View $this
 * @var Category[]|ResultSetInterface $categories
 * @var Plan[] $errors
 */
?>

<?php if (count($errors) > 0): // TODO: SHOULD WE DISPLAY ERROR TEXT?!?>
    <!--div class="row">
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
                <div role="alert" class="alert <?= $errorsClass ?> alert-small">
                    <strong><?= $plan->key ?></strong>
                    <?= $plan->error_text ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div-->
<?php endif; ?>

<div class="row">
    <?php if ($categories->count() > 0): ?>
        <?php foreach ($categories as $category): ?>
            <div class="col col-xs-12">
                <div class="category-container">
                    <div class="category-label">
                        <div>
                            <h2><?= $category->name ?></h2>
                        </div>
                    </div>
                    <?php if (count($category->plans) > 0): ?>
                        <div class="row">
                            <?php foreach ($category->plans as $plan): ?>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-md-3 col-lg-2 pb-20">
                                    <div class="pmd-card pmd-z-depth <?= strtolower($plan->state) ?>" id="<?= $plan->key ?>">
                                        <div class="pmd-card-title">
                                            <span class="pmd-card-icon">
                                                <?php if ($plan->state === 'Successful'): ?>
                                                    <i class="material-icons">sentiment_satisfied</i>
                                                <?php elseif( $plan->state === 'Failed'): ?>
                                                    <i class="material-icons">error_outline</i>
                                                <?php elseif( $plan->state === 'Info'): ?>
                                                    <i class="material-icons">info_outline</i>
                                                <?php else: ?>
                                                    <i class="material-icons">help_outline</i>
                                                <?php endif; ?>
                                            </span>
                                            <?php if (null !== $plan->name): ?>
                                                <h3 class="pmd-card-title-text">
                                                    <?= $plan->name ?>
                                                    <?php if (null !== $plan->number && count($category->plans) > 12): ?>
                                                        <span class="badge badge-inverse"><?= $plan->number ?></span>
                                                    <?php endif; ?>
                                                </h3>
                                            <?php else: ?>
                                                <h3 class="pmd-card-title-text"><?= $plan->key ?></h3>
                                            <?php endif; ?>
                                            <?php if (count($category->plans) <= 12): ?>
                                                <span class="pmd-card-footer left">
                                                    <?= $plan->key ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if (null !== $plan->number): ?>
                                                <span class="pmd-card-footer right">
                                                    <?= $plan->number ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            <?= __('There are no plans in this category.') ?>
                            <a href="<?= $this->Html->Url->build(['controller' => 'Plans', 'action' => 'index']) ?>">
                                <?= __('Add plans now!') ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-12">
            <h2><?= __('Silence') ?></h2>
            <div class="alert alert-warning" role="alert">
                <?= __('Not configured yet.') ?>
                <a href="<?= $this->Html->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>">
                    <?= __('Configure now!') ?>
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="menu pmd-floating-action" role="navigation">
    <a href="<?= $this->Html->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" data-title="<?= __('Settings') ?>">
        <i class="material-icons pmd-sm">settings</i>
    </a>
</div>