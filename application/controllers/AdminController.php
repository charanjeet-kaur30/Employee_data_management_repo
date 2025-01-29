<?php
defined('BASEPATH') OR exit('No direct script access allowed');
<<<<<<< HEAD

=======
>>>>>>> 9968d61c42698dbee426e1bea50aa70b3b596bd7

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
     $this->load->library('pagination');
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

   public function test_employee_count() {
    $this->load->model('Admin_model');
    $count = $this->Admin_model->count_employees();
    echo "Total employees: " . $count;
}
   
public function manage_employees() 
{
  $this->load->model('Admin_model');
  $this->load->library('pagination'); // Load pagination library

  $per_page = 6; // Number of employees per page
  $total_rows = $this->Admin_model->count_employees(); // Get total employee count

  // Pagination configuration
  $config['base_url'] = site_url('AdminController/manage_employees'); // Base URL
  $config['total_rows'] = $total_rows; // Total employees
  $config['per_page'] = $per_page; // Employees per page
  $config['uri_segment'] = 3; // The segment where the page number appears in the URL
  $config['num_links'] = 3; // Number of links to show around the current page

  $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">'; // Open wrapper
$config['full_tag_close'] = '</ul></nav>'; // Close wrapper

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

$config['attributes'] = ['class' => 'page-link']; // Add "page-link" class to all links

  $this->pagination->initialize($config); // Initialize pagination

  // Get the current page from the URL
  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

  // Fetch employees for the current page
  $data['employees'] = $this->Admin_model->get_all_employees($per_page, $page);

  // Generate pagination links
  $data['pagination'] = $this->pagination->create_links();

  // Load the view with employees and pagination links
  $this->load->view('admin/manage_employees', $data);
}
 //___________________________________________________________________________
   public function reports()
   {
     $data['reports'] = $this->Admin_model->get_all_reports();
    
     $this->load->view('admin/reports', $data);
   }

   public function add_report()
   {
     if($this->input->post())
     {
       $title = $this->input->post('title');
       $description = $this->input->post('description');
       $date = $this->input->post('date');

       $data = [
         'title' => $title,
         'description' => $description,
         'date' => $date
       ];
       $this->db->insert('reports', $data);
       $this->session->set_flashdata('success', 'Report added successfully');
       redirect('AdminController/reports');
     }
     $this->load->view('admin/add_report');
   }

   public function delete_report($id)
   {
    $this->db->where('id', $id);
    $this->db->delete('reports');

    $this->session->set_flashdata('success', 'Record deleted successfully');
    redirect('AdminController/reports');
   }
   
   public function download_report($id)
   {
     $report = $this->Admin_model->get_report_by_id($id);
     if(!$report)
     {
       show_404();
       redirect('AdminController/reports');
     }

     //dynamic content for downloading file...
    //  $content = "Report Details\n";
    //  $content .= "--------------------------\n";
    //  $content .= "Title: " . $report['title'] . "\n";
    //  $content .= "Description: " . $report['description'] . "\n";
    //  $content .= "Date: " . $report['date'] . "\n"; 

    $html_content = "
    <h1>Report Details</h1>
    <hr>
    <p><strong>Title:</strong> {$report['title']}</p>
    <p><strong>Description:</strong> {$report['description']}</p>
    <p><strong>Date:</strong> {$report['date']}</p>
";

  // Create Dompdf instance
  $dompdf = new Dompdf();
  $dompdf->loadHtml($html_content);

  // Set paper size and orientation
  $dompdf->setPaper('A4', 'portrait');

  // Render the PDF
  $dompdf->render();

  // Download the generated PDF
  $dompdf->stream("report_{$id}.pdf", array("Attachment" => 1));

     //file name...
    //  $file_name = 'Report_' . $id . '.txt';

    //  $this->load->helper('download');
    //  force_download($file_name, $content);
    //  $this->load->library('dompdf_gen');
   }
}
?>