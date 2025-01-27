<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_reports extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
             'id' => array(
                     'type' => 'INT',
                     'constraint' => 10,
                     'auto_increment' => TRUE
             ),
             'title' => array(
                       'type' => 'VARCHAR',
                       'constraint' => 255
             ),
             'description' => array(
                              'type' => 'TEXT'
             ),
             'date' => array(
                       'type' => 'DATE',
                       'null' => FALSE
             ),
             'file_path' => array(
                            'type' => 'VARCHAR',
                            'constraint' => 225
             ),
             'created_at' => array(
                             'type' => 'TIMESTAMP',
                             'null' => TRUE
                            //  'default' => 'CURRENT_TIMESTAMP',
             )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('reports');  
    }

    public function down()
    { 
      $this->dbforge->drop_table('reports');
    }
}

?>