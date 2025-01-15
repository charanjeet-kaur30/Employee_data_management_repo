<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function register()
    {
       $this->load->view('auth/register');
    }

    public function login()
    {
       $this->load->view('auth/login');
    }

    // Registration Method
    public function register_user()
    {
        $first_name= $this->input->post('first_name');
        $last_name= $this->input->post('last_name');
        $email= $this->input->post('email');
        $password= password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $city= $this->input->post('city');
        $mobile_no= $this->input->post('mobile_no');
        $dob= $this->input->post('dob');
        $confirm_password = $this->input->post('confirm_password');
        $status= $this->input->post('status');

        if ($password !== $confirm_password) 
        {
            $this->session->set_flashdata('error', 'Passwords do not match');
            redirect('AuthController/index');
        }
        
        $data['role_id'] = '';  // Default value or set as needed
        $this->load->view('auth/register', $data);
        
        // Capture form data
        $data = [
        'first_name'=> $first_name,
        'last_name'=> $last_name,
        'email'=>  $email,
        'password'=> $password,
        'confirm_password'=> $confirm_password,
        'city'=>  $city,
        'mobile_no'=> $mobile_no,
        'dob'=>  $dob,
        'status'=> $status,
        'role_id' => $role_id // Set role_id
        ];

        // Validate password match
        if ($this->input->post('password') !== $this->input->post('confirm_password')) 
        {
            $this->session->set_flashdata('error', 'Passwords do not match.');
            redirect('AuthController/register');
        }

        // Insert user into the database
        if ($this->User_model->insert_user($data)) 
        {
            $this->session->set_flashdata('message', 'Registration successful. Please login.');
            redirect('AuthController/login');
        } 
        else 
        {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('AuthController/register');
        }
    }

    // Login Method_______________________________________
    public function login_user()
   {
        $role_id = $this->input->post('role_id');
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
        redirect('AuthController/login');
     }
   }

}

?>