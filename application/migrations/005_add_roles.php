<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_roles extends CI_Migration
{
  public function up()
  {
     $this->dbforge->add_field([
                     'id' => [
                             'type' => 'INT',
                             'constraint' => 10,
                             'auto_increment' => TRUE
                             ],
                     'role_name' => [
                                    'type' => 'VARCHAR',
                                    'constraint' => 255                                 
                                    ] 
                            ]);
             $this->dbforge->add_key('id', TRUE);
             $this->dbforge->create_table('roles');               
  }

  public function down()
  {
     $this->dbforge->drop_table('roles');
  }


}


?>