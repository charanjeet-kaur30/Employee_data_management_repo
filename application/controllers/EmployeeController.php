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
     $this->form_validation->set_rules('log_description', 'Log Description', 'required');
     $this->form_validation->set_rules('start_time', 'Start Time', 'required');
     $this->form_validation->set_rules('end_time', 'End Time', 'required');

     if ($this->form_validation->run() === FALSE) 
     {
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

         // If the log is 8 hours, save it to the database
         if ($hours == 8) {
             $log_data = [
                 'log_content' => $log_content,
                 'start_time' => $start_time,
                 'end_time' => $end_time,
                 'employee_id' => $this->session->userdata('user_id') // Assuming employee ID is stored in session
             ];
             
             // Save the log in the database
             if ($this->Employee_model->save_log($log_data)) {
                 // Redirect or show a success message
                 $this->session->set_flashdata('success', 'Log added successfully!');
                 redirect('employee/dashboard');
             } else {
                 $this->session->set_flashdata('error', 'Failed to add log!');
                 redirect('employee/add_logs');
             }
         } else {
             // If the time difference is not 8 hours, show an error
             $this->session->set_flashdata('error', 'The log must be for 8 hours.');
             redirect('employee/add_logs');
         }
     }
   }

//___________________________________________________________
   public function view_logs()
   {
    $this->load->view('employee/view_logs');
   }

//___________________________________________________________
   public function edit_logs($log_id)
   {
    $log = $this->Employee_model->get_log_by_id($log_id); // Assuming this method fetches the log by its ID
    echo "Edit Logs Method Reached for ID: $log_id"; // Debugging message

    if ($log) 
    {
        $data['log'] = $log; // Pass log data to the view
        //$this->load->view('employee/edit_logs', $data); // Load the view with data
        redirect('employee/edit_logs/' . $log_id);
    } 
    else
    {
        show_error('Log entry not found.');
    }
   }
   
}
?>