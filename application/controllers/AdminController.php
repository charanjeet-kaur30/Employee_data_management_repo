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
     $this->load->model('Admin_model');
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

//____________________________________________________________________________
public function profile()
    {
      $user_id = $this->session->userdata('user_id'); //  user ID from session..
      $data['user'] = $this->Admin_model->get_admin_by_id($user_id); //user's data  Retrieved ..
  
      if (!$data['user'])
      {
        $this->session->set_flashdata('error', 'Profile not found!');
        redirect('admin/dashboard'); // Redirect if user not found
      }
  
        $this->load->view('admin/profile', $data);
    }

    public function edit_profile()
    {
      $user_id = $this->session->userdata('user_id'); 
      $data['user'] = $this->Admin_model->get_admin_by_id($user_id);
  
      if (!$data['user']) 
      {
          $this->session->set_flashdata('error', 'Profile not found!');
          redirect('admin/dashboard');
      }
  
      $this->load->view('admin/edit_profile', $data);
      
    }

   public function update_profile()
   {
    $user_id = $this->session->userdata('user_id');
    $data = $this->input->post(); // Get all form data

    if ($this->Admin_model->update_admin($user_id, $data)) 
    {
       $this->session->set_flashdata('success', 'Profile updated successfully!');
    }
    else
    {
       $this->session->set_flashdata('error', 'Failed to update profile.');
    }

    redirect('admin/profile');
   }

 //___________________________________________________________________________
   public function manage_employees()
   {
    $data['employees'] = $this->Admin_model->get_all_employees();
    $this->load->view('admin/manage_employees', $data);
   }  
}
?>