<?php

use Cake\View\View;
use App\Model\Entity\Plan;

/**
 * @var View $this
 * @var Plan[] $errors
 */

$path = $this->request->getUri()->getPath();
?>

<?= $this->Html->docType() ?>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error Radar</title>
    <?= $this->Html->css('/theme/dist/css/main') ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/theme/dist/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/theme/dist/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/theme/dist/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/theme/dist/images/favicon/manifest.json">
    <link rel="mask-icon" href="/theme/dist/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#4285f4">
</head>
<body class="<?php if ('/' === $path): ?>dashboard<?php endif; ?>">
    <section id="pmd-main">
        <div class="pmd-content" id="content">
            <?= $this->fetch('content') ?>
        </div>
    </section>
    <?= $this->Html->script('/theme/dist/js/main') ?>
</body>
</html>