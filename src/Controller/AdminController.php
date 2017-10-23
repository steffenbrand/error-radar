<?php

namespace App\Controller;

/**
 * Class AdminController
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

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Category',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ]
        ]);

        $this->set('user', $this->Auth->user());
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        $user = $this->Auth->user();

        if (isset($user['role']) && 'admin' === $user['role']) {
            return true;
        }

        return false;
    }
}
