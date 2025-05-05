<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LembagaLars extends CI_Controller {
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
        $data = array('contents' => 'Lars/Content_rekomendasi_lars',
                       'data'    => $this->Dashboard_tte->tampil_rekomendasi($id)
                    );
       // echo json_encode($data['contents']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    
    {
        $id = $this->uri->segment(3);
        // $this->Larsidirjen($id);
        // $this->Larsilembaga($id);
        // $this->Larsi($id);
        $data = array('contents' => "Lars/Content_detail_lars",
                      'rs'    => $this->Dashboard_tte->Detail($id),
                      'lembaga' => $this->session->userdata('lembaga_id')
                     );
       // echo json_encode($data['rs']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Lars($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Lars'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lars/Sertifikat_larskosong',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelars($html,$file_pdf,$paper,$orientation);

        
    }

        public function Larslembaga($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larslembaga'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Larsi/Sertifikat_larslembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelarslembaga($html,$file_pdf,$paper,$orientation);

        
    }
    

            public function Larsdirjen($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Larsdirjen'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lars/Sertifikat_larsdirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelarsdirjen($html,$file_pdf,$paper,$orientation);

        
    }
}