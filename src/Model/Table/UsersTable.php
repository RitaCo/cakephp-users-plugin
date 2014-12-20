<?php
namespace RitaUsers\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('users');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Roles', [
			'alias' => 'Roles',
			'foreignKey' => 'role_id',
			'className' => 'RitaUsers.Roles'
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator instance
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->requirePresence('last_name', 'create')
			->notEmpty('last_name')
			->requirePresence('first_name', 'create')
			->notEmpty('first_name')
			->requirePresence('password', 'create')
			->notEmpty('password')
			->add('email', 'valid', ['rule' => 'email'])
			->requirePresence('email', 'create')
			->notEmpty('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->add('email_verified', 'valid', ['rule' => 'boolean'])
			->requirePresence('email_verified', 'create')
			->notEmpty('email_verified')
			->requirePresence('email_token', 'create')
			->notEmpty('email_token')
			->requirePresence('email_token_expires', 'create')
			->notEmpty('email_token_expires')
			->add('role_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('role_id', 'create')
			->notEmpty('role_id')
			->add('active', 'valid', ['rule' => 'boolean'])
			->requirePresence('active', 'create')
			->notEmpty('active')
			->add('last_action', 'valid', ['rule' => 'datetime'])
			->allowEmpty('last_action')
			->add('last_login', 'valid', ['rule' => 'datetime'])
			->allowEmpty('last_login')
			->add('is_admin', 'valid', ['rule' => 'boolean'])
			->requirePresence('is_admin', 'create')
			->notEmpty('is_admin')
			->add('locked', 'valid', ['rule' => 'boolean'])
			->requirePresence('locked', 'create')
			->notEmpty('locked')
			->add('hidden', 'valid', ['rule' => 'boolean'])
			->requirePresence('hidden', 'create')
			->notEmpty('hidden');

		return $validator;
	}

}
