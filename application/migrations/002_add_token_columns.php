<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_token_columns extends CI_Migration {

        public function up()
        { 
            echo "running migrations...";
            $fields= array(
            'reset_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'reset_token_expiry' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
        );
                $this->dbforge->add_column('users', $fields);
                echo "migrations completed";
        }

        public function down() 
        {
            // Dropping the columns if rolling back
            $this->dbforge->drop_column('users', 'reset_token');
            $this->dbforge->drop_column('users', 'reset_token_expiry');
        }  
}