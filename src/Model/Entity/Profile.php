<?php
namespace Rita\Users\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity.
 */
class Profile extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'sex' => true,
        'last_name' => true,
        'brith' => true,
        'avatarEmail' => true,
        'websiteUrl' => true,
        'twitterUrl' => true,
        'facebookUrl' => true,
        'user' => true,
    ];
}
