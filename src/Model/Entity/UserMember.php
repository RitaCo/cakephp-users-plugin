<?php
namespace Rita\Users\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserMember Entity.
 */
class UserMember extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'uuid' => true,
        'role_id' => true,
        'email' => true,
        'password' => true,
        'confirm_email' => true,
        'meta' => true,
        'status' => true,
        'hidden' => true,
        'role' => true,
    ];
}
