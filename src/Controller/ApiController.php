<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Network\Response;
use Narrowspark\HttpStatus\HttpStatus;

/**
 * Class ApiController
 *
 * @property Response $Response
 *
 * @package App\Controller
 */
class ApiController extends Controller
{
    /**
     * Initialization hook method.
     *
     * @throws \InvalidArgumentException
     */
    public function initialize()
    {
        $this->autoRender = false;
        $this->Response = $this->response->withType('application/json')->withStatus(HttpStatus::STATUS_OK);
    }
}