<?php

namespace App\Controller;

use App\Model\Entity\Category;

/**
 * Class DashboardController
 * @package App\Controller
 */
class DashboardController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     * @throws \RuntimeException
     */
    public function index()
    {
        $categories = $this->Categories->findCategoriesContainingPlans();

        $columnClass = null;

        if ($categories->count() > 0) {
            $columnClass = sprintf(
                'col-md-%u',
                floor(12/$categories->count())
            );

            foreach ($categories as $category) {
                /** @var Category $category */
                if (count($category->plans) > 0) {
                    foreach ($category->plans as $plan) {
                        try {
                            $result = $this->BambooClient->getLatestResultByKey($plan->key);

                            $plan->name = $result->getPlan()->getShortName();
                            $plan->state = $result->getState();
                            $plan->number = $result->getNumber();
                        } catch (\Exception $e) {
                            $plan->state = 'Error';
                        }
                    }
                }
            }
        }

        $this->set('categories', $categories);
        $this->set('columnClass', $columnClass);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
