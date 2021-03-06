<?php
namespace Rita\Users\Model\Entity;

use Rita\Core\ORM\Entity;

/**
 * UserRole Entity.
 */
class Role extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
    'name' => true,
    'user_count' => true,
    'locked' => true,
    'active' => true,
    ];
}
