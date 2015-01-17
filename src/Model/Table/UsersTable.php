<?php
namespace RitaUsers\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventManager;
use Cake\Event\EventManagerTrait;
use Cake\Utility\String;
use Cake\Database\Type;
use Cake\Database\Schema\Table as Schema;

Type::map('json', 'RitaTools\Database\Type\JsonType');

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
        parent::initialize($config);
        $this->table('users');
        $this->displayField('email');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('RitaTools.Persian');
        $this->belongsTo('Roles', [
        'alias' => 'Roles',
        'foreignKey' => 'role_id',
        'className' => 'RitaUsers.Roles'
        ]);
        $this->hasOne('Profiles', [
            'alias' => 'Profiles',
            'className' => 'RitaUsers.Profiles'
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

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator instance
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
        ->add(
            'id',
            'valid',
            ['rule' => 'numeric']
        )
            ->allowEmpty(
                'id',
                'create'
            )
            ->requirePresence(
                'user_password',
                'create'
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
        ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('confirm_password', 'create')
            ->notEmpty('confirm_password', 'تکمیل این فیلد اجباری می باشد.')
            ->add('confirm_password', 'custom', [
                'rule' => function($value, $context) {
                    
                      
                    return ($value === $context['data']['user_password']);
                },
                'message' => 'تکرار با رمز عبور مطابقت ندارد'
            ])
        ->requirePresence('email', 'create')
        ->notEmpty('email', 'تکمیل این فیلد اجباری می باشد.')
        ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'ایمیل تکراری است'])
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




    private function __getPassword($id)
    {
        return current($this->get(1, ['fields' => ['password']])->toArray());
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
        $configs = $options+ $this->getConfig('Register');
        $entity->hiddenProperties([]);

        $event = $this->dispatchEvent('RitaUsers.beforeAddUser', [$entity, $options]);
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
        $entity->confirm_email = ($configs['confirmEmail']) ? 0 : null;
        $entity->confirm_sms = ($configs['confirmEmail']) ? 0 : null;
        $entity->meta = [];
        
        $this->__confirmEmail($entity, $configs);


        $res = $this->save($entity);

        
        

        $this->dispatchEvent('RitaUsers.afterAddUser', [$entity]);
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
        $key = 'RitaUsers.'.$key;
        $config = \Cake\Core\Configure::read($key);
        return $config;
    }
}
