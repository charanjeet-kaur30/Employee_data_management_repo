<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MigrationController extends CI_Controller
{
      public function index()
        {
            $this->load->library('migration');

            if ($this->migration->latest() === FALSE) 
            {
               echo $this->migration->error_string();
            }

            if (!$this->migration->current()) 
            {
               show_error($this->migration->error_string());
            }
            else
            {
               echo "Migration successfull";
            }
        }
}