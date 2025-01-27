<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller
{
   public function __construct()
   {
     parent::__construct();
     $this->load->helper('url');
     $this->load->helper('cookie'); 
     $this->load->helper('form');
     $this->load->library('session');
     $this->load->model('User_model');
     $this->load->model('Employee_model');
     $this->load->library('form_validation');
   }
   
   public function dashboard()
   {
    $user_id = $this->session->userdata('user_id'); // Get the user ID from session
    if (!$user_id) {
        redirect('AuthController/login_user'); // Redirect if not logged in
    }

    // Fetch user data based on user_id
    $data['user'] = $this->User_model->get_user_by_id($user_id);
    
    // Check if data is retrieved
    if (!$data['user']) {
        echo 'User data not found!'; // Debug message
        exit;
    }

    // Load the dashboard view with the user data
     $this->load->view('employee/dashboard', $data);
   }

//___________________________________________________________
   public function add_logs()
   {
     $this->form_validation->set_rules('log_content', 'Log Description', 'required');
     $this->form_validation->set_rules('start_time', 'Start Time', 'required');
     $this->form_validation->set_rules('end_time', 'End Time', 'required');

     if ($this->form_validation->run() === FALSE) 
     {
         $this->session->set_flashdata('error', validation_errors());
         $this->load->view('employee/add_logs');
     }
     else
     {
           // Debug: Output POST data to check if form values are being sent
           log_message('debug', 'Form Data: ' . print_r($this->input->post(), true));

         // Get form input values
         $log_content = $this->input->post('log_content');
         $start_time = $this->input->post('start_time');
         $end_time = $this->input->post('end_time');

         // Convert start and end times to DateTime objects
         $start = new DateTime($start_time);
         $end = new DateTime($end_time);

         // Calculate the time difference
         $interval = $start->diff($end);
         $hours = $interval->h; // Get hours from the interval

         if (empty($start_time) || empty($end_time)) 
         {
            $this->session->set_flashdata('error', 'Start time or End time cannot be empty');
            $this->load->view('employee/add_logs');
            return;
         }

        // Add the current date to the time
        $date = date('Y-m-d'); // Get the current date

        // Append the date to the start and end time
        $start_time = $date . ' ' . $start_time;
        $end_time = $date . ' ' . $end_time;

        // Convert the time to a valid datetime format
        $start_time = date('Y-m-d H:i:s', strtotime($start_time));
        $end_time = date('Y-m-d H:i:s', strtotime($end_time));

       
             $log_data = [
                 'log_content' => $log_content,
                 'start_time' => $start_time,
                 'end_time' => $end_time,
                 'user_id' => $this->session->userdata('user_id') // Assuming employee ID is stored in session
             ];

             log_message('debug', 'Log Data: ' . print_r($log_data, true));
             // Save the log in the database
             if ($this->Employee_model->save_log($log_data)) 
             {
                 $this->session->set_flashdata('success', 'Log added successfully!');
                 redirect('employee/view_logs'); // Redirect to "All Logs" page
             } 
             else 
             {
                 $this->session->set_flashdata('error', 'Failed to add log.');
                 $this->load->view('employee/add_logs');
             }
         }
            }
        
//___________________________________________________________
   public function view_logs()
   {
     $user_id = $this->session->userdata('user_id'); // Assuming user_id is stored in the session

      if (!$user_id) 
      {
        $this->session->set_flashdata('error', 'Please log in to view logs.');
        redirect('AuthController/login_user');
      }

      // Fetch logs for the current user
      $data['logs'] = $this->Employee_model->get_logs_by_user_id($user_id);
 
      foreach ($data['logs'] as &$log)
       {
        // Format the start_time and end_time
         // Extract the date from start_time or end_time (assuming they are the same)
         $log['log_date'] = date('Y-m-d', strtotime($log['start_time']));
         $log['start_time_only'] = date('H:i:s', strtotime($log['start_time'])); // Extract time
         $log['end_time_only'] = date('H:i:s', strtotime($log['end_time'])); // Extract time
       }

      // Load the view with the logs
      $this->load->view('employee/view_logs', $data);
   }

//______________________________________________________________________
// FOR EMPLOYEE PROFILE 
    public function profile()
    {
      $user_id = $this->session->userdata('user_id'); //  user ID from session..
      $data['user'] = $this->Employee_model->get_employee_by_id($user_id); //user's data  Retrieved ..
  
      if (!$data['user'])
      {
        $this->session->set_flashdata('error', 'Profile not found!');
        redirect('employee/dashboard'); // Redirect if user not found
      }
  
        $this->load->view('employee/profile', $data);
    }

    public function edit_profile()
    {
      $user_id = $this->session->userdata('user_id'); 
      $data['user'] = $this->Employee_model->get_employee_by_id($user_id);
  
      if (!$data['user']) 
      {
          $this->session->set_flashdata('error', 'Profile not found!');
          redirect('employee/dashboard');
      }
  
      $this->load->view('employee/edit_profile', $data);
      
    }

   public function update_profile()
   {
    $user_id = $this->session->userdata('user_id');
    $data = $this->input->post(); // Get all form data

    if ($this->Employee_model->update_employee($user_id, $data)) 
    {
       $this->session->set_flashdata('success', 'Profile updated successfully!');
    }
    else
    {
       $this->session->set_flashdata('error', 'Failed to update profile.');
    }

    redirect('employee/profile');
   }



}
?>