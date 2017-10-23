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
        $categories = $this->Categories->findCategoriesContainingPlansAndServers();

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
                            $resource = $plan->server->password;
                            $encPassword = stream_get_contents($resource);
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
                        } catch (\Exception $e) {
                            $plan->state = 'Error';
                            $this->log($e->getMessage());
                        }
                    }
                }
            }
        }

        $this->set('categories', $categories);
        $this->set('columnClass', $columnClass);
    }
}
