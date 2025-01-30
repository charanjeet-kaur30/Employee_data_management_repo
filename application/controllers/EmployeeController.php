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
    $user_id = $this->session->userdata('user_id'); // Get the current logged-in user's ID

    if (!$user_id) 
    {
        $this->session->set_flashdata('error', 'Please log in to view logs.');
        redirect('AuthController/login_user');
    }

    // Load pagination library
    $this->load->library('pagination');

    $per_page = 5; // Number of logs per page
    $total_rows = $this->Employee_model->count_user_logs($user_id); // Count total logs for the user

    // Pagination configuration
    $config['base_url'] = site_url('EmployeeController/view_logs'); // Base URL for pagination links
    $config['total_rows'] = $total_rows; // Total log entries
    $config['per_page'] = $per_page; // Logs per page
    $config['uri_segment'] = 3; // The segment in the URL where the page number appears

    // Bootstrap-styled pagination
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['attributes'] = ['class' => 'page-link'];

    // Initialize pagination
    $this->pagination->initialize($config);

    // Get the current page
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    // Fetch logs for the current user with pagination
    $data['logs'] = $this->Employee_model->get_user_logs_paginated($user_id, $per_page, $page);

    // Generate pagination links
    $data['pagination'] = $this->pagination->create_links();

    // Format logs
    foreach ($data['logs'] as &$log) 
    {
        $log['log_date'] = date('Y-m-d', strtotime($log['start_time']));
        $log['start_time_only'] = date('H:i:s', strtotime($log['start_time']));
        $log['end_time_only'] = date('H:i:s', strtotime($log['end_time']));
    }

    // Load the view with the logs and pagination
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

    if(!empty($_FILES['profile_image']['name']))
    {
      $config['upload_path'] = './uploads/profile_images/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['file_name'] = 'profile_' . $user_id . '_' . time();
      $config['max_size'] = 2048;

      $this->load->library('upload',$config);

      if($this->upload->do_upload('profile_image'))
      {
         $uploadData = $this->upload->data();
         $data['profile_image'] = 'uploads/profile_images/' . $uploadData['file_name'];
         echo "image uploaded"; 
      }
      else
      {
        $this->session->set_flashdata('error', $this->upload->display_error());
        redirect('employee/edit_profile');
        return;
      }
    }

     //database updation...
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