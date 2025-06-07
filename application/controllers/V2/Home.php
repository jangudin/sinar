<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'database']);
        $this->load->helper(['url', 'file']);
        $this->load->model('V2/Data_Model', 'Data_model');
        
        if($this->session->userdata('status') != "login") {
            redirect('V2/Login');
        }
        
        // Now validates against database
        $this->_validate_lembaga_id();
    }

    private function _validate_lembaga_id() {
        $lem_id = $this->session->userdata('lembaga_id');
        
        // First try: Check session
        if($lem_id && is_numeric($lem_id) && $lem_id > 0) {
            // Verify lembaga exists in database
            $exists = $this->db->where('id', $lem_id)
                              ->get('lembaga_akreditasi')
                              ->num_rows();
            if($exists) {
                return true;
            }
        }

        // Second try: Get from user data
        $user_id = $this->session->userdata('user_id');
        if($user_id) {
            $user_data = $this->db->select('u.*, l.id as valid_lembaga_id')
                                 ->from('users u')
                                 ->join('lembaga_akreditasi l', 'l.id = u.lembaga_id')
                                 ->where('u.id', $user_id)
                                 ->get()
                                 ->row();

            if($user_data && $user_data->valid_lembaga_id) {
                // Update session with verified lembaga_id
                $this->session->set_userdata('lembaga_id', $user_data->valid_lembaga_id);
                log_message('info', 'Updated lembaga_id in session for user_id: ' . $user_id);
                return true;
            }
        }

        // If we get here, no valid lembaga_id was found
        log_message('error', sprintf(
            'Invalid lembaga_id - Session Data: %s, User ID: %s',
            json_encode($this->session->userdata()),
            $user_id ?? 'null'
        ));

        // Clear invalid session data
        $this->session->unset_userdata('lembaga_id');
        $this->session->set_flashdata('error', 'Invalid or missing institution ID. Please login again.');
        redirect('V2/Login');
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
            // Revalidate lembaga_id for AJAX calls
            if(!$this->_validate_lembaga_id()) {
                throw new Exception('Institution ID validation failed');
            }

            $lem_id = (int)$this->session->userdata('lembaga_id');
            $status = $this->input->post('status');
            
            // Validate required parameters
            if (!$lem_id || $lem_id <= 0) {
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