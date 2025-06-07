<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url','file']);
        $this->load->model('V2/Data_Model', 'Data_model');
        
        // Enhanced authentication check
        if($this->session->userdata('status') != "login") {
            redirect('V2/Login');
        }
        
        // Validate and ensure lembaga_id
        $this->_validate_lembaga_id();
    }

    private function _validate_lembaga_id() {
        $lem_id = $this->session->userdata('lembaga_id');
        
        if(!$lem_id) {
            // Try to get from database
            $user_id = $this->session->userdata('user_id');
            if($user_id) {
                $user_data = $this->db->get_where('users', ['id' => $user_id])->row();
                if($user_data && $user_data->lembaga_id) {
                    // Update session with valid lembaga_id
                    $this->session->set_userdata('lembaga_id', $user_data->lembaga_id);
                    return;
                }
            }
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
            // Get lembaga_id from session first
            $lem_id = (int)$this->session->userdata('lembaga_id');
            
            // Validate lembaga_id immediately
            if (!$lem_id || $lem_id <= 0) {
                // Check if it exists in the database
                $user_data = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row();
                if ($user_data && $user_data->lembaga_id) {
                    $lem_id = (int)$user_data->lembaga_id;
                    // Update session
                    $this->session->set_userdata('lembaga_id', $lem_id);
                } else {
                    throw new Exception('Invalid or missing Lembaga ID');
                }
            }

            $status = $this->input->post('status');
            if (!in_array($status, ['sudah', 'belum'])) {
                throw new Exception('Invalid status parameter');
            }

            // Debug information
            log_message('debug', sprintf(
                'Processing request with lembaga_id: %d, status: %s',
                $lem_id,
                $status
            ));

            $page = max(1, (int)($this->input->post('page') ?? 1));
            $limit = max(1, (int)($this->input->post('limit') ?? 10));
            $offset = ($page - 1) * $limit;

            // Get data with validated lembaga_id
            $result = ($status === 'sudah') 
                ? $this->Data_model->get_sudah_tte($lem_id, $limit, $offset)
                : $this->Data_model->get_belum_tte($lem_id, $limit, $offset);

            if (!$result || empty($result['data'])) {
                log_message('debug', sprintf(
                    'No data found for lembaga_id: %d, status: %s',
                    $lem_id,
                    $status
                ));
            }

            echo json_encode([
                'status' => 'success',
                'data' => $result['data'],
                'pagination' => [
                    'current_page' => (int)$page,
                    'total_pages' => ceil($result['total_rows'] / $limit),
                    'total_records' => $result['total_rows'],
                    'per_page' => $limit
                ],
                'debug' => [
                    'lembaga_id' => $lem_id,
                    'status' => $status
                ]
            ]);

        } catch (Exception $e) {
            log_message('error', sprintf(
                'Error processing TTE data: %s (File: %s, Line: %d)',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));
            
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