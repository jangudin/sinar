<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Initialize session first
        $this->load->library('session');
        $this->load->helper('url');
        
        // Check session after initialization
        if (!$this->session->userdata('lembaga_id')) {
            redirect('V2/Login');
        }
        
        // Load model after session check
        $this->load->model('V2/Data_Model', 'Data_model');
    }

    public function index() {
        $data['title'] = 'Dashboard - SINAR';
        $data['user'] = $this->session->userdata();
        
        $this->load->view('V2/home/index', $data);
    }

    public function belum_tte() {
        $data['title'] = 'Data Belum TTE - SINAR';
        $data['user'] = $this->session->userdata();
        
        // Get data belum TTE
        $data['items'] = $this->Data_model->get_belum_tte();
        
        // Load view
        $this->load->view('V2/home/belum_tte', $data);
    }

    public function get_tte_data() {
        // Get lembaga_id from session
        $lembaga_id = $this->session->userdata('lembaga_id');
        
        if (!$lembaga_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired'
            ]);
            return;
        }

        $status = $this->input->post('status');
        
        try {
            if ($status === 'sudah') {
                $data = $this->Data_model->get_sudah_tte($lembaga_id);
            } else {
                $data = $this->Data_model->get_belum_tte($lembaga_id);
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}