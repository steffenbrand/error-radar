<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity
 *
 * @property int $id
 * @property string $type
 * @property string $key
 * @property string $name
 * @property string $link
 * @property string $state
 * @property int $number
 * @property string $description
 * @property string $error_text
 * @property int $category_id
 *
 * @property \App\Model\Entity\Category $category
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
        'type' => true,
        'key' => true,
        'name' => true,
        'link' => true,
        'state' => true,
        'number' => true,
        'description' => true,
        'error_text' => true,
        'category_id' => true,
        'category' => true
    ];
}
