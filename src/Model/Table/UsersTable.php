<?php
namespace Rita\Users\Model\Table;

use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventManager;
use Cake\Event\EventManagerTrait;
use Cake\Utility\String;

use Cake\ORM\RulesChecker;
use Cake\Database\Schema\Table as Schema;
use Rita\Core\ORM\Table;
use Rita\Users\Model\Entity\User;
use Rita\Users\Model\Entity\Profile;



/**
 * Users Model
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        
        $this->table('user_members');
        $this->displayField('email');
        $this->primaryKey('id');
        
        
        
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'className' => 'Rita/Users.Roles'
        ]);
        $this->hasOne('Profiles', [
            'className' => 'Rita/Users.Profiles',
            'dependent' => true
        ]);  
        
    }
           
    /**
     * UsersTable::_initializeSchema()
     *
     * @param mixed $schema
     * @return
     */
    protected function _initializeSchema(Schema $schema)
    {
        $schema->columnType('meta', 'json');
        return $schema;
    }




        

    /**
     * UsersTable::buildRules()
     * 
     * @param mixed $rules
     * @return
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        return $rules;
    }





    /**
     * UsersTable::beforeSave()
     *
     * @param mixed $event
     * @param mixed $entity
     * @param mixed $options
     * @return
     */
    public function beforeSave(Event $event, Entity $entity, $options = [])
    {
        if ($entity->has('user_password')) {
            $entity->set('password', $entity->user_password);
        }
         
    }

    public function validationDefaul1t(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('uuid', 'valid', ['rule' => 'uuid'])
            ->requirePresence('uuid', 'create')
            ->notEmpty('uuid')
            ->add('role_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('role_id', 'create')
            ->notEmpty('role_id')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->requirePresence('password', 'create')
            ->notEmpty('password')
            ->add('confirm_email', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('confirm_email')
            ->allowEmpty('meta')
            ->add('status', 'valid', ['rule' => 'boolean'])
            ->requirePresence('status', 'create')
            ->notEmpty('status')
            ->add('hidden', 'valid', ['rule' => 'boolean'])
            ->requirePresence('hidden', 'create')
            ->notEmpty('hidden');

        return $validator;
    }



    /**
     * UsersTable::validationRegister()
     * 
     * @param mixed $validator
     * @return
     */
    public function validationRegister(Validator $validator)
    {
        $validator
        ->requirePresence('user_password', 'create')
        ->notEmpty('user_password', 'تکمیل این فیلد اجباری می باشد.')
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
        ->requirePresence('confirm_password', 'create')
        ->notEmpty('confirm_password', 'تکمیل این فیلد اجباری می باشد.')
        ->add('confirm_password', 'custom', [
            'rule' => function($value, $context) 
            {
                return ($value === $context['data']['user_password']);
            },
            'message' => 'تکرار با رمز عبور مطابقت ندارد'
        ])
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'تکمیل این فیلد اجباری می باشد.')
        ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'این ایمیل توسط شخص دیگری مورد استفاده قرار گرفته است.'])
        ->add('role_id', 'valid', ['rule' => 'numeric'])
        ->requirePresence('role_id', 'create')
        ->notEmpty('role_id');

        return $validator;
    }



    /**
     * UsersTable::validationPassword()
     *
     * @param mixed $validator
     * @return
     */
    public function validationPassword(Validator $validator)
    {
        
        $validator->requirePresence('id', true)
            ->notEmpty('id', 'تکمیل این فیلد اجباری می باشد.')
            ->requirePresence('old_password', true)
               ->notEmpty('old_password', 'تکمیل این فیلد اجباری می باشد.')
            ->add('old_password', [
                'custom' => [
                    'rule' => function ($value, $context) {
                        
                        return (new DefaultPasswordHasher)->check($value, $context['data']['password']);
                    },
                    'message' => 'رمزعبور فعلی صحیح نمی‌باشد',
                    'last' => true
                ]
            ])
        ->requirePresence(
            'user_password',
            true
        )
        ->notEmpty('user_password', 'تکمیل این فیلد اجباری می باشد.')
            ->add('user_password', [
                'custom' => [
                    'rule' => function ($value, $context)
                    {
                        if (preg_match('/^[_0-9a-zA-Z]{6,18}$/i', $value)) {
                            return true;
                        }
                        return false;
                    },
                    'message' => 'پسورد باید بیشتر از ۶ حرف و از حروف و اعداد لاتین تشکیل شده باشد.',
                    'last' => true
                ]
            ])
            ->requirePresence('confirm_password', true)
            ->notEmpty('confirm_password', 'تکمیل این فیلد اجباری می باشد.')
            ->add(
                'confirm_password',
                'custom',
                [
                'rule' => function($value, $context) {
                    
                    
                    return ($value === $context['data']['user_password']);
                },
                'message' => 'تکرار با رمز عبور مطابقت ندارد'
                ]
            );
        return $validator;
    }
 
 
 
    /**
     * UsersTable::chengePassword()
     *
     * @param mixed $entity
     * @param mixed $options
     * @return void
     */
    public function changePassword(EntityInterface $entity, $options = [])
    {
        
           $entity->accessible('current_password', true);
         //  $this->validator()->requirePresence('current_password','update')
//           ->add('current_password','custom',[
//                'rule' => function($value,$context) {
//                             //$cuPass$this->__getPassword($entity->id);
//                            //$cuPass = (new DefaultPasswordHasher)->check($entity->current_password,$caPass);
//                    
//                    return false;
//                },
//                'message' => 'تکرار با رمز عبور مطابقت ندارد'
//            ]);
//            

            $this->errors('current_password', ['Password is required.']);
           return $entity;
            $this->validate($entity);
          
    }




    /**
     * UsersTable::__getPassword()
     * 
     * @param mixed $id
     * @return
     */
    private function __getPassword($id)
    {
        return current($this->get(1, ['fields' => ['password']])->toArray());
    }


    
    /**
     * UsersTable::newUserEntity()
     * 
     * @param mixed $data
     * @return
     */
    public function newUserEntity($data)
    {
        return $this->newEntity($data,[
            'associated' => ['Profiles'],
            'validate' => 'register'
        ]);  
    }
    /**
     * UsersTable::register()
     *
     * @param mixed $entity
     * @param mixed $options
     * @return
     */
    public function register(EntityInterface $entity, $options = [])
    {
        $configs = array_merge($options, $this->getConfig('Register'));
        $entity->hiddenProperties([]);

        $event = $this->dispatchEvent('RitaUser.User.beforeCreate', [$entity, $options]);
        
        if ($event->result instanceof Response) {
            return $event->result;
        }
        
        if ($event->isStopped()) {
            return false;
        }
        
        $entity->role_id = $configs['roleID'];
        $err = $entity->errors();
        if (!empty($err)) {
            return false;
        }
                
        $entity->uuid = String::uuid();
        $entity->status = true;
        $entity->set('profile', new Profile);
        $entity->meta = \Cake\Core\Configure::read('Rita.Users.metaFields');
        
       // $this->__confirmEmail($entity, $configs);
        $res = $this->save($entity);
        $this->dispatchEvent('RitaUser.User.afterCreate', [$entity]);
        return $res;
    }



    /**
     * UsersTable::__confirmEmail()
     *
     * @param mixed $config
     * @return
     */
    private function __confirmEmail(EntityInterface $entity, $configs = [])
    {
        
        if (!$configs['confirmEmail']) {
            //  disable confirmEmail
            $entity->confirm_email = null;
            return;
        }
        // enable confirmEmail
        $entity->confirm_email = 0;
        
        if (!is_array($entity->meta)) {
            $entity->meta= [];
        }
        
        $entity->meta = array_merge(
            $entity->meta,
            [
            'email' => [
                'token' => $this->__generateToken(),
                'expires' => time() + (7 * 24 * 60 * 60),
            ]
            ]
        );
    
        
        
    }
    

    /**
     * UsersTable::__confirmSms()
     *
     * @param mixed $entity
     * @param mixed $configs
     * @return void
     */
    private function __confirmSms(EntityInterface $entity, $configs = [])
    {
        
        if (!$configs['confirmSms']) {
            //  disable confirmEmail
            $entity->confirm_sms = null;
            return;
        }

        if (!is_array($entity->meta)) {
            $entity->meta= [];
        }
    
        // enable confirmEmail
        $entity->confirm_sms = 0;
         $entity->meta = array_merge($entity->meta, [
            'sms' => [
                'token' => $this->__generateToken(4, false),
                'expires' => time() + (7 * 24 * 60 * 60),
            ]

        ]);
        
    }
        
    
    
    /**
     * UsersTable::__generateToken()
     *
     * @param int $length
     * @param bool $strings
     * @param bool $numbers
     * @return
     */
    private function __generateToken($length = 10, $strings = true, $numbers = true)
    {
        $possible = '';
        if ($numbers) {
            $possible = $possible. '0123456789';
        }
        if ($strings) {
            $possible = $possible . 'abcdefghijklmnopqrstuvwxyz';
        }
        
        $token = "";
        $i = 0;

        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!stristr($token, $char)) {
                $token .= $char;
                $i++;
            }
        }
        
        return $token;
    }
    
    
    
    
    /**
     * UsersTable::getConfig()
     *
     * @param mixed $key
     * @return
     */
    public function getConfig($key)
    {
        $key = 'Rita.Users.'.$key;
        $config = \Cake\Core\Configure::read($key);
        return $config;
    }
}
