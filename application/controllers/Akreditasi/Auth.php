<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    // This method loads the login page view
    public function index() {
        $this->load->view('akreditasi/Auth/login');
    }

    // This method handles the login logic
    public function login() {
        // Get input data
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        // Load the login model to validate credentials
        $this->load->model('m_login'); // Assuming the model is named m_login

        // Validate credentials
        $cek = $this->m_login->cek_login($email, $password);
        $user = $cek->row_array();

        if ($cek->num_rows() > 0) {
            // User found, start session
            $this->session->set_userdata([
                'logged_in' => TRUE,  // Set logged_in to TRUE for the session
                'nik' => $user['nik'],
                'name' => $user['nama'],
                'lembaga_id' => $user['lembaga_akreditasi_id'],
                'status' => 'login',
                'jabatan_id' => $user['jabatan_sertifikat_id'],
                'id' => $user['id'],
                'pid' => $user['pejabat_sertifikat_id']
            ]);

            // Redirect user based on jabatan_sertifikat_id
            $jabatan = $user['jabatan_sertifikat_id'];
            $redirect_map = [
                '3' => 'Lembaga',
                '2' => 'Akreditasi/Direktur',
                '1' => 'DirjenYankes',
                '4' => 'Monitoring',
                '5' => 'Akreditasi/NonRS',
                '7' => 'AdminNomorSurat',
                '8' => 'Task',
                '9' => 'dashboard'
            ];

            // Redirect to the appropriate dashboard
            if (isset($redirect_map[$jabatan])) {
                redirect($redirect_map[$jabatan]);
            } else {
                // If jabatan is not found, you can handle the error
                $this->session->set_flashdata('msg', 'Jabatan tidak dikenal.');
                $this->session->set_flashdata('message_type', 'error');
                redirect('Akreditasi/Auth');
            }
        } else {
            // If no user is found, show error message and redirect back to login page
            $this->session->set_flashdata('message', 'Username atau Password salah.');
            $this->session->set_flashdata('message_type', 'error');
            redirect('Akreditasi/Auth');
        }
    }

    // This method handles logout
    public function logout() {
        $this->session->sess_destroy(); // Destroy all session data
        redirect('Auth'); // Redirect to login page after logging out
    }
}

