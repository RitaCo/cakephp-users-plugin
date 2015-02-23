<?php
namespace Rita\Users\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
        $this->addBehavior('Rita/Tools.Persian');

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
            ->allowEmpty('first_name')
            ->allowEmpty('last_name')
            ->allowEmpty('phone')
            ->add('mobile', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('mobile')
            ->add('sex', 'valid', ['rule' => 'numeric'])
            ->requirePresence('sex', 'create')
            ->notEmpty('sex')
            ->add('brith', 'valid', ['rule' => 'date'])
            ->allowEmpty('brith')
            ->allowEmpty('avatarEmail')
            ->allowEmpty('websiteUrl')
            ->allowEmpty('twitterUrl')
            ->allowEmpty('facebookUrl');


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
}
