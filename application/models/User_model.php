<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
   public function __construct()
   { 
     parent::__construct();
     $this->load->database();
   } 
   
    public function insert_user($data)
    {
      return $this->db->insert('users', $data);
    }

    // Fetch user by email for login
    public function get_user_by_email($email) 
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row_array();
    }

    //   Check login credentials
    //  public function check_login($email, $password) 
    // {
    //     $user = $this->get_user_by_email($email);
    //     if ($user && password_verify($password, $user['password'])) 
    //     {
    //         return $user;
    //     }
    //     return false;
    // }

    public function check_login($email, $role)
    {
        $query = $this->db->get_where('users', ['email' => $email, 'role' => $role]);
        return $query->row_array();  // Return user data if found
    }

    //  Fetch all employees (for admin)
    //  public function get_all_employees()
    // {
    //     $this->db->select('*');
    //     $this->db->from('users');
    //     $this->db->where('role_id', 2);  // Assuming 2 is for employees
    //     return $this->db->get()->result_array();
    // }

}

?>