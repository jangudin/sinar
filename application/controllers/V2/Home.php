<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url','file']);
        $this->load->model('V2/Data_Model', 'Data_model');
        
        // Check login status first
        if($this->session->userdata('status') != "login") {
            if (!$this->input->is_ajax_request()) {
                redirect('V2/Login'); // Changed from Auth to V2/Login
            }
            return;
        }
        
        // Then validate lembaga_id
        $this->_validate_lembaga_id();
    }

    private function _validate_lembaga_id() {
        $lem_id = $this->session->userdata('lembaga_id');
        $user_id = $this->session->userdata('id');

        // First try: Check session - remove numeric check since ID could be string
        if($lem_id && !empty($lem_id)) {
            // Verify lembaga exists in database
            $exists = $this->db->where('id', $lem_id)
                              ->get('lembaga_akreditasi')
                              ->num_rows();
            if($exists) {
                return true;
            }
        }

        // Second try: Get from user data
        if($user_id) {
            $user_data = $this->db->select('u.*, l.id as valid_lembaga_id')
                                 ->from('users u')
                                 ->join('lembaga_akreditasi l', 'l.id = u.lembaga_akreditasi_id')
                                 ->where('u.id', $user_id)
                                 ->where('u.status', 1)
                                 ->get()
                                 ->row();

            if($user_data && $user_data->valid_lembaga_id) {
                // Update session with verified lembaga_id
                $this->session->set_userdata('lembaga_id', $user_data->valid_lembaga_id);
                return true;
            }
        }

        // Only redirect if not an AJAX request
        if (!$this->input->is_ajax_request()) {
            $this->session->set_flashdata('error', 'Silahkan login kembali');
            redirect('V2/Login'); // Changed from Auth to V2/Login
        }
        
        return false;
    }

    public function index() {
        // Get user and lembaga data
        $data['title'] = 'Dashboard - SINAR';
        $data['user'] = $this->session->userdata();
        $data['lembaga_id'] = $this->session->userdata('lembaga_id');
        
        // Load view with data - ensure no whitespace before/after PHP tags
        $this->load->view('V2/home/index', $data);
    }

    public function belum_tte() {
        $data['title'] = 'Data Belum TTE - SINAR';
        $data['user'] = $this->session->userdata();
        $lem_id = (int)$this->session->userdata('lembaga_id');
        
        // Get data with pagination
        $page = max(1, (int)($this->input->get('page') ?? 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        // Get data belum TTE with lembaga_id
        $result = $this->Data_model->get_belum_tte($lem_id, $limit, $offset);
        $data['items'] = $result['data'];
        $data['pagination'] = [
            'current_page' => $page,
            'total_pages' => ceil($result['total_rows'] / $limit),
            'total_records' => $result['total_rows']
        ];
        
        // Load view
        $this->load->view('V2/templates/header', $data);
        $this->load->view('V2/home/belum_tte', $data);
        $this->load->view('V2/templates/footer');
    }

    public function get_tte_data() {
        // Check for AJAX request
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        try {
            // Revalidate lembaga_id for AJAX calls
            if(!$this->_validate_lembaga_id()) {
                throw new Exception('Institution ID validation failed');
            }

            $lem_id = $this->session->userdata('lembaga_id');
            $status = $this->input->post('status');
            
            // Validate required parameters - remove integer validation
            if (empty($lem_id)) {
                throw new Exception('Invalid institution ID');
            }
            
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

            // Get data with original lembaga_id (not cast to int)
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
            
            if (strpos($e->getMessage(), 'Institution ID validation failed') !== false) {
                redirect('V2/Login'); // Changed from Auth to V2/Login
            }

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