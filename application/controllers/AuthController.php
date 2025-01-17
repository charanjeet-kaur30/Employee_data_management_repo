<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function register_user()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|numeric');
        $this->form_validation->set_rules('dob', 'D.O.B', 'required');

      if ($this->form_validation->run() == FALSE) 
      {
        // Reload the registration view with error messages
        $this->load->view('auth/register');
      } 
      else 
      {
        $first_name= $this->input->post('first_name');
        $last_name= $this->input->post('last_name');
        $email= $this->input->post('email');
        $password= password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $city= $this->input->post('city');
        $mobile_no= $this->input->post('mobile_no');
        $dob= $this->input->post('dob');
        $confirm_password = $this->input->post('confirm_password');
        // $status= $this->input->post('status');
        $role_id = $this->input->post('role_id');
     
        // echo "hello";
        $data['role_id'] = '';  // Default value or set as needed
        $this->load->view('auth/register', $data);
        
        // Capture form data
        $data = [
        'first_name'=> $first_name,
        'last_name'=> $last_name,
        'email'=>  $email,
        'password'=> $password,
        'city'=>  $city,
        'mobile_no'=> $mobile_no,
        'dob'=>  $dob,
        // 'status'=> $status,
        'role_id' => $role_id,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ];
 
        // echo "<pre>";
        // print_r($data); // To check form data
        // echo "</pre>";
        // exit;
  
        //Insert user into the database
        if ($this->User_model->insert_user($data)) 
        {
            $this->session->set_flashdata('message', 'Registration successful. Please login.');
            redirect('AuthController/login_user');
        } 
        else 
        {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('AuthController/register_user');
        }
    } 

    }

    public function login_user()
    {
       $this->load->view('auth/login');
       $role_id = $this->input->post('role_id');
            //Login Logic_______________________________________
               $email = $this->input->post('email');
               $password = $this->input->post('password');
       
           $user = $this->User_model->get_user_by_email($email);
       
           if ($user && password_verify($password, $user['password'])) 
           {
               // Set session data
               $this->session->set_userdata([
                   'user_id' => $user['id'],
                   'role_id' => $user['role_id'],
               ]);
       
               // Redirect based on role
               if ($user['role_id'] === 1) 
               {
                   redirect('AdminController/dashboard');  // Admin Dashboard
               } 
               elseif ($user['role_id'] === 2) 
               {
                   redirect('EmployeeController/dashboard');  // Employee Dashboard
               }
           }
            else 
            {
               $this->session->set_flashdata('error', 'Invalid email or password.');
               redirect('AuthController/login_user');
            }
          }    
    }

?>