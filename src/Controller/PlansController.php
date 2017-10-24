<?php

namespace App\Controller;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;

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
     * @throws \RuntimeException
     */
    public function index()
    {
        $plans = $this->Plans->findPlansContainingCategoriesAndServers();
        $servers = $this->Servers->find('list')->all();
        $categories = $this->Categories->find('list')->all();
        $plan = $this->Plans->newEntity();

        if (true === $this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan could not be saved. Please, try again.'));
        }

        $this->set('plans', $plans);
        $this->set('servers', $servers);
        $this->set('categories', $categories);
        $this->set('plan', $plan);
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
}
