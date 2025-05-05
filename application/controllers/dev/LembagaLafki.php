<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LembagaLafki extends CI_Controller {
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
        $data = array('contents' => 'Lafki/Content_rekomendasi_lafki',
                       'data'    => $this->Dashboard_tte->tampil_rekomendasi($id)
                    );
       // echo json_encode($data['contents']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    
    {
        $id = $this->uri->segment(3);
        $this->Lafki($id);
        $this->Lafkilembaga($id);
        $this->Lafkidirjen($id);
        $data = array('contents' => "Lafki/Content_detail_lafki",
                      'rs'    => $this->Dashboard_tte->Detail($id),
                      'lembaga' => $this->session->userdata('lembaga_id')
                     );
       // echo json_encode($data['rs']);
        $this->load->view('List_Rekomendasi',$data);
    }

     public function Lafki($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'lafki_kosong'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lafki/Sertifikat_lafkikosong',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelafki($html,$file_pdf,$paper,$orientation);

        
    }

        public function Lafkilembaga($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'lafki_lembaga'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lafki/Sertifikat_lafkilembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatelembaga($html,$file_pdf,$paper,$orientation);

        
    }

    public function Lafkidirjen($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'lafki_dirjen'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lafki/Sertifikat_lafkidirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generatedirjen($html,$file_pdf,$paper,$orientation);

        
    }
}