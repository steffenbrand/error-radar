<?php

namespace App\Controller;

use App\Model\Entity\Category;
use Cake\Core\Configure;
use Cake\Utility\Security;
use SteffenBrand\BambooApiClient\Client\BambooClient;

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
        $columnClass = null;
        $errors = [];

        $categories = $this->Categories->findCategoriesContainingPlansAndServers();

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
                            $encPassword = stream_get_contents($plan->server->password);
                            $password = Security::decrypt($encPassword, Configure::read('Security.key'));

                            $bambooClient = new BambooClient(
                                $plan->server->url,
                                $plan->server->username,
                                $password,
                                10.0
                            );

                            $result = $bambooClient->getLatestResultByKey($plan->key);

                            $plan->name = $result->getPlan()->getShortName();
                            $plan->state = $result->getState();
                            $plan->number = $result->getNumber();

                            if ($plan->state === 'Failed') {
                                $errors[] = $plan;
                            }
                        } catch (\Exception $e) {
                            $plan->state = 'Error';
                            $errors[] = $plan;
                            $this->log($e->getMessage());
                        }
                    }
                }
            }
        }

        $this->set('categories', $categories);
        $this->set('columnClass', $columnClass);
        $this->set('errors', $errors);
    }
}
