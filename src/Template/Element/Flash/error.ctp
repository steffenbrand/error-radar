<?php

use Cake\View\View;

/**
 * @var View $this
 * @var string $message
 * @var array $params
 */

if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div role="alert" class="alert alert-danger alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
    <?= $message ?>
</div>