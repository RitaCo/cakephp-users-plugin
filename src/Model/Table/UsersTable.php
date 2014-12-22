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
			->requirePresence('password', 'create')
			->notEmpty('password')
			->add('email', 'valid', ['rule' => 'email'])
			->requirePresence('email', 'create')
			->notEmpty('email','تکمیل این فیلد اجباری می باشد.')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'ایمیل تکراری است'])
			->add('role_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('role_id', 'create')
			->notEmpty('role_id');

		return $validator;
	}

}
