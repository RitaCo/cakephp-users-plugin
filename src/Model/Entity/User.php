<?php
namespace RitaUsers\Model\Entity;

use Cake\Log\Log;
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity.
 */
class User extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
 
 
protected $_accessible = [
		'email' => true,
		'password' => true,
        'user_password' =>true,
        'confirm_password' => true,
		'last_name' => true,
		'first_name' => true,
		'email_verified' => true,
		'email_token' => true,
		'email_token_expires' => true,
		'role_id' => true,
		'active' => true,
		'last_action' => true,
		'last_login' => true,
		'is_admin' => true,
		'locked' => true,
		'hidden' => true,
		'role' => true,
		'req_notices' => true,
	];

protected $_hidden = [
    'password',
    'user_password',
    'confirm_password'
];


    protected function _setEmail($email) {
        return strtolower($email);
    }
    
    protected function _setPassword($password) {
        if(empty($password))
        {
            return $password;
        }
        $password = (new DefaultPasswordHasher)->hash($password);      
        return $password;
    }
}
