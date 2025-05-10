<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

    public function index() {
        $this->load->view('apps');
    }
}