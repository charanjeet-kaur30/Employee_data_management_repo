<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
   public function __construct()
   { 
     parent::__construct();
     $this->load->database();
     $this->load->helper('url');
     $this->load->helper('cookie');
     $this->load->library('session');
   } 
   
      public function insert_user($data)
      {
          // Ensure that data is not empty before attempting to insert
          if (!empty($data)) 
          {
              return $this->db->insert('users', $data);
          }
          return false;  // Return false if no data was provided
      }

     //GET Departments...
     public function get_departments()
     {
      $query = $this->db->get('departments');
      return $query->result_array();
     }


    // Fetch user by email for login
    public function get_user_by_email($email) 
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row_array();
    }

      //Check login credentials
    public function check_login($email, $password) 
    {
       // echo "hello";
        $user = $this->get_user_by_email($email);
        if ($user && password_verify($password, $user['password'])) 
        {
            return $user;
        }
        return false;
    }

    public function get_user_by_id($id)
    {
      return $this->db->get_where('users', ['id' => $id])->row_array();
    }
}

?>