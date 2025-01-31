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
        $this->load->library('email');
        $this->load->helper('form');
    }
 
    public function register_user($role_id = 2)   // Default to 2 (Employee) if no role is passed
    { 
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|numeric');
        $this->form_validation->set_rules('dob', 'D.O.B', 'required');

        $departments = $this->User_model->get_departments();
           
        // Pass departments to the view
        $data['departments'] = $departments;

      if ($this->form_validation->run() == FALSE) 
      {
        // Reload the registration view with error messages
        $this->load->view('auth/register',['role_id' => $role_id, 'departments' => $departments]);
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
        $department_id= $this->input->post('department_id');
        $confirm_password = $this->input->post('confirm_password');
         // Use the passed or default role_id
         $role_id = $this->input->post('role_id') ?: $role_id;  // If no role_id is passed, use the default

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
        'role_id' => $role_id, 
        'department_id' => $department_id,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ];
 
        //Insert user into the database
        if ($this->User_model->insert_user($data)) 
        {
            $this->session->set_flashdata('message', 'Registration successful. Please login.');
            redirect('AuthController/login_user/'. $role_id);
        } 
        else 
        {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('AuthController/register_user/'. $role_id);
        }
    }

    }
//______________________________________________________________________
    public function login_user($role_id =2)
    {
        // If a role_id is passed via the URL, store it in the session, or fall back to the session
    if ($role_id !== null) 
    {
        $this->session->set_userdata('role_id', $role_id);
    } 
    else 
    {
        // If no role_id is passed, check if it's available in session
        $role_id = $this->session->userdata('role_id');
    }

        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');

            $user = $this->User_model->get_user_by_email($email);
    
            if ($user && password_verify($password, $user['password'])) 
            {
                $this->session->set_userdata(['user_id' => $user['id'], 'role_id' => $user['role_id']]);   // Set session data
            
                if($remember_me)
                {
                     // Set cookies for 30 days...
                  $this->input->set_cookie('email', $email, 86400 * 30);
                  $this->input->set_cookie('password', $password, 86400 * 30);
                }

                if ($user['role_id'] == 1) 
                {
                    redirect('admin/dashboard');
                } 
                elseif($user['role_id'] == 2) 
                {
                    redirect('employee/dashboard');
                }
                else 
                {
                    // Default redirect
                    redirect('login');
                }
            } 
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('AuthController/login_user/'.$role_id);  // Include role_id in the redirect
        }
        $role_id = $this->session->userdata('role_id');  // Get role_id from session
        $this->load->view('auth/login', ['role_id' => $role_id]);
    }

      public function logout()
      {
        $this->session->sess_destroy();
        delete_cookie('email');
        delete_cookie('password');
        redirect('auth/login');
      }
   //____________________________________________________________    
      
   private function send_email($recipient_email, $reset_link)
   {
       // Email configuration
        $config = array(
           'protocol' => 'smtp',
           'smtp_host' => 'smtp.gmail.com',
           'smtp_port' => 587,  // Use port 587 for STARTTLS
           'smtp_user' => 'charanmaaserp@gmail.com', // Your Gmail address
           'smtp_pass' =>'gslz kkim ovxt zsjk',  // Your Gmail password or App Password if 2FA is enabled
           'mailtype' => 'html',
           'charset' => 'utf-8',
           'wordwrap' => TRUE,
           'smtp_crypto' => 'tls',  // Use STARTTLS
           'newline' => "\r\n", // Required for Gmail to properly send the email
           'validation' => TRUE // To ensure the email is correctly formatted
      
    );

    $this->email->initialize($config);  // Initialize the email settings

       $this->email->from('charanmaaserp@gmail.com', 'Employee Data Management'); 
       $this->email->to($recipient_email);
       $this->email->subject('Password Reset Request');
       $this->email->message("Click here to reset your password: <a href='$reset_link'>$reset_link</a>");
   
       if (!$this->email->send()) 
       {
        echo "Email failed: ";
        echo $this->email->print_debugger(['headers', 'subject', 'body']);
        exit;
       } 
       else 
       {
        echo "Email sent successfully.";
       }

       if (mail('charanmaaserp@gmail.com', 'Test Mail', 'This is a test.')) {
        echo "Mail sent!";
    } else {
        echo "Mail failed.";
    }
    
   }
   
//______________________________________________________________________________________

      public function forgot_password()
      {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    
        if ($this->form_validation->run() === FALSE)
         {
            $this->load->view('auth/forgot_password');
        } 
        else 
        {
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email])->row();
    
            if ($user) 
            {
                $token = bin2hex(random_bytes(03));
                $expiry_time = date("Y-m-d H:i:s", strtotime('+1 hour'));
                $this->db->update('users', [
                    'reset_token' => $token,
                    'reset_token_expiry' => $expiry_time
                ], ['email' => $email]);
    
                $reset_link = site_url('auth/reset_password/' . urlencode($token));
                echo $reset_link;
                exit;

                if (!$this->send_email($email, $reset_link))
                 {
                    echo $this->email->print_debugger();
                    exit;
                } 
                else 
                {
                    echo $this->session->set_flashdata('success', 'Check your email for password reset instructions.');
                    redirect('auth/login');
                }
            }
            else 
            {
                $this->session->set_flashdata('error', 'Email not found.');   
                redirect('auth/forgot_password');

            }
        }
    }
//__________________________________________________________________
      
        public function reset_password($token = null)
         {
            if (!$token) 
            {
                echo "No token passed.";
                show_error('Invalid access.');
            }
        
            // Fetch user based on the token
            $user = $this->db->get_where('users', ['reset_token' => $token])->row();
            if (!$user)
             {
               echo "No user found for token.";
               show_error('Invalid access.');
             }
        
            // Check if token is invalid or expired
            if (!$user || new DateTime() >= new DateTime($user->reset_token_expiry))
            {
                echo "Token expired.";
                $this->session->set_flashdata('error', 'Invalid or expired token.');
                redirect('auth/forgot_password');
            }
        
            // If the user is found and token is valid, show the reset password form
            if ($this->input->post('password')) {
                $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                
                // Update password in the database
                $this->db->update('users', [
                    'password' => $password,
                    'reset_token' => NULL,
                    'reset_token_expiry' => NULL
                ], ['reset_token' => $token]);
        
                if ($this->db->affected_rows() == 0) {
                    echo "Failed to update reset token.";
                    exit;
                }
        
                $this->session->set_flashdata('success', 'Password successfully reset. You can now log in.');
                redirect('auth/login_user');
            }
        
            // Load the reset password page
            $this->load->view('auth/reset_password', ['token' => $token]);
        }
     }
?>