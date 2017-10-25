<?php

namespace App\Controller;

use App\Model\Entity\Plan;
use App\Model\Entity\Server;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\Utility\Security;
use SteffenBrand\BambooApiClient\Client\BambooClient;
use SteffenBrand\BambooApiClient\Exception\BambooRequestException;

/**
 * Class PlansController
 *
 * @package App\Controller
 */
class PlansController extends AdminController
{
    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        $plan = $this->Plans->newEntity();

        if (true === $this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan could not be saved. Please, try again.'));
        }

        $plans = $this->Plans->findPlansContainingCategoriesAndServers();
        $categories = $this->Categories->find('list')->orderAsc('id')->all();
        $servers = $this->Servers->find('list')->orderAsc('id')->all();

        $planDropdownList = [];
        $selectedServerId = $this->request->getQuery('serverId');

        if ($categories->count() > 0 && $servers->count() > 0) {
            try {
                $selectedServer = $this->getSelectedServer($selectedServerId);
                $selectedServerId = $selectedServer->id;
                $planDropdownList = $this->getPlanDropdownList($selectedServer, $plans);
            } catch (\Exception $e) {
                $this->log($e->getMessage());

                $this->Flash->error(__('Plans from buildserver could not be requested. Please check your server configuration.'));

                if (null === $selectedServerId) {
                    return $this->redirect(['controller' => 'Servers', 'action' => 'index']);
                }
                return $this->redirect(['controller' => 'Servers', 'action' => 'edit', $selectedServerId]);
            }
        }

        $this->set('plans', $plans);
        $this->set('servers', $servers);
        $this->set('categories', $categories);
        $this->set('plan', $plan);
        $this->set('planDropdownList', $planDropdownList);
        $this->set('selectedServerId', $selectedServerId);
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
        $servers = $this->Servers->find('list')->all();
        $categories = $this->Categories->find('list')->all();
        $plan = $this->Plans->get($id);

        if (true === $this->request->is('put') || true === $this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been edited.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan could not be edited. Please, try again.'));
        }

        $this->set('servers', $servers);
        $this->set('categories', $categories);
        $this->set('plan', $plan);
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

        $category = $this->Plans->get($id);

        if ($this->Plans->delete($category)) {
            $this->Flash->success(__('The plan has been deleted.'));
        } else {
            $this->Flash->error(__('The plan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Get a key value list for all plans from the current server
     *
     * @param Server $server
     * @param Plan[]|ResultSetInterface $plans
     * @return array
     * @throws BambooRequestException|RecordNotFoundException|\RuntimeException
     */
    private function getPlanDropdownList($server, $plans)
    {
        $encPassword = stream_get_contents($server->password);
        $password = Security::decrypt($encPassword, Configure::read('Security.key'));

        $bambooClient = new BambooClient(
            $server->url,
            $server->username,
            $password,
            10.0
        );

        $plansFromServer = $bambooClient->getPlanList();

        if (count($plansFromServer) < 1) {
            throw new \RuntimeException('Received empty plan list from server.');
        }

        if ($plans->count() > 0) {
            foreach ($plans as $plan) {
                foreach ($plansFromServer as $key => $serverPlan) {
                    if ($serverPlan->getKey() === $plan->key) {
                        unset($plansFromServer[$key]);
                        break;
                    }
                }
            }
        }

        $list = [];
        foreach ($plansFromServer as $plan) {
            $list[$plan->getKey()] = $plan->getName();
        }

        return $list;
    }

    /**
     * Get currently selected server.
     *
     * @param $serverId
     * @return Server|null
     * @throws \RuntimeException
     */
    private function getSelectedServer($serverId)
    {
        $selectedServer = null;

        if (null !== $serverId) {
            $selectedServer = $this->Servers->get($serverId);
        } else {
            $servers = $this->Servers->find()->orderAsc('id')->all();
            if ($servers->count() > 0) {
                $selectedServer = $servers->first();
            } else {
                throw new \RuntimeException('Selected server does not exist.');
            }
        }

        return $selectedServer;
    }
}
