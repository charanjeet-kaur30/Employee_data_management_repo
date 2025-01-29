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

  public function count_user_logs($user_id) 
 {
    $this->db->where('user_id', $user_id);
    return $this->db->count_all_results('employee_logs'); 
 }

// Fetch paginated logs for the user
public function get_user_logs_paginated($user_id, $limit, $start) 
{
    $this->db->where('user_id', $user_id);
    $this->db->limit($limit, $start);
    $this->db->order_by('created_at', 'DESC');
    $query = $this->db->get('employee_logs'); 
    return $query->result_array(); // Return logs as an array
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