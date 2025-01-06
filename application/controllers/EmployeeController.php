<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller
{
   public function __construct()
   {
     parent::__construct();
   }

   public function register()
   {
     $this->load->view('employee/register');
   }

   public function login()
   {
     $this->load->view('employee/login');
   }
}
?>