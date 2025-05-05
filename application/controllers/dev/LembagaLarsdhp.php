<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LembagaLarsdhp extends CI_Controller {
    function __construct(){
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Dashboard_tte');
		if($this->session->userdata('status') != "login"){
			redirect(base_url());
		}
	}
    public function index()
    {
        $id = $this->session->userdata('lembaga_id');
        $data = array('contents' => 'Larsdhp/Content_rekomendasi_larsdhp',
                       'data'    => $this->Dashboard_tte->tampil_rekomendasi($id)
                    );
       // echo json_encode($data['contents']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    
    {
        $id = $this->uri->segment(3);
        $this->Larsdhp($id);
        $this->Larsdhplembaga($id);
        $this->Larsdhpdirjen($id);
        $data = array('contents' => "Larsdhp/Content_detail_larsdhp",
                      'rs'    => $this->Dashboard_tte->Detail($id),
                      'lembaga' => $this->session->userdata('lembaga_id')
                     );
       // echo json_encode($data['rs']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Larsdhp($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larsdhp'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Larsdhp/Sertifikat_larsdhpkosong',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelarsdhp($html,$file_pdf,$paper,$orientation);

        
    }

        public function Larsdhplembaga($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larsdhplembaga'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Larsdhp/Sertifikat_larsdhplembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelarsdhplembaga($html,$file_pdf,$paper,$orientation);

        
    }
    

            public function Larsdhpdirjen($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larsdhpdirjen'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Larsdhp/Sertifikat_larsdhpdirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelarsdhpdirjen($html,$file_pdf,$paper,$orientation);

        
    }
}