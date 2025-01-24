<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model
{
   public function __construct()
   { 
     parent::__construct();
     $this->load->database();
     $this->load->model('Employee_model');
     $this->load->helper('url');
     $this->load->helper('cookie');
     $this->load->library('session');
   }

   public function save_log($log_data)
   {
    if ($this->db->insert('employee_logs', $log_data)) 
    {
        return true;
    } 
    else 
    {
        // Log the database error for debugging purposes
        log_message('error', 'DB Error: ' . $this->db->error()['message']);
        log_message('error', 'Last Query: ' . $this->db->last_query());
        return false;
   }
  }

   public function get_logs_by_user_id($user_id)
  {
    return $this->db->get_where('employee_logs', ['user_id' => $user_id])->result_array();
  }

   public function get_employee_by_id($user_id)
   {
     $query = $this->db->get_where('users', array('id'=>$user_id));
     return $query->row_array();
   }

   public function update_employee($user_id, $data)
   {
     $this->db->where('id', $user_id);
     return $this->db->update('users', $data);
   }
}
?>