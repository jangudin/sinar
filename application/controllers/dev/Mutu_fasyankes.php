<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutu_fasyankes extends CI_Controller {
    function __construct(){
		parent::__construct();
        $this->load->model('Dashboard_tte');
		if($this->session->userdata('status') != "login"){
			redirect(base_url());
		}
	}
    public function index()
        {
        $id = 0;
        $data = array('contents' => 'list_mutu',
                       'data'    => $this->Dashboard_tte->list_mutu($id)
                    );
         //echo json_encode($data['data']);
      $this->load->view('List_Rekomendasi',$data);
    }
     public function sudahverif()
        {
        $id = 0;
        $data = array('contents' => 'listsudahverif',
                       'data'    => $this->Dashboard_tte->sudahverif($id)
                    );
      //  echo json_encode($data['data']);
       $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    {
        $id = $this->uri->segment(3);
        $data['idrek'] = $this->Dashboard_tte->detail_mutu($id);

        foreach($data['idrek'] as $file) {
        if ($file->lembagaAkreditasiId == 'lafki') {
             $attachment = 'assets/generate/lafki/ttelafkilembaga'.$id.'.pdf';
        }elseif($file->lembagaAkreditasiId == 'kars'){
            $attachment = 'assets/generate/kars/tteKars_lembaga'.$id.'.pdf';
        }elseif($file->lembagaAkreditasiId == 'lars'){
            $attachment = 'assets/generate/lars/tteLarslembaga'.$id.'.pdf';
        }elseif($file->lembagaAkreditasiId == 'lam'){
            $attachment = 'assets/generate/lam/tteLamlembaga'.$id.'.pdf';
        }elseif($file->lembagaAkreditasiId == 'larsdhp'){
            $attachment = 'assets/generate/larsdhp/tteLarsdhplembaga'.$id.'.pdf';
        }elseif($file->lembagaAkreditasiId == 'larsi'){
            $attachment = 'assets/generate/larsi/tteLarsilembaga'.$id.'.pdf';
        }
    }
       
        $data = array('contents' =>'Detail_mutu',
                      'data'     => $this->Dashboard_tte->detail_mutu($id),
                      'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
                      'id' => $id
                        );
          // echo json_encode($data['data']);
          $this->load->view('List_Rekomendasi',$data);
    }

    public function Verifikasi_mutu()
    {
      $id = $this->input->post('id');
      $mutu = $this->input->post('status');
      $keterangan = $this->input->post('keterangan');
      $time = date('Y-m-d H:i:s');
      $url = base_url('Mutu_fasyankes/Detail/'.$id);
      $this->Dashboard_tte->verifikasi_mutu($mutu,$keterangan,$id,$time);
      redirect($url);


    }


}