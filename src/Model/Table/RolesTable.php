<?php
namespace Rita\Users\Model\Table;

use Cake\ORM\Query;

use Cake\Validation\Validator;
use Rita\Core\ORM\Table;

/**
 * UserRoles Model
 */
class RolesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('user_roles');
        $this->displayField('name');
        $this->primaryKey('id');
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
        ->requirePresence('name', 'create')
        ->notEmpty('name')
        ->add('user_count', 'valid', ['rule' => 'numeric'])
        ->requirePresence('user_count', 'create')
        ->notEmpty('user_count')
        ->add('locked', 'valid', ['rule' => 'boolean'])
        ->requirePresence('locked', 'create')
        ->notEmpty('locked')
        ->add('active', 'valid', ['rule' => 'boolean'])
        ->requirePresence('active', 'create')
        ->notEmpty('active');

        return $validator;
    }
}
