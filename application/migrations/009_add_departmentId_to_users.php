<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_departmentId_to_users extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_column('users',[
                           'department_id' => [
                                           'type' => 'INT',
                                           'constraint' => 10,
                                           'unsigned'   => true,  // Ensure it matches departments.id
                                           'null' => true,
                                           'after' => 'email',
                           ]
                    ]);
       
        $this->db->query(
                           "ALTER TABLE users
                            ADD CONSTRAINT fk_department
                            FOREIGN KEY(department_id)
                            REFERENCES departments(id)
                            ON DELETE SET NULL
                            ON UPDATE CASCADE"               
                        );     
    }

    public function down()
    {
      $this->db->query('ALTER TABLE users DROP FOREIGN KEY fk_department');
      $this->dbforge->drop_column('users', 'department_id');
    }
}


?>