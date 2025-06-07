<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url','file']);
        $this->load->model('V2/Data_Model', 'Data_model'); // Fix model name case
        
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
        // Check for AJAX request
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        try {
            $status = $this->input->post('status');
            $page = $this->input->post('page', TRUE) ?? 1;
            $limit = $this->input->post('limit', TRUE) ?? 10;
            $offset = ($page - 1) * $limit;
            
            $lem_id = $this->session->userdata('lembaga_id');
            if (!$lem_id) {
                throw new Exception('Session tidak valid');
            }

            $result = $status === 'sudah' 
                ? $this->Data_model->get_sudah_tte($lem_id, $limit, $offset)
                : $this->Data_model->get_belum_tte($lem_id, $limit, $offset);

            $total_pages = ceil($result['total_rows'] / $limit);
            
            echo json_encode([
                'status' => 'success',
                'data' => $result['data'],
                'pagination' => [
                    'current_page' => (int)$page,
                    'total_pages' => $total_pages,
                    'total_records' => $result['total_rows'],
                    'per_page' => (int)$limit
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}