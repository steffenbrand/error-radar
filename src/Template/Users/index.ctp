<?php
/** @var $this Cake\View\View */
/** @var $users \Cake\ORM\ResultSet */
/** @var $user \App\Model\Entity\User */

$this->layout = 'Backend/default';
$this->assign('title', __('Users'));
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?= __('Users overview') ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($users->count() > 0): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td class="min-width"><?= $user->id ?></td>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->role ?></td>
                                        <td>
                                            <i class="fa fa-calendar"></i>
                                            <?= $user->created->i18nFormat('dd.MM.yyyy') ?>
                                            <i class="fa fa-clock-o"></i>
                                            <?= $user->created->i18nFormat('HH:mm:ss') ?>
                                        </td>
                                        <td>
                                            <i class="fa fa-calendar"></i>
                                            <?= $user->modified->i18nFormat('dd.MM.yyyy') ?>
                                            <i class="fa fa-clock-o"></i>
                                            <?= $user->modified->i18nFormat('HH:mm:ss') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?= $this->element('Backend/Partial/pagination') ?>
            </div>
        </div>
    </div>
</div>