<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('Tte_non_rs');
        $this->load->model('New_progres');
        $this->load->model('M_task');
        $this->sina = $this->load->database('sina', TRUE);
        $this->dbfaskes = $this->load->database('dbfaskes', TRUE);
        $this->load->library('encryption');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

    public function index()
    {
         $data = array('contents' => 'AkreditasiNonRS',
            'name'    => $this->session->userdata('name'),
            // 'sudah'  => $this->Tte_non_rs->faskes_detail($id),
        );
       $this->load->view('dashboard/index',$data);
   }

}
