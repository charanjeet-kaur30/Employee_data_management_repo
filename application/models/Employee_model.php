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

   public function save_log($data)
   {
    return $this->db->insert('employee_logs', $data);
   }

   public function get_log_by_id($log_id)
   {
    $query = $this->db->get_where('employee_logs', ['id' => $log_id]);
    echo $log_id;
    return $query->row_array(); // Return a single row as an associative array
   }
}
?>