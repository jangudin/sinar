<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url','file']);
        $this->load->model('V2/Data_Model', 'Data_model');
        
        // Check authentication and lembaga_id
        if($this->session->userdata('status') != "login") {
            redirect('V2/Login');
        }
        
        if(!$this->session->userdata('lembaga_id')) {
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

        $status = $this->input->post('status');
        $lem_id = $this->session->userdata('lembaga_id'); // Get lembaga ID from session
        $page = $this->input->post('page') ?? 1;
        $limit = $this->input->post('limit') ?? 10;
        $offset = ($page - 1) * $limit;

        try {
            $result = [];
            if ($status === 'sudah') {
                $result = $this->Data_model->get_sudah_tte($lem_id, $limit, $offset);
            } else {
                $result = $this->Data_model->get_belum_tte($lem_id, $limit, $offset);
            }

            // Calculate pagination info
            $total_pages = ceil($result['total_rows'] / $result['per_page']);
            
            echo json_encode([
                'status' => 'success',
                'data' => $result['data'],
                'pagination' => [
                    'current_page' => (int)$page,
                    'total_pages' => $total_pages,
                    'total_records' => $result['total_rows'],
                    'per_page' => $result['per_page']
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