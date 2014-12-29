<?php
namespace RitaUsers\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Entity;
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
        parent::initialize($config);
	}

    /**
     * UsersTable::beforeSave()
     * 
     * @param mixed $event
     * @param mixed $entity
     * @param mixed $options
     * @return
     */
    public function beforeSave(Event $event, Entity $entity, $options = []) {
        if ($entity->has('user_password')) {
            $entity->set('password', $entity->user_password);
        }
        
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
			->requirePresence('user_password', 'create')
			->notEmpty('user_password')
            ->add('user_password', [
                'custom' => [
                    'rule' => function ($value, $context) {
                            if (preg_match('/^[_0-9a-zA-Z]{6,18}$/i', $value)) {
                                return true;
                            }
                            return false;
                    },
                    'message' => 'پسورد باید بیشتر از ۶ حرف و از حروف و اعداد لاتین تشکیل شده باشد.',
                    'last' => true
                ]
            ])
			->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('confirm_password','create')
            ->notEmpty('confirm_password','تکمیل این فیلد اجباری می باشد.')
            ->add('confirm_password','custom',[
                'rule' => function($value,$context) {
                    
                    
                    return ($value === $context['data']['user_password']);
                },
                'message' => 'تکرار با رمز عبور مطابقت ندارد'
            ])
			->requirePresence('email', 'create')
			->notEmpty('email','تکمیل این فیلد اجباری می باشد.')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'ایمیل تکراری است'])
			->add('role_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('role_id', 'create')
			->notEmpty('role_id');

		return $validator;
	}

}
