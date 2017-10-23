<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Http\Response;

/**
 * Class ErrorController
 *
 * @package App\Controller
 */
class ErrorController extends AppController
{
    /**
     * Initialization hook method
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadComponent('RequestHandler');
    }

    /**
     * beforeFilter callback
     *
     * @param Event $event Event.
     * @return Response|null|void
     */
    public function beforeFilter(Event $event)
    {
    }

    /**
     * beforeRender callback
     *
     * @param Event $event
     * @return Response|null|void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        $this->viewBuilder()->setTemplatePath('Error');
    }

    /**
     * afterFilter callback
     *
     * @param Event $event
     * @return Response|null|void
     */
    public function afterFilter(Event $event)
    {
    }
}
