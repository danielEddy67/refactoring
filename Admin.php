<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    public function index()
    {
       $this->load->view('layouts/Admin_header');
        $this->load->view('mot');
        $this->load->view('layouts/Admin_footer');
        
    }
}    