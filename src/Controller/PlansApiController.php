<?php

namespace App\Controller;

use App\Model\Entity\Plan;
use App\Model\Table\PlansTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Narrowspark\HttpStatus\HttpStatus;
use Psr\Log\LogLevel;
use SteffenBrand\BambooApiClient\Client\BambooClient;

/**
 * Class PlansApiController
 *
 * @property PlansTable $Plans
 * @property BambooClient $BambooClient
 *
 * @package App\Controller
 */
class PlansApiController extends ApiController
{
    /**
     * Initialization hook method.
     *
     * @throws \InvalidArgumentException
     */
    public function initialize()
    {
        parent::initialize();

        $this->Plans = TableRegistry::get('Plans');

        $bambooConfig = Configure::read('BambooClient');
        $this->BambooClient = new BambooClient(
            $bambooConfig['baseUrl'],
            $bambooConfig['username'],
            $bambooConfig['password'],
            $bambooConfig['timeout']
        );
    }

    /**
     * View a single plan.
     *
     * @param int $id
     * @return \Cake\Network\Response
     */
    public function view(int $id)
    {
        try {
            /** @var Plan $plan */
            $plan = $this->Plans
                ->find()
                ->where(['id' => $id])
                ->first();

            if (null === $plan) {
                return $this->Response->withStatus(HttpStatus::STATUS_NOT_FOUND);
            }

            $result = $this->BambooClient->getLatestResultByKey($plan->key);
            $this->Response = $this->Response->withStringBody(json_encode($result));

            return $this->Response;
        } catch (\Exception $e) {
            $this->log($e->getMessage(), LogLevel::ERROR);
            $this->Response = $this->Response->withStatus(HttpStatus::STATUS_INTERNAL_SERVER_ERROR);

            return $this->Response;
        }
    }
}