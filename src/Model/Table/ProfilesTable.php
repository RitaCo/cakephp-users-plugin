<?php
namespace RitaUsers\Model\Table;

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
        $this->primaryKey('user_id');
        $this->addBehavior('Rita/Tools.Persian');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'RitaUsers.Users'
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
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('user_id')
            ->allowEmpty('sex')
            ->allowEmpty('last_name')
            ->add('brith', 'valid', ['rule' => 'date'])
            ->allowEmpty('brith')
            ->allowEmpty('avatarEmail')
            ->requirePresence('websiteUrl', 'create')
            ->notEmpty('websiteUrl')
            ->allowEmpty('twitterUrl')
            ->requirePresence('facebookUrl', 'create')
            ->notEmpty('facebookUrl');

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
