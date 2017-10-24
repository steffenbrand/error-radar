<?php

use Cake\View\View;

/**
 * @var View $this
 * @var string $message
 */

$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div role="alert" class="alert alert-info alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
    <?= $message ?>
</div>