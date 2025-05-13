<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ModelApps'); // Load the correct model
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

    public function index() {
        $data['title'] = 'Sinar || Dashboard';
        $data['content'] = 'template_dashboard/app_contents';
        $user_id = $this->session->userdata('id');
        $data['menu_data'] = $this->ModelApps->getMenuAndSubMenuByUser ($user_id); // Call the method from ModelApps
        $this->load->view('template_dashboard/dashboard', $data);
    }
    public function rumahsakit() {
        $data['title'] = 'Sinar || Rumah Sakit';
        $data['content'] = 'template_dashboard/app_rumahsakit';
        $user_id = $this->session->userdata('id');
        $data['menu_data'] = $this->ModelApps->getMenuAndSubMenuByUser ($user_id); // Call the method from ModelApps
        $this->load->view('template_dashboard/dashboard', $data);
    }
}
