<?php
namespace Rita\Users\Model\Entity;

use Cake\Log\Log;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Rita\Core\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
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
        'old_password' => true,
        'user_password' =>true,
        'confirm_password' => true,
        'accounting' => true,
        'profile' => true,
    ];

    protected $_hidden = [
        'password',
        'hidden',
    ];


    protected function _getProfile($profile)
    {
                      
        if ($profile === null) {
            $profiles = TableRegistry::get('Rita/Users.Profiles');
            return $profiles->find('all',['user_id' => $this->_properties['id']])
                
                ->cache('users-profiles-'.$this->_properties['id'], 'rita')->first();
        }
        return $profile;    
            
    }

    /**
     * User::_setEmail()
     *
     * @param mixed $email
     * @return
     */
    protected function _setEmail($email)
    {
        return strtolower($email);
    }


    /**
     * User::_getMeta()
     * 
     * @param mixed $meta
     * @return
     */
    protected function _getMeta($meta)
    {
        return $meta;
    }


    /**
     * User::_setMeta()
     * 
     * @param mixed $meta
     * @return
     */
    protected function _setMeta($meta)
    {
        $meta = $meta + $config = \Cake\Core\Configure::read('Rita.Users.metaFields');
        return $meta;
    }

    
    /**
     * User::_setPassword()
     *
     * @param mixed $password
     * @return
     */
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
