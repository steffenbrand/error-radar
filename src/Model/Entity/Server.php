<?php

namespace App\Model\Entity;

use Cake\Core\Configure;
use Cake\ORM\Entity;
use Cake\Utility\Security;

/**
 * Server Entity
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $username
 * @property string|resource $password
 * @property string $type
 *
 * @property \App\Model\Entity\Plan[] $plans
 */
class Server extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'url' => true,
        'username' => true,
        'password' => true,
        'type' => true,
        'plans' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * @param $password
     * @return string
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return Security::encrypt($password, Configure::read('Security.key'));
        }
    }
}
