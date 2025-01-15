<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller
{
   public function __construct()
   {
     parent::__construct();
     $this->load->helper('url');
     $this->load->helper('cookie'); 
   }
   
   public function dashboard()
   {
     $this->load->view('employee/dashboard');
   }
}
?>