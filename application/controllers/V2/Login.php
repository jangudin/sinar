<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    private $max_attempts = 3;
    private $lockout_time = 900; // 15 minutes in seconds

    public function __construct() {
        parent::__construct();
        
        // Load helpers first
        $this->load->helper(['url', 'file']);
        
        // Initialize session
        if (!is_dir(FCPATH . 'writable/sessions')) {
            mkdir(FCPATH . 'writable/sessions', 0700, TRUE);
        }
        $this->load->library('session');
        
        // Load core libraries
        $this->load->library(['form_validation']);
        $this->load->model('V2/M_login','m_login');
        
        // Set security headers
        $this->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->output->set_header('X-Content-Type-Options: nosniff');
    }

    public function index() {
        // Check if already logged in
        if ($this->session->userdata('status') === 'login') {
            $this->_redirect_by_role();
            return;
        }

        $data['title'] = 'Login - SINAR';
        $data['error'] = $this->session->flashdata('msg');
        $this->load->view('V2/Login/index', $data);
    }

    public function aksi_login() {
        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect('V2/Login'); // Change this from 'Auth' to 'V2/Login'
            return;
        }

        // Sanitize input
        $email = $this->security->xss_clean($this->input->post('email', TRUE));
        $password = $this->security->xss_clean($this->input->post('password', TRUE));

        // Check for account lockout
        if ($this->_is_account_locked($email)) {
            return;
        }

        // Check login
        $user = $this->m_login->cek_login($email, $password);

        if ($user->num_rows() > 0) {
            $this->_handle_successful_login($user->row_array());
        } else {
            $this->_handle_failed_login($email);
        }
    }

    private function _is_account_locked($email) {
        $attempts = (int)$this->session->userdata('login_attempts_' . md5($email));
        
        if ($attempts >= $this->max_attempts) {
            $last_attempt = $this->session->userdata('last_attempt_' . md5($email));
            $time_elapsed = time() - $last_attempt;
            
            if ($time_elapsed < $this->lockout_time) {
                $remaining = ceil(($this->lockout_time - $time_elapsed) / 60);
                $this->session->set_flashdata('msg', 
                    '<div class="alert alert-danger">Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $remaining . ' menit.</div>'
                );
                redirect('Auth');
                return true;
            }
            
            // Reset attempts after lockout period
            $this->session->unset_userdata('login_attempts_' . md5($email));
        }
        return false;
    }

    private function _handle_successful_login($user) {
        // Reset login attempts
        $this->session->unset_userdata('login_attempts_' . md5($user['email']));

        // Set session data
        $session_data = [
            'lembaga_id' => $user['lembaga_akreditasi_id'],
            'status' => 'login',
            'jabatan_id' => $user['jabatan_sertifikat_id'],
            'nik' => $user['nik'],
            'name' => $user['nama'],
            'id' => $user['id'],
            'pid' => $user['pejabat_sertifikat_id'],
            'apps' => $user['jabatan'],
            'last_login' => date('Y-m-d H:i:s')
        ];
        
        $this->session->set_userdata($session_data);
        log_message('info', 'Successful login: ' . $user['email']);
        $this->_redirect_by_role($user['jabatan_sertifikat_id'], $user['id']);
    }

    private function _handle_failed_login($email) {
        $attempts = (int)$this->session->userdata('login_attempts_' . md5($email)) + 1;
        $this->session->set_userdata([
            'login_attempts_' . md5($email) => $attempts,
            'last_attempt_' . md5($email) => time()
        ]);

        log_message('warning', 'Failed login attempt for email: ' . $email);
        $this->session->set_flashdata('msg', 
            '<div class="alert alert-danger"><p>Username atau Password salah.</p></div>'
        );
        redirect('Auth');
    }

    private function _redirect_by_role($jabatan = null, $id = null) {
        $redirects = [
            '1' => $id == '10' ? 'DirjenYankes' : 'DirjenYankes/nonrsbelumtte',
            '2' => $id == '48' ? 'Mutu_fasyankes/nonrsbelumverifikasi' : 'Mutu_fasyankes',
            '3' => 'V2/Home',
            '4' => 'Monitoring',
            '5' => 'AkreditasiNonRS',
            '7' => 'AdminNomorSurat',
            '8' => 'apps',
            '10' => 'DirjenYankes/nonrsbelumtte'
        ];

        redirect(isset($redirects[$jabatan]) ? $redirects[$jabatan] : 'Auth');
    }

    public function pengumuman() {
        $this->load->view('pengumuman/index');
    }

    public function logout() {
        log_message('info', 'User logged out: ' . $this->session->userdata('name'));
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg', 
            '<div class="alert alert-success">Anda telah berhasil logout</div>'
        );
        redirect(base_url());
    }
}
