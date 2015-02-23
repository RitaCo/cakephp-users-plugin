<?php
namespace Rita\Users\Model\Entity;

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
        'uuid' => true,
        'role_id' => true,
        'email' => true,
        'password' => true,
        'confirm_email' => true,
        'meta' => true,
        'status' => true,
        'hidden' => true,
        'role' => true,
        'accounting' => true,
        'profiles' => true,
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
