<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url']);
        
        // Check authentication
        if($this->session->userdata('status') != "login") {
            redirect('V2/Login');
        }
    }

public function index() {
    $data['title'] = 'Dashboard - SINAR';
    $this->load->view('V2/home/index', $data);
}
}