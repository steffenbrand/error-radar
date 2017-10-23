<?php

namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Http\Response;

/**
 * User Controller
 *
 * @property UsersTable $Users
 */
class UsersController extends AdminController
{
    /**
     * Index method.
     *
     * @return Response|null
     */
    public function index()
    {
        if ($this->isAdmin() === false) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        $users = $this->paginate($this->Users, ['limit' => 15]);

        $this->set('users', $users);
    }

    /**
     * Add method.
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->isAdmin() === false) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set('user', $user);
    }

    /**
     * Change password method.
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function changePassword()
    {
        $backendUser = $this->Auth->user();
        $user = $this->Users->get($backendUser['id']);

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, ['password' => $this->request->getData('password')], ['validate' => 'password']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('New password has been saved.'));

                return $this->redirect(['action' => 'changePassword']);
            }
            $this->Flash->error(__('The new password could not be saved. Please, try again.'));
        }

        $this->set('user', $user);
    }

    /**
     * Login method.
     *
     * @return Response|null
     */
    public function login()
    {
        $user = $this->Auth->user();
        if ($user) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again.'));
        }
    }

    /**
     * Logout method.
     *
     * @return Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
