<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller
{
   public function __construct()
   {
     parent::__construct();
     $this->load->helper('url');
     $this->load->helper('cookie'); 
     $this->load->model('User_model');
   }

   public function dashboard()
   {
     $this->load->view('admin/dashboard');
   }

}
?>