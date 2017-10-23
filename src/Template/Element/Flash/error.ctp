<?php
/**
 * @var \App\View\AppView $this
 * @var string $message
 */

if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div role="alert" class="alert alert-danger alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
    <?= $message ?>
</div>