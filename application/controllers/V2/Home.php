<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url']);
        $this->load->model('V2/Data_Model', 'Data_model'); // Fixed model path and case
        
        // Check authentication
        if($this->session->userdata('status') != "login") {
            redirect('V2/Login');
        }
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
        $status = $this->input->post('status');
        $lem_id = $this->session->userdata('lembaga_id'); // Assuming you have this in session
        
        try {
            if ($status === 'sudah') {
                $data = $this->Data_model->get_sudah_tte($lem_id);
            } else {
                $data = $this->Data_model->get_belum_tte($lem_id);
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

/* Add this CSS to your existing <style> section */
.table {
    margin-bottom: 0;
}

.table th {
    background: #f8f9fa;
    font-weight: 600;
}

.table td, .table th {
    padding: 0.75rem;
    vertical-align: middle;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}