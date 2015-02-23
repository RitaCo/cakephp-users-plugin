<?php
namespace Rita\Users\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Rita\Users\Model\Entity\UserMember;

/**
 * UserMembers Model
 */
class UserMembersTable extends Table
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
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'className' => 'Rita/Users.Roles'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
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
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        return $rules;
    }
}
