<?php
use Phinx\Migration\AbstractMigration;

class Roules extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '1',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('uuid', 'string', [
                'limit' => '36',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('role_id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('email', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('password', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('last_name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('first_name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('confirm_email', 'boolean', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('confrim_sms', 'boolean', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('meta', 'text', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('status', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('last_action', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('last_login', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('hidden', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('notices_count', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => '0'
            ])
            ->save();
    }

    /**
     * Migrate Up.
     *
     * @return void
     */
    public function up()
    {
    }

    /**
     * Migrate Down.
     *
     * @return void
     */
    public function down()
    {
    }

}
