<?php
class GenerateUlang extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Tte_non_rs');
        $this->sina = $this->load->database('sina', TRUE);
        $this->load->helper('tanggal_indonesia');
}

public function filesertifikat()
{
        $faskes = $this->uri->segment(3);
        $id = $this->uri->segment(4);

        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Sertifikat';
        $content = $this->Tte_non_rs->bahansertifikat('klinik','1290053');
        $data['data'] = $content;
        $file_pdf = $id;
        $paper = 'A4';
        $orientation = "landscape";
          //  echo json_encode($data['data']);
        $html =  $this->load->view('Sertifikatfaskesnew/sertifikatkosong',$data,true);
        $this->pdfgenerator->generatefaskes($html, $file_pdf,$paper,$orientation);


}
}