<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $state
 * @property int $number
 * @property string $description
 * @property string $error_text
 * @property int $category_id
 * @property int $server_id
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Server $server
 */
class Plan extends Entity
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
        'key' => true,
        'name' => true,
        'state' => true,
        'number' => true,
        'description' => true,
        'error_text' => true,
        'category_id' => true,
        'server_id' => true,
        'category' => true
    ];
}
