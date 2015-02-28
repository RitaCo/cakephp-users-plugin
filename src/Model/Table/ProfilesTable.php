<?php
namespace Rita\Users\Model\Table;


use Cake\Auth\DefaultPasswordHasher;
use Cake\Database\Schema\Table as Schema;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Event\EventManagerTrait;
use Cake\Datasource\EntityInterface;
use Cake\Database\Type;
use Cake\ORM\Entity;
use Cake\ORM\RulesChecker;
use Cake\ORM\Query;
use Rita\Core\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\String;
use Rita\Users\Model\Entity\User;
use Rita\Users\Model\Entity\Profile;
use \ArrayObject;

Type::map('json', 'Rita\Tools\Database\Type\JsonType');



/**
 * UserProfiles Model
 */
class ProfilesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('user_profiles');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Rita/Users.Users'
        ]);


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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id')
            ->notEmpty('first_name','این گزینه می بایست تکمیل گردد.')
            ->notEmpty('last_name','این گزینه می بایست تکمیل گردد.')
            ->allowEmpty('phone')
            ->add('mobile', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('mobile')
            ->requirePresence('sex', 'create')
            ->notEmpty('sex','این گزینه می بایست تکمیل گردد.')
            ->add('brith', 'valid', ['rule' => 'date'])
            ->allowEmpty('brith')
            ->allowEmpty('avatarEmail')
            ->allowEmpty('websiteUrl')
            ->allowEmpty('twitterUrl')
            ->requirePresence('sex', 'update')
            ->allowEmpty('facebookUrl');


        return $validator;
    }

    public function validationMobile(Validator $validator)
    {
        $validator
            ->requirePresence('mobile', true)
            ->notEmpty('mobile', 'تکمیل این فیلد اجباری می باشد.')
        ->add('mobile', [
            'unique' => [
                'rule' => 'validateUnique', 
                'provider' => 'table',
                'message' => 'این شماره قبلا مورد استفاده قرار گرفته است..'
            ]
        ]);


        return $validator;
    }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
    
    
    /**
     * ProfilesTable::afterSave()
     * 
     * @param mixed $entity
     * @param mixed $options
     * @return void
     */
    public function afterSave(Event $event, Entity $entity, ArrayObject $options)
    {
        $key = 'users-profiles-'.$entity->user_id;
        
        \Cache::delete('users-profiles-'.$entity->user_id,'rita');
    }
}
