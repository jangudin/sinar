<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sinar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

    public function index() {
        $data['title'] = 'Manajemen User';
        $data['content'] = 'apps/index';
        $data['users'] = $this->User_model->get_all();

        $this->load->view('apps/admin_template', $data);
    }

    public function create() {
        $data['title'] = 'Tambah User';
        $data['content'] = 'apps/create';
        $this->load->view('apps/admin_template', $data);
    }

    public function store() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/create');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'srt_klas' => $this->input->post('srt_klas'),
                'pejabat_sertifikat_id' => $this->input->post('pejabat_sertifikat_id'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->User_model->create($data);
            redirect('user');
        }
    }

    public function edit($id) {
        $data['user'] = $this->User_model->get_by_id($id);
        $this->load->view('user/edit', $data);
    }

    public function update($id) {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->User_model->get_by_id($id);
            $this->load->view('user/edit', $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'srt_klas' => $this->input->post('srt_klas'),
                'pejabat_sertifikat_id' => $this->input->post('pejabat_sertifikat_id'),
                'modified_at' => date('Y-m-d H:i:s')
            ];

            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->User_model->update($id, $data);
            redirect('user');
        }
    }

    public function delete($id) {
        $this->User_model->delete($id);
        redirect('user');
    }

    public function view($id) {
        $data['title'] = 'Tambah User';
        $data['content'] = 'apps/view';
        $data['user'] = $this->User_model->get_by_id($id);
        $this->load->view('apps/admin_template', $data);
    }
    public function GetPkm()
    {
         $data['title'] = 'Get Data PKM';
        $data['content'] = 'apps/mspkm';
        $this->load->view('apps/admin_template', $data);
    }
}