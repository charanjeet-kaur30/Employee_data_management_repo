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
        $this->load->library('session');
        $this->load->helper('cookie');

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
            echo "hello hii";
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
//______________________________________________________________________
    public function login_user()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');

            $user = $this->User_model->get_user_by_email($email);
    
            if ($user && password_verify($password, $user['password'])) 
            {
                $this->session->set_userdata(['user_id' => $user['id'], 'role_id' => $user['role_id']]);   // Set session data
                // echo "<pre>";
                // print_r($this->session->userdata());
                // echo "</pre>";
                // exit;
                if($remember_me)
                {
                     // Set cookies for one week...
                  $this->input->set_cookie('email', $email, 604800);
                  $this->input->set_cookie('password', $password, 604800);
                }

                if ($user['role_id'] == 1) 
                {
                    redirect('admin/dashboard');
                } 
                else 
                {
                    redirect('employee/dashboard');
                }
            } 
            else 
            {
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('login');
            }
        }
        $this->load->view('auth/login');
    }

      public function logout()
      {
        $this->session->sess_destroy();
        delete_cookie('remember_me');
        redirect('AuthController/login_user');
      }
   //____________________________________________________________    
      public function forgot_password()
      {
        $this->load->view('auth/forgot_password');
      }

      public function process_forgot_password()
      {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() === FALSE) 
        {
            // Load the forgot password page with errors
            $this->load->view('auth/forgot-password');
        } 
        else 
        {
            // Process password reset request
            $email = $this->input->post('email');
            
            // Check if the email exists in the database
            $user = $this->db->get_where('users', ['email' => $email])->row();
            
            if ($user) {
                // Generate a reset token
                $token = bin2hex(random_bytes(50)); // Generate a secure random token
                $expiry_time = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expiry (1 hour)
                
                // Update the user with the reset token and expiry time
                $this->db->update('users', [
                    'reset_token' => $token,
                    'reset_token_expiry' => $expiry_time
                ], ['email' => $email]);
                
                // Send email with reset link
                $reset_link = site_url('auth/reset_password') . '?token=' . $token;
                $subject = "Password Reset Request";
                $message = "Click on the link to reset your password: " . $reset_link;
                $this->email->from('no-reply@yourdomain.com', 'Your App Name');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($message);
                
                if ($this->email->send()) 
                {
                    $this->session->set_flashdata('success', 'Check your email for password reset instructions.');
                    redirect('auth/forgot_password');
                }
                else 
                {
                    $this->session->set_flashdata('error', 'Failed to send email.');
                    redirect('auth/forgot_password');
                }
            } 
            else 
            {
                $this->session->set_flashdata('error', 'Email not found.');
                redirect('auth/forgot_password');
            }
        }
    
      }

      public function reset_password() 
      {
        //  $this->load->view('auth/reset_password');
         // reset-password.php

    $token = $this->input->get('token');
    
    // Check if the token is valid and not expired
    $user = $this->db->get_where('users', ['reset_token' => $token])->row();
    
    if ($user && new DateTime() < new DateTime($user->reset_token_expiry)) {
        // Token is valid
        if ($this->input->post('password')) {
            // Password reset form submitted
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT); // Hash the password
            $this->db->update('users', [
                'password' => $password,
                'reset_token' => NULL,
                'reset_token_expiry' => NULL
            ], ['reset_token' => $token]);
            
            $this->session->set_flashdata('success', 'Password successfully reset. You can now log in.');
            redirect('auth/login');
        }
        
        // Load the reset password form
        $this->load->view('auth/reset_password', ['token' => $token]);
    } else {
        // Invalid or expired token
        $this->session->set_flashdata('error', 'Invalid or expired token.');
        redirect('auth/forgot_password');
    }

     }
        
      
}    

?>