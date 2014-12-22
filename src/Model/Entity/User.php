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
	protected $_accessible = [ "*" => true	];

    protected function _setPassword($password) {

        if(empty($password))
        {
            return $password;
        }
        $password = (new DefaultPasswordHasher)->hash($password);
                    Log::debug($password);        
        return $password;
    }
}
