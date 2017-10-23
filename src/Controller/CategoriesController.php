<?php

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Response;

/**
 * Class CategoriesController
 *
 * @package App\Controller
 */
class CategoriesController extends AdminController
{
    /**
     * Index method
     *
     * @return Response|null
     * @throws \RuntimeException
     */
    public function index()
    {
        $categories = $this->Categories->findCategoriesContainingPlans();

        $category = $this->Categories->newEntity();
        if (true === $this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }

        $this->set('categories', $categories);
        $this->set('category', $category);
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
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
