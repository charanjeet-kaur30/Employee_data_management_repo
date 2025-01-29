<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_static_roles extends CI_Migration
{
    public function up()
    { 
      $data = [
                 ['role_name' => 'admin'],
                 ['role_name' => 'employee']
               ];   

        $this->db->insert_batch('roles', $data);
    }

    public function down()
    {
       $this->db->where_in('role_name',['admin', 'employee'])->delete('roles');
    }
}

?>