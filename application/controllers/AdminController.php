<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller
{
   public function __construct()
   {
     parent::__construct();
     $this->load->helper('url');
   }

   public function register()
   {
     $this->load->view('admin/register');
   }

   public function login()
   {
     $this->load->view('admin/login');
   }

   public function dashboard()
   {
     $this->load->view('admin/dashboard');
   }
}
?>