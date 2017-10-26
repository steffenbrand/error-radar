<?php

namespace App\Controller;

use App\Model\Table\PlansTable;
use App\Model\Table\ServersTable;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;

/**
 * Class AdminController
 *
 * @property PlansTable $Plans
 * @property ServersTable $Servers
 * @property UsersTable $Users
 *
 * @package App\Controller
 */
class AdminController extends AppController
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->Plans = TableRegistry::get('Plans');
        $this->Servers = TableRegistry::get('Servers');
        $this->Users = TableRegistry::get('Users');

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Categories',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ]
        ]);

        $this->set('backendUser', $this->Auth->user());
        $this->set('isAdmin', $this->isAdmin());
    }

    /**
     * Checks if currently logged in user has admin role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        $user = $this->Auth->user();

        if (true === isset($user['role']) && 'admin' === $user['role']) {
            return true;
        }

        return false;
    }
}
