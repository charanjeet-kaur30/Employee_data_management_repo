<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_profileImage_To_users extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_column('users', [
                      'profile_image' => [
                                         'type' => 'VARCHAR',
                                         'constraint' => 255,
                                         'after' => 'email'
                                         ]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('users', 'profile_image');
    }
}

?>