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

        try {
            // Get and validate parameters
            $status = $this->input->post('status');
            if (!in_array($status, ['sudah', 'belum'])) {
                throw new Exception('Invalid status parameter');
            }

            $lem_id = $this->session->userdata('lembaga_id');
            if (!$lem_id) {
                throw new Exception('Session lembaga_id not found');
            }

            // Debug session data
            log_message('debug', 'Session data: ' . json_encode($this->session->userdata()));
            log_message('debug', 'Lembaga ID: ' . $lem_id);

            $page = max(1, (int)($this->input->post('page') ?? 1));
            $limit = max(1, (int)($this->input->post('limit') ?? 10));
            $offset = ($page - 1) * $limit;

            // Debug request parameters
            log_message('debug', sprintf(
                'Request params - status: %s, lem_id: %d, page: %d, limit: %d, offset: %d',
                $status, $lem_id, $page, $limit, $offset
            ));

            // Get data with strict typing
            $result = ($status === 'sudah') 
                ? $this->Data_model->get_sudah_tte((int)$lem_id, $limit, $offset)
                : $this->Data_model->get_belum_tte((int)$lem_id, $limit, $offset);

            // Debug result
            log_message('debug', 'Query result count: ' . count($result['data']));

            if (empty($result['data'])) {
                log_message('debug', 'No data returned for given parameters');
            }

            $total_pages = ceil($result['total_rows'] / $result['per_page']);
            
            $response = [
                'status' => 'success',
                'data' => $result['data'],
                'pagination' => [
                    'current_page' => (int)$page,
                    'total_pages' => $total_pages,
                    'total_records' => $result['total_rows'],
                    'per_page' => $result['per_page']
                ],
                'debug' => [
                    'lembaga_id' => $lem_id,
                    'status' => $status,
                    'page' => $page,
                    'limit' => $limit
                ]
            ];

            echo json_encode($response);
            
        } catch (Exception $e) {
            log_message('error', 'TTE Data Error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
                'debug' => [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ]);
        }
    }
}