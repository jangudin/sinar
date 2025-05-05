<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LembagaLam extends CI_Controller {
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
        $data = array('contents' => 'Lam/Content_rekomendasi_lam',
                       'data'    => $this->Dashboard_tte->tampil_rekomendasi($id)
                    );
       // echo json_encode($data['contents']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    
    {
        $id = $this->uri->segment(3);
        $this->Lam($id);
        $this->Lamlembaga($id);
        $this->Lamdirjen($id);
        $data = array('contents' => "Lam/Content_detail_lam",
                      'rs'    => $this->Dashboard_tte->Detail($id),
                      'lembaga' => $this->session->userdata('lembaga_id')
                     );
       // echo json_encode($data['rs']);
        $this->load->view('List_Rekomendasi',$data);
    }

// generate pdf kars open

    public function Lam($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Lam'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lam/Sertifikat_lamkosong',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->Lam($html,$file_pdf,$paper,$orientation);

        
    }

    public function Lamlembaga($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Lamlembaga'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lam/Sertifikat_lamlembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->Lamlembaga($html,$file_pdf,$paper,$orientation);

        
    }

    public function Lamdirjen($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Lamdirjen'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Lam/Sertifikat_lamdirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->Lamdirjen($html,$file_pdf,$paper,$orientation);

        
    }
}