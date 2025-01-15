<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class LoginController extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('cookie');
    }

    
    public function login() {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $remember_me = $this->input->post('remember_me');

    $user = $this->User_model->check_login($email, $password);

      if($user) 
      {
           $this->session->set_userdata([
            'user_id' => $user['id'],
            'role_id' => $user['role_id'],
        ]);

      if($remember_me)
      {
        set_cookie('email', $email, 86400*30);
        set_cookie('password', $password, 86400*30);
      }

        
        if ($user['role_id'] == 1) {
            redirect('admin/dashboard');
        } 
        elseif ($user['role_id'] == 2) {
            redirect('employee/dashboard');
        }
    } 
    else {
        $this->session->set_flashdata('error', 'Invalid email or password.');
        redirect('LoginController/login');
    }
   }

   public function reset_password()
   {
    $email = $this->input->post('email');
    $user = $this->User_model->get_user_by_email($email);

    if ($user) {
        $token = bin2hex(random_bytes(50));  // Generate a secure token
        // Store the token and set its expiration time
        $this->User_model->save_reset_token($user['id'], $token);

        // Send reset password link via email
        $reset_link = base_url("LoginController/reset_form/$token");
        // Use your email helper or service to send the email
        mail($email, 'Password Reset Request', "Click this link to reset your password: $reset_link");
        
        $this->session->set_flashdata('message', 'Password reset link sent to your email.');
        redirect('LoginController/login');
    } else {
        $this->session->set_flashdata('error', 'Email not found.');
        redirect('LoginController/forgot_password');
    }
}
   
}    

?>



