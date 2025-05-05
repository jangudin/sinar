<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileLpa extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('M_profile');
        $this->sina = $this->load->database('sina', TRUE);
        $this->load->library('encrypt');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }
    public function index()
    {
        $id = $this->session->userdata('id');
        $data = array('contents' => 'profile',
                       'profile' => $this->M_profile->data_profile($id)
                   );

       // echo json_encode($data['profile']); exit;
       $this->load->view('List_Rekomendasi',$data);
    }

    public function Updatepass()
    {
        $id = $this->session->userdata('id');
        $passlama = $this->input->pos('passlama');
        $passbaru = $this->input->pos('passbaru');

        $data = array('password' => $passbaru);
        $where = array('id' => $id,
                        'password' => $passlama);

        $this->M_profile->update_data($where,$data,'pengguna');
        redirect('crud/index');

    }

}