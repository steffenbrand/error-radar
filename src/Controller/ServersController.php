<?php

namespace App\Controller;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;

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
     * Delete method
     *
     * @param string|null $id
     * @return Response|null
     * @throws RecordNotFoundException
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
