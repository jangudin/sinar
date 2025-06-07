<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataLpa extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('V2/M_data', 'm_data');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form', 'security', 'url_encryption']);
        
        // Check authentication
        if($this->session->userdata('status') != "login") {
            redirect(base_url('V2/Login'));
        }
    }

    public function view($encrypted_id = null) {
        // Validate and decrypt ID
        if(!$encrypted_id) {
            $this->session->set_flashdata('error', 'Invalid request');
            redirect('V2/Data');
            return;
        }

        try {
            $id = decrypt_url($encrypted_id);
            if(!$id) {
                throw new Exception('Invalid ID format');
            }

            // Get data from model
            $data['item'] = $this->m_data->get_by_id($id);
            if(!$data['item']) {
                throw new Exception('Data not found');
            }

            // Prepare view data
            $data['title'] = 'View Data Details';
            $data['breadcrumbs'] = [
                ['url' => 'V2/Data', 'label' => 'Data'],
                ['url' => '#', 'label' => 'View Details']
            ];

            // Load views
            $this->load->view('V2/templates/header', $data);
            $this->load->view('V2/Data/view', $data);
            $this->load->view('V2/templates/footer');

        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('V2/Data');
        }
    }
}