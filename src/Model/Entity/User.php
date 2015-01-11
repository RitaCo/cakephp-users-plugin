<?php
namespace RitaUsers\Model\Entity;

use Cake\Log\Log;
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

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
    'email' => true,
    'password' => true,
        'old_password' => true,
        'user_password' =>true,
        'confirm_password' => true,
    'last_name' => true,
    'first_name' => true,
    'confirm_email' => true,
    'confirm_sms' => true,
    'meta' => true,
    'role_id' => false,
    'status' => true,
    'last_action' => true,
    'last_login' => true,
    'hidden' => true,
    'role' => true,
        'profile' => true,
    'notices_count' => true,
    ];

//    protected $_hidden = [
//        'password',
//        'user_password',
//        'confirm_password',
//            'old_password'
//    ];
//

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
