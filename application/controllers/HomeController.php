<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
      $this->load->view('home.php');
    }
  
    public function about()
    {
      $this->load->view('about_us.php');
    }
}

?>