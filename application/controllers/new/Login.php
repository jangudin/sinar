<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('m_login');
        $this->load->library(['form_validation', 'session', 'security']);
        $this->load->helper(['string', 'security', 'url']);
    }

    public function index() {
        // Check if already logged in
        if ($this->session->userdata('status') === 'login') {
            $this->_redirect_by_role();
        }

        // Generate CAPTCHA
        $captcha = random_string('alnum', 6);
        $this->session->set_userdata('captcha_code', $captcha);

        $data['captcha'] = $captcha;
        $this->load->view('auth/index', $data);
    }

    public function pengumuman()
{
    $this->load->view('pengumuman/index');
}



    public function aksi_login() {
        // Validate CAPTCHA
        $input_captcha = $this->input->post('captcha');
        $stored_captcha = $this->session->userdata('captcha_code');
        
        if ($input_captcha !== $stored_captcha) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">CAPTCHA tidak valid</div>');
            redirect('Auth');
            return;
        }

        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect('Auth');
            return;
        }

        // Sanitize input
        $email = $this->security->xss_clean($this->input->post('email', TRUE));
        $password = $this->security->xss_clean($this->input->post('password', TRUE));

        // Add brute force protection
        $this->_check_login_attempts($email);

        // Check login
        $user = $this->m_login->cek_login($email, $password);

        if ($user->num_rows() > 0) {
            $this->_handle_successful_login($user->row_array());
        } else {
            $this->_handle_failed_login($email);
        }
    }

    private function _check_login_attempts($email) {
        $attempts = $this->session->userdata('login_attempts_' . md5($email)) ?? 0;
        
        if ($attempts >= 3) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Terlalu banyak percobaan login. Silakan coba lagi dalam 15 menit.</div>');
            redirect('Auth');
            exit;
        }
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

        // Log successful login
        log_message('info', 'Successful login: ' . $user['email']);

        $this->_redirect_by_role($user['jabatan_sertifikat_id'], $user['id']);
    }

    private function _handle_failed_login($email) {
        // Increment login attempts
        $attempts = $this->session->userdata('login_attempts_' . md5($email)) ?? 0;
        $this->session->set_userdata('login_attempts_' . md5($email), $attempts + 1);

        // Log failed attempt
        log_message('warning', 'Failed login attempt for email: ' . $email);

        $this->session->set_flashdata('msg', '<div class="alert alert-danger"><p>Username atau Password salah.</p></div>');
        redirect('Auth');
    }

    private function _redirect_by_role($jabatan = null, $id = null) {
        $redirects = [
            '1' => $id == '10' ? 'DirjenYankes' : 'DirjenYankes/nonrsbelumtte',
            '2' => $id == '48' ? 'Mutu_fasyankes/nonrsbelumverifikasi' : 'Mutu_fasyankes',
            '3' => 'Lembaga',
            '4' => 'Monitoring',
            '5' => 'AkreditasiNonRS',
            '7' => 'AdminNomorSurat',
            '8' => 'apps',
            '10' => 'DirjenYankes/nonrsbelumtte'
        ];

        if (isset($redirects[$jabatan])) {
            redirect($redirects[$jabatan]);
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger"><p>Jabatan tidak dikenali.</p></div>');
            redirect('Auth');
        }
    }

    public function logout() {
        // Log logout
        log_message('info', 'User logged out: ' . $this->session->userdata('name'));

        // Clear all session data
        $this->session->sess_destroy();
        
        // Redirect with message
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Anda telah berhasil logout</div>');
        redirect(base_url());
    }
}
