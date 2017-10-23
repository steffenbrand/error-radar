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
}
