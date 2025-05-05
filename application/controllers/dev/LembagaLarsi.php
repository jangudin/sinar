<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LembagaLarsi extends CI_Controller {
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
        $data = array('contents' => 'Larsi/Content_rekomendasi_larsi',
                       'data'    => $this->Dashboard_tte->tampil_rekomendasi($id)
                    );
       // echo json_encode($data['contents']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    
    {
        $id = $this->uri->segment(3);
        $this->Larsidirjen($id);
        // $this->Larsilembaga($id);
        // $this->Larsi($id);
        $data = array('contents' => "Larsi/Content_detail_larsi",
                      'rs'    => $this->Dashboard_tte->Detail($id),
                      'lembaga' => $this->session->userdata('lembaga_id')
                     );
       // echo json_encode($data['rs']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Larsi($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larsi'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Larsi/Sertifikat_larsikosong',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelasi($html,$file_pdf,$paper,$orientation);

        
    }

        public function Larsilembaga($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larsilembaga'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Larsi/Sertifikat_larsilembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelasilembaga($html,$file_pdf,$paper,$orientation);

        
    }
    

            public function Larsidirjen($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larsidirjen'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Larsi/Sertifikat_larsidirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelasidirjen($html,$file_pdf,$paper,$orientation);

        
    }
}