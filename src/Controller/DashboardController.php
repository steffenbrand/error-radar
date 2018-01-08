<?php

namespace App\Controller;

use App\Model\Entity\Category;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Utility\Security;
use SteffenBrand\BambooApiClient\Client\BambooClient;

/**
 * Class DashboardController
 *
 * @package App\Controller
 */
class DashboardController extends AppController
{
    /**
     * Index method
     *
     * @return Response|void
     * @throws \RuntimeException
     */
    public function index()
    {
        $categories = $this->Categories->findCategoriesContainingPlansAndServers();

        if ($categories->count() > 0) {
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

                            $plan->name = empty($plan->name) ? $result->getPlan()->getShortName() : $plan->name;
                            $plan->state = $result->getState();
                            $plan->number = $result->getNumber();
                        } catch (\Exception $e) {
                            $this->log($e->getMessage());
                            $plan->state = 'Error';
                        }
                    }
                }
            }
        }

        $this->set('categories', $categories);
    }
}
