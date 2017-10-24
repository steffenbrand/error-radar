<?php

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;
use Cake\Utility\Security;

/**
 * Class ServersController
 *
 * @package App\Controller
 */
class ServersController extends AdminController
{
    /**
     * Index method
     *
     * @return Response|null
     * @throws \RuntimeException
     */
    public function index()
    {
        $servers = $this->Servers->findServersContainingPlans();
        $server = $this->Servers->newEntity();

        if (true === $this->request->is('post')) {
            $server = $this->Servers->patchEntity($server, $this->request->getData());
            if ($this->Servers->save($server)) {
                $this->Flash->success(__('The server has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The server could not be saved. Please, try again.'));
        }

        $this->set('servers', $servers);
        $this->set('server', $server);
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
        $server = $this->Servers->get($id);
        $encPassword = stream_get_contents($server->password);
        $password = Security::decrypt($encPassword, Configure::read('Security.key'));
        $server->password = $password;

        if (true === $this->request->is('put') || true === $this->request->is('put')) {
            $server = $this->Servers->patchEntity($server, $this->request->getData());
            if ($this->Servers->save($server)) {
                $this->Flash->success(__('The server has been edited.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The server could not be edited. Please, try again.'));
        }

        $this->set('server', $server);
    }

    /**
     * Delete method
     *
     * @param string|null $id
     * @return Response|null
     * @throws RecordNotFoundException
     */
    public function delete($id = null)
    {
        if ($this->isAdmin() === false) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        $server = $this->Servers->get($id);

        if ($this->Servers->delete($server)) {
            $this->Flash->success(__('The server has been deleted.'));
        } else {
            $this->Flash->error(__('The server could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
