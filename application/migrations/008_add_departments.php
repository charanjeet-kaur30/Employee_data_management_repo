<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_departments extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
                            'id' => [
                                   'type' => 'INT',
                                   'constraint' => 10,
                                   'auto_increment' => TRUE
                            ],
                            'name' => [
                                    'type' => 'VARCHAR',
                                    'constraint' => 50
                            ],
                            'created_at' => [
                                     'type' => 'TIMESTAMP',
                                     'null' => true,
                            ]
        ]);

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('departments');

        $data = [
                   ['name' => 'HR'],
                   ['name' => 'IT'],
                   ['name' => 'Finance'],
                   ['name' => 'Marketing'],
                   ['name' => 'Sales']
                ];

       $this->db->insert_batch('departments', $data);         
    }

    public function down()
    {
        $this->dbforge->drop_table('departments');
    }
}


?>