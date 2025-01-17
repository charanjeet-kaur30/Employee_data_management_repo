<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'first_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100'
                        ),
                        'last_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100'
                        ),
                        'email' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100'
                        ),
                        'password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255'
                        ),
                        'confirm_password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255'
                        ),
                        'city' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '50'
                        ),                                                   
                        'mobile_no' => array(                       
                                'type' => 'VARCHAR',
                                'constraint' => '15'
                        ),
                        'dob' => array(
                                'type' => 'DATE'
                        ),
                        'status' => array(
                                'type' => 'ENUM',
                                'constraint' => ['pending', 'approved', 'rejected'],
                                'default' => 'pending'
                        ),
                        'role_id' => array(
                                'type' => 'TINYINT',
                                'constraint' => 2,  // Using TINYINT with a constraint of 2 for roles
                                'unsigned' => TRUE,
                        ),
                        'created_at' => array(
                                'type' => 'TIMESTAMP',
                                'null' => TRUE,
                                // 'default' => 'CURRENT_TIMESTAMP'
                            ),
                        'updated_at' => array(
                                'type' => 'TIMESTAMP',
                                'null' => TRUE
                                // 'default' => 'CURRENT_TIMESTAMP',
                                // 'on_update' => 'CURRENT_TIMESTAMP'
                        ),


                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}