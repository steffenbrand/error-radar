<?php

namespace App\Controller;

use App\Model\Table\CategoriesTable;
use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

/**
 * Class AppController
 *
 * @property CategoriesTable $Categories
 *
 * @package App\Controller
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
    }
}
