<?php
namespace Rita\Users\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Rita\Users\Model\Table\UserProfilesTable;

/**
 * Rita\Users\Model\Table\UserProfilesTable Test Case
 */
class UserProfilesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'UserProfiles' => 'plugin.rita/users.user_profiles',
        'Users' => 'plugin.rita/users.users',
        'Roles' => 'plugin.rita/users.roles',
        'Profiles' => 'plugin.rita/users.profiles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserProfiles') ? [] : ['className' => 'Rita\Users\Model\Table\UserProfilesTable'];        $this->UserProfiles = TableRegistry::get('UserProfiles', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserProfiles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
