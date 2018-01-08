<?php
namespace Fuel\Migrations;

class Users
{

    function up()
    {
        \DBUtil::create_table('users', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'nombre' => array('type' => 'varchar', 'constraint' => 50),
            'contraseña' => array('type' => 'varchar', 'constraint' => 50),
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('users');
    }
}