<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LembagaKars extends CI_Controller {
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
        $data = array('contents' => 'kars/conten_rekomendasi_kars1111',
                       'data'    => $this->Dashboard_tte->tampil_rekomendasi($id)
                    );
        echo json_encode($data['contents']);

        // $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    
    {
        $id = $this->uri->segment(3);
        $this->Kars($id);
        $this->Karslembaga($id);
        $this->Karsdirjen($id);
        $data = array('contents' => 'kars/Content_detail',
                      'rs'    => $this->Dashboard_tte->Detail($id),
                      'lembaga' => $this->session->userdata('lembaga_id')
                     );
        $this->load->view('List_Rekomendasi',$data);
    }

// generate pdf kars open

    public function Kars($id)
    {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'kars_kosong'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

		 $html =  $this->load->view('Kars/Sertifikat_kars',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generate_kars($html,$file_pdf,$paper,$orientation);

        
    }
        public function Karslembaga($id)
        {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Kars_lembaga'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Kars/Sertifikat_karslembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generate_kars($html,$file_pdf,$paper,$orientation);

        
    }
      public function Karsdirjen($id)
        {
        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Sertifikat';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Kars_dirjen'.$id;
        // setting paper
        $paper = 'A3';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $content = $this->Dashboard_tte->Detail($id);
        $data['data'] = $content;

       // echo json_encode($data[data]);

         $html =  $this->load->view('Kars/Sertifikat_karsdirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');
        

         $this->pdfgenerator->generate_kars($html,$file_pdf,$paper,$orientation);

        
    }
// generate pdf kars close
}