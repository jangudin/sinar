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
        $user_id = $this->session->userdata('id');
        $jabatan = $this->session->userdata('jenis_user');
        $data['userContent'] = $this->ModelApps->getJabatan($jabatan);
        $data['menu_data'] = $this->ModelApps->getMenuAndSubMenuByUser ($user_id); // Call the method from ModelApps
       // $this->load->view('template_dashboard/dashboard', $data);
    }
    public function akreditasinonrs() {
        $data['title'] = 'Sinar || Akreditasi Non RS';
        $data['content'] = 'akreditasinonrs';
        $user_id = $this->session->userdata('id'); // Assuming 'id' is the user ID stored in session
        $data['menu_data'] = $this->ModelApps->getMenuAndSubMenuByUser ($user_id); // Call the method from ModelApps
        $this->load->view('template_dashboard/dashboard', $data);
    }


}
