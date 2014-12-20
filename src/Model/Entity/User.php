<?php
namespace RitaUsers\Model\Entity;

use Cake\ORM\Entity;

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
		'last_name' => true,
		'first_name' => true,
		'password' => true,
		'email' => true,
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
	];

}
