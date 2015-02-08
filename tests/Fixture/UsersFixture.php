<?php
namespace Rita\Users\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
    'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
    'last_name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
    'first_name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
    'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
    'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
    'email_verified' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
    'email_token' => ['type' => 'string', 'length' => 36, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
    'email_token_expires' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
    'role_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
    'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
    'last_action' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
    'last_login' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
    'is_admin' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
    'locked' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
    'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
    'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
    'hidden' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
    '_constraints' => [
    'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
    'id' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
    'by_email' => ['type' => 'unique', 'columns' => ['email'], 'length' => []],
    ],
    '_options' => [
    'engine' => 'InnoDB', 'collation' => 'utf8_persian_ci'
    ],
    ];

    /**
     * Records
     *
     * @var array
     */
    public $records = [
    [
    'id' => 1,
    'last_name' => 'Lorem ipsum dolor sit amet',
    'first_name' => 'Lorem ipsum dolor sit amet',
    'password' => 'Lorem ipsum dolor sit amet',
    'email' => 'Lorem ipsum dolor sit amet',
    'email_verified' => 1,
    'email_token' => 'Lorem ipsum dolor sit amet',
    'email_token_expires' => 1419047858,
    'role_id' => 1,
    'active' => 1,
    'last_action' => '2014-12-20 07:27:38',
    'last_login' => '2014-12-20 07:27:38',
    'is_admin' => 1,
    'locked' => 1,
    'created' => '2014-12-20 07:27:38',
    'modified' => '2014-12-20 07:27:38',
    'hidden' => 1
    ],
    ];
}
