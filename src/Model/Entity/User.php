<?php
namespace Rita\Users\Model\Entity;

use Cake\Log\Log;
use Cake\Auth\DefaultPasswordHasher;;
use Cake\ORM\TableRegistry;
use Rita\Core\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{



    protected $_virtual = [
        'avator',
        'role'
    ];


    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
  
 
    protected $_accessible = [
//        'uuid' => true,
//        'role_id' => true,
//        'email' => true,
//        'password' => true,
//        'confirm_email' => true,
//        'meta' => true,
//        'status' => true,
//        'hidden' => true,
//        'role' => true,
//        'old_password' => true,
//        'user_password' =>true,
//        'confirm_password' => true,
//        'accounting' => true,
//        'profile' => true,

        '*' => true
    ];

    protected $_hidden = [
     //   'password',

    ];


    /**
     * User::getStatus()
     * 
     * @return
     */
    public function getStatus()
    {
        if($this->isNew()) {
            return;
        }
        
        return  $this->_properties['status'] ? 'فعال می باشد' : 'مسدود شده است.[درجه ۲]';
    }

    /**
     * User::_getProfile()
     * 
     * @param mixed $profile
     * @return
     */
    protected function _getProfile($profile)
    {
                    
        if (!$this->isNew() && $profile === null) {
            $profiles = TableRegistry::get('Rita/Users.Profiles');
            return $profiles->find('all',[ 'conditions' => ['Profiles.user_id' => $this->_properties['id']]])
                
                ->cache('users-profiles-'.$this->_properties['id'], 'rita')->first();
        }
        return $profile;    
            
    }
    
    protected function _getRole($profile)
    {
                    
        if (!$this->isNew() && $profile === null) {
            $profiles = TableRegistry::get('Rita/Users.Roles');
            return $profiles->find('all',[ 'conditions' =>['id' => $this->_properties['role_id']]])
                
                ->cache('users-roles-'.$this->_properties['role_id'], 'rita')->first();
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
        $hasher = new DefaultPasswordHasher;
        return  $hasher->hash($password);
    }
    
    
    
    protected function _getAvator($avator)
    {
        if (!$this->isNew() && $avator=== null) {
            $Hash = md5( strtolower( trim($this->_properties['email']) ) );
			return 'http://rokh.chehrak.com/'.$Hash;
        }
        return $avator;        
    }
}
