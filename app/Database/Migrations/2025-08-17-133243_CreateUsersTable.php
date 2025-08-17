<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            =>  [
                'type'          =>  'INT',
                'constraint'    =>  '11',
                'unsigned'      =>  true,
                'auto_increment'=>  true
            ],

            'firstname'            =>  [
                'type'          =>  'VARCHAR',
                'constraint'    =>  '50',
            ],

            'lastname'            =>  [
                'type'          =>  'VARCHAR',
                'constraint'    =>  '80',
            ],

            'email'            =>  [
                'type'          =>  'VARCHAR',
                'constraint'    =>  '120',
            ],

            'password'            =>  [
                'type'          =>  'VARCHAR',
                'constraint'    =>  '255',
            ],

            'role'            =>  [
                'type'          =>  'INT',
                'constraint'    =>  '11',
                'default'       =>  '2'
            ],

            'created_at'            =>  [
                'type'          =>  'DATETIME',
            ],

            'updated_at'            =>  [
                'type'          =>  'DATETIME',
            ],
        ]);

        $this->forge->addKey( 'id', true );
        $this->forge->createTable( 'users', true );
    }

    public function down()
    {
        $this->forge->dropTable( 'users' );
    }
}
