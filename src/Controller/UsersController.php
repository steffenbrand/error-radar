<?php

namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;

/**
 * User Controller
 *
 * @property UsersTable $Users
 */
class UsersController extends AdminController
{
    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        if ($this->isAdmin() === false) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        $users = $this->Users->find()->all();
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set('users', $users);
        $this->set('user', $user);
    }

    /**
     * Edit method
     *
     * @param string|null $id
     * @return \Cake\Http\Response|null
     * @throws RecordNotFoundException
     */
    public function edit($id = null)
    {
        if ($this->isAdmin() === false) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        $user = $this->Users->get($id);

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            var_dump($user);
            die;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been edited.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be edited. Please, try again.'));
        }

        $this->set('user', $user);
    }

    /**
     * Delete method
     *
     * @param string|null $id
     * @return \Cake\Http\Response|null
     * @throws RecordNotFoundException
     */
    public function delete($id = null)
    {
        if ($this->isAdmin() === false) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->Auth->user()['id'] === (int) $id) {
            $this->Flash->error(__('You cannot delete your own user.'));
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Change password method
     *
     * @return Response|null
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
     * Login method
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
     * Logout method
     *
     * @return Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
