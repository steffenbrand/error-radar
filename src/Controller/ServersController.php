<?php

namespace App\Controller;

/**
 * Class ServersController
 * @package App\Controller
 */
class ServersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void|null
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
     * Delete method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $server = $this->Servers->get($id);
        if ($this->Servers->delete($server)) {
            $this->Flash->success(__('The server has been deleted.'));
        } else {
            $this->Flash->error(__('The server could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
