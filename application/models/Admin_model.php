<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
   public function __construct()
   { 
     parent::__construct();
     $this->load->database();
     $this->load->model('Admin_model');
     $this->load->helper('url');
     $this->load->helper('cookie');
     $this->load->library('session');
   }

   public function get_admin_by_id($user_id)
   {
     $query = $this->db->get_where('users', array('id'=>$user_id));
     return $query->row_array();
   }

   public function update_admin($user_id, $data)
   {
     $this->db->where('id', $user_id);
     return $this->db->update('users', $data);
   }

   public function get_all_employees()
   {
    $this->db->select('id, first_name, last_name, email, city, mobile_no, status');
    $this->db->from('users'); 
    $query = $this->db->get(); 
    return $query->result(); 
   }

   public function get_all_reports()
   {
     $query= $this->db->get('reports');
     return $query->result_array();
   }

   public function get_report_by_id($id)
   {
     $query= $this->db->get_where('reports', ['id' => $id]);
     return $query->row_array();
   }
}
?>