<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use SteffenBrand\BambooApiClient\Client\BambooClient;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @property BambooClient $BambooClient
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->Categories = TableRegistry::get('Categories');

        $bambooConfig = Configure::read('BambooClient');
        $this->BambooClient = new BambooClient(
            $bambooConfig['baseUrl'],
            $bambooConfig['username'],
            $bambooConfig['password'],
            $bambooConfig['timeout']
        );
    }
}
