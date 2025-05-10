<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ModelApps');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

    public function index() {
        $data['title'] = 'Sinar || Dashboard';
        $user_id = $this->session->userdata('id');
        $data['menu_data'] = $this->ModelApps->getMenusByUser($user_id); // ambil data menu saja
        $this->load->view('template_dashboard/dashboard', $data);
    }

    // Endpoint AJAX untuk mengambil submenu berdasarkan menu id
    public function get_submenu() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $menu_id = $this->input->post('menu_id');
        $user_id = $this->session->userdata('id');
        
        if (!$menu_id || !is_numeric($menu_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid menu ID']);
            return;
        }
        
        $submenu = $this->ModelApps->getSubMenuByMenuId($user_id, (int)$menu_id);
        
        echo json_encode(['status' => 'success', 'data' => $submenu]);
    }
}
