<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Controller {
    function __construct(){
		parent::__construct();
        $this->load->model('Dashboard_tte');
		if($this->session->userdata('status') != "login"){
			redirect(base_url());
		}
	}
    public function Lafki()
    {
      //  $id = $this->session->userdata('lembaga_id');
        // $data['data']=$this->Dashboard_tte->tampil_rekomendasi($id);
        // echo json_encode($id);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = "Lafki";
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

		$html =  $this->load->view('Sertifikat_lafki',$this->data,true);
        

         $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);

        
    }

    public function Kars()
    {
      //  $id = $this->session->userdata('lembaga_id');
        // $data['data']=$this->Dashboard_tte->tampil_rekomendasi($id);
        // echo json_encode($id);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = "Lafki";
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

		$html =  $this->load->view('Sertifikat_kars',$this->data,true);
        

         $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);

        
    }

    public function Lamkprs()
    {
      //  $id = $this->session->userdata('lembaga_id');
        // $data['data']=$this->Dashboard_tte->tampil_rekomendasi($id);
        // echo json_encode($id);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = "Lafki";
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

		$html =  $this->load->view('Sertifikat_lamkprs',$this->data,true);
        

         $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);

        
    }

    public function Lars()
    {
      //  $id = $this->session->userdata('lembaga_id');
        // $data['data']=$this->Dashboard_tte->tampil_rekomendasi($id);
        // echo json_encode($id);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = "Lafki";
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

		$html =  $this->load->view('Sertifikat_lars',$this->data,true);
        

         $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);

        
    }

    public function Larsi()
    {
      //  $id = $this->session->userdata('lembaga_id');
        // $data['data']=$this->Dashboard_tte->tampil_rekomendasi($id);
        // echo json_encode($id);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = "Lafki";
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

		$html =  $this->load->view('Sertifikat_larsi',$this->data,true);
        

         $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);

        
    }
}