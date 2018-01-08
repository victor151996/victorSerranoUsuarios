<?php
namespace Fuel\Migrations;

class List
{

    function up()
    {
        \DBUtil::create_table('users', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'title'=> array('type' => 'varchar', 'constraint' => 50),
        ), array('id'));

        array('id_users'), false, 'InnoDB', 'utf8_unicode_ci',
    array(
        array(
            'constraint' => 'constraintA',
            'key' => 'keyA',
            'reference' => array(
                'table' => 'table',
                'column' => 'field',
            ),
            'on_update' => 'CASCADE',
            'on_delete' => 'RESTRICT'
        ),
    }

    function down()
    {
       \DBUtil::drop_table('users');
    }
}