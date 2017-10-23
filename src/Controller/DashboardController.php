<?php

namespace App\Controller;

use App\Model\Entity\Category;
use Cake\Core\Configure;
use Cake\Utility\Security;
use Psr\Http\Message\StreamInterface;
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

                            /** @var StreamInterface $stream */
                            $stream = $plan->server->password;
                            $password = stream_get_contents($stream);
                            var_dump(Security::decrypt($password, Configure::read('Security.key')));
                            die;
                            /*$bambooClient = new BambooClient(
                                $plan->server->url,
                                $plan->server->username,
                                Security::decrypt($plan->server->password, Configure::read('Security.key')),
                                10.0
                            );*/

                            var_dump(Security::decrypt($plan->server->password, Configure::read('Security.key')));
                            die;

                            $result = $bambooClient->getLatestResultByKey($plan->key);

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
