<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller
{
   public function __construct()
   {
     parent::__construct();
     $this->load->helper('url');
     $this->load->helper('cookie'); 
     $this->load->helper('form');
     $this->load->model('User_model');
     $this->load->library('session');
   }

   public function dashboard()
   {
    $user_id = $this->session->userdata('user_id'); // Get the user ID from session
    if (!$user_id) 
    {
        redirect('auth/login_user'); // Redirect if not logged in
    }

    // Fetch user data based on user_id
    $data['user'] = $this->User_model->get_user_by_id($user_id);
    
    // Check if data is retrieved
    if (!$data['user']) 
    {
        echo 'User data not found!'; // Debug message
        exit;
    }
     $this->load->view('admin/dashboard', $data);
   }

}
?>