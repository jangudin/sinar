<?php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        if($this->session->userdata('status') != "login") {
            redirect('V2/Login');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard - SINAR';
        // Add any additional data needed for the dashboard
        $this->load->view('V2/home/index', $data);
    }
}