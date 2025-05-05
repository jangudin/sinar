<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {
        function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('Model_monitoring');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

        public function index()
        {
                $data = array('content' =>'monitoring/index',
                                'list' => $this->Model_monitoring->daftar_rs(),
                                'jmlrek' => $this->Model_monitoring->jumlahrekomendasi(),
                                'jumgrouplem' => $this->Model_monitoring->jumlahlembaga(),
                                'dikerjakanlem' => $this->Model_monitoring->dikerjakanlem(),
                                'dikerjakanmutu' => $this->Model_monitoring->dikerjakanmutu(),
                                'dikerjakandir' => $this->Model_monitoring->dikerjakandirjen(),

                            );
              //  echo json_encode($data['jmlrek']);
               $this->load->view('monitoring',$data);
                
        }
}