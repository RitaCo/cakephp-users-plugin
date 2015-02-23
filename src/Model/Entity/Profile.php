<?php
namespace Rita\Users\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity.
 */
class Profile extends Entity
{
    
    
    
    protected $_virtual = ['full_name']; 

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'first_name' => true,
        'last_name' => true,
        'phone' => true,
        'mobile' => true,
        'sex' => true,
        'brith' => true,
        'avatarEmail' => true,
        'websiteUrl' => true,
        'twitterUrl' => true,
        'facebookUrl' => true,
        'user' => true,
    ];

    /**
     * Profile::_getFullName()
     * 
     * @return
     */
    protected function _getFullName()
    {
        return $this->_properties['last_name'] . '  ' . $this->_properties['first_name'];
    }
        
}
