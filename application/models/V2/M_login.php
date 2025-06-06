<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {
    
    private $users_table = 'users';
    private $login_attempts_table = 'login_attempts';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function cek_login($email, $password) {
        $this->db->select('
            u.*,
            js.nama_jabatan,
            js.kode,
            la.nama_lembaga,
            ps.nama as nama_pejabat
        ');
        $this->db->from($this->users_table . ' u');
        $this->db->join('jabatan_sertifikat js', 'u.jabatan_sertifikat_id = js.id', 'left');
        $this->db->join('lembaga_akreditasi la', 'u.lembaga_akreditasi_id = la.id', 'left');
        $this->db->join('pejabat_sertifikat ps', 'u.pejabat_sertifikat_id = ps.id', 'left');
        $this->db->where('u.email', $email);
        $this->db->where('u.status', 'active');
        
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            $user = $query->row_array();
            if(password_verify($password, $user['password'])) {
                // Update last login
                $this->update_last_login($user['id']);
                // Log successful login
                $this->log_login_attempt($email, TRUE);
                return $query;
            }
        }
        
        // Log failed login
        $this->log_login_attempt($email, FALSE);
        return $query;
    }

    private function update_last_login($user_id) {
        $this->db->where('id', $user_id);
        $this->db->update($this->users_table, ['last_login' => date('Y-m-d H:i:s')]);
    }

    private function log_login_attempt($email, $success) {
        $data = array(
            'email' => $email,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'success' => $success ? 1 : 0,
            'attempted_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->login_attempts_table, $data);
    }

    public function get_login_attempts($email, $timeframe = 900) {
        $this->db->where('email', $email);
        $this->db->where('attempted_at >', date('Y-m-d H:i:s', time() - $timeframe));
        $this->db->where('success', 0);
        return $this->db->count_all_results($this->login_attempts_table);
    }

    public function is_account_locked($email) {
        $max_attempts = 3;
        $lockout_time = 900; // 15 minutes
        
        $attempts = $this->get_login_attempts($email, $lockout_time);
        return $attempts >= $max_attempts;
    }

    public function get_user_by_id($user_id) {
        $this->db->select('u.*, js.nama_jabatan, js.kode, la.nama_lembaga');
        $this->db->from($this->users_table . ' u');
        $this->db->join('jabatan_sertifikat js', 'u.jabatan_sertifikat_id = js.id', 'left');
        $this->db->join('lembaga_akreditasi la', 'u.lembaga_akreditasi_id = la.id', 'left');
        $this->db->where('u.id', $user_id);
        return $this->db->get()->row_array();
    }
}