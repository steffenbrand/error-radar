<?php

use Cake\View\View;
use App\Model\Entity\Plan;

/**
 * @var View $this
 * @var Plan[] $errors
 */
?>

<?= $this->Html->docType() ?>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php if ('/' === $this->request->getUri()->getPath()): ?>
        <meta http-equiv="refresh" content="30">
    <?php endif; ?>
    <title>Error Radar</title>
    <?= $this->Html->css('/theme/dist/css/main') ?>
</head>
<body <?php if (true === isset($errors) && count($errors) > 0): ?>class="errors"<?php endif; ?>>
    <section id="pmd-main">
        <div class="pmd-content" id="content">
            <?= $this->fetch('content') ?>
        </div>
    </section>
    <?= $this->Html->script('/theme/dist/js/main') ?>
</body>
</html>