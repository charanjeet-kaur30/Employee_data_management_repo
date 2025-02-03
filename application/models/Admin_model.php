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

   public function count_employees($user_id = null, $department_id = null)
   {
      $this->db->from('users');

    // Apply filters if set
    if (!$user_id) {
        $this->db->where('id', $user_id);
    }
    if (!$department_id) {
        $this->db->where('department_id', $department_id);
    }

    return $this->db->count_all_results();
   }

  public function get_all_departments()
  {
    $query=$this->db->get('departments');
    return $query->result_array();
  }


   public function get_filtered_employees($user_id = null, $department_id = null, $limit = null, $offset = null)
   {
    $this->db->where('role_id', 2); // Fetch only employees (role_id = 2)

    // Apply filters if set
    if ($user_id)
    {
        $this->db->where('id', $user_id);
    }
    if ($department_id) 
    {
        $this->db->where('department_id', $department_id);
    }

    // Apply pagination
    if ($limit && $offset) 
    {
        $this->db->limit($limit, $offset);
        $this->db->order_by('created_at', 'DESC');
    }

    $query = $this->db->get('users');
    return $query->result_array();
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