<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_employee_logs extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'user_id' => array(
                                'type' => 'INT',
                                'constraint' => '10',
                                'unsigned' => TRUE,
                        ),
                        'log_content' => array(
                               'type' => 'TEXT',
                               'null' => FALSE,
                        ),  
                        'start_time' => array( // Added start_time field
                                'type' => 'DATETIME',
                                'null' => FALSE,
                        ),
                        'end_time' => array( // Added end_time field
                                'type' => 'DATETIME',
                                'null' => FALSE,
                        ),                                         
                        'created_at' => array(
                                'type' => 'TIMESTAMP',
                                'null' => TRUE,
                                //  'default' => 'CURRENT_TIMESTAMP'
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('employee_logs');
               
                // Add foreign key manually using SQL
                $sql = "ALTER TABLE `employee_logs`
                ADD CONSTRAINT `fk_user_id`
                FOREIGN KEY (`user_id`)
                REFERENCES `users`(`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE";

               // Run the query to add the foreign key constraint
                $this->db->query($sql);
        }

        public function down()
        {
                $this->dbforge->drop_table('employee_logs');
        }

        
}