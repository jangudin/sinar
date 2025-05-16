<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '500');
        $this->load->model('Dashboard_tte');
        $this->load->model('M_lpa');
        $this->sina = $this->load->database('sina', TRUE);
        $this->nmrs = $this->load->database('nmrs', TRUE);
        $this->load->library('encryption');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }
    public function index()
    {
        $id = $this->session->userdata('lembaga_id');
        $data = array('contents' => 'lembaga/Content_rekomendasi',
           'data'    => $this->Dashboard_tte->tampil_rekomendasi($id)
       );
       // echo json_encode($data['data']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function sudahtte()
    {
        $id = $this->session->userdata('lembaga_id');
        $data = array('contents' => 'lembaga/Content_rekomendasi',
           'data'    => $this->Dashboard_tte->sudahtte($id)
       );
       // echo json_encode($data['data']);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function progrestte()
    {
     $id = $this->session->userdata('lembaga_id');
     $data = array('contents' => 'lembaga/Progres_tte',
       'data'    => $this->Dashboard_tte->sudahtte($id),
   );
       // echo json_encode($data['data']);
     $this->load->view('List_Rekomendasi',$data);
        // $cek = $this->Dashboard_tte->cekdata('x');
        // $x = $cek->num_rows();
        // echo json_encode($x);exit;
 }


 public function Detail()
 {

    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    $idlembaga = $this->session->userdata('lembaga_id');
    if($idlembaga == 'kars'){
        // $this->Kars($id);
        $this->Karslembaga($id);
        // $this->Karsdirjen($id);
        $attachment = 'assets/generate/kars/kars_kosong'.$id.'.pdf';
    }elseif($idlembaga == 'lam') {
        $this->Lam($id);
        $this->Lamlembaga($id);
        $this->Lamdirjen($id);
        $attachment = 'assets/generate/lam/Lam'.$id.'.pdf';
    }elseif ($idlembaga == 'larsi') {
        $this->Larsi($id);
        $this->Larsilembaga($id);
        $this->Larsidirjen($id);
        $attachment = 'assets/generate/larsi/Larsi'.$id.'.pdf';
    }elseif ($idlembaga == 'larsdhp') {
        $this->Larsdhp($id);
        $this->Larsdhplembaga($id);
        $this->Larsdhpdirjen($id);
        $attachment = 'assets/generate/larsdhp/Larsdhp'.$id.'.pdf';

    }elseif ($idlembaga == 'lafki') {
        $this->Lafki($id);
        $this->Lafkilembaga($id);
        $this->Lafkidirjen($id);
        $attachment = 'assets/generate/lafki/lafki'.$id.'.pdf';

    }elseif ($idlembaga == 'lars') {
        $this->Lars($id);
        $this->Larslembaga($id);
        $this->Larsdirjen($id);
        $attachment = 'assets/generate/lars/Lars'.$id.'.pdf';
    }
    $nonik = $this->session->userdata('nik'); 
    $data = array('contents' => "lembaga/Contentdetail",
      'rs'    => $this->Dashboard_tte->Detail($id),
      'lembaga' => $this->session->userdata('lembaga_id'),
      'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
      'nik' => $nonik,
      'id' => $id,
  );

    $this->load->view('List_Rekomendasi',$data);
}

public function resume()

{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    if ($this->session->userdata('lembaga_id') == 'kars') {
        $attachment = 'assets/generate/kars/tteKars_lembaga'.$id.'.pdf';
        $hasiltte = 'assets/generate/kars/kars_kosong'.$id.'.pdf';
    }elseif ($this->session->userdata('lembaga_id') == 'lam') {
        $attachment = 'assets/generate/lam/tteLamlembaga'.$id.'.pdf';
        $hasiltte = 'assets/generate/lam/Lam'.$id.'.pdf';
    }elseif ($this->session->userdata('lembaga_id') == 'larsi') {
        $attachment = 'assets/generate/larsi/tteLarsilembaga'.$id.'.pdf';
        $hasiltte = 'assets/generate/larsi/Larsi'.$id.'.pdf';
    }elseif ($this->session->userdata('lembaga_id') == 'larsdhp') {
        $attachment = 'assets/generate/larsdhp/tteLarsdhplembaga'.$id.'.pdf';
        $hasiltte = 'assets/generate/larsdhp/Larsdhp'.$id.'.pdf';
    }elseif ($this->session->userdata('lembaga_id') == 'lafki') {
        $attachment = 'assets/generate/lafki/ttelafkilembaga'.$id.'.pdf';
        $hasiltte = 'assets/generate/lafki/lafki'.$id.'.pdf';
    }elseif ($this->session->userdata('lembaga_id') == 'lars') {
        $attachment = 'assets/generate/lars/tteLarslembaga'.$id.'.pdf';
        $hasiltte = 'assets/generate/lars/Lars'.$id.'.pdf';
    }

    $nonik = $this->session->userdata('nik'); 
    $cek = $this->Dashboard_tte->getByidrekomendasi($id);
    $data = array('contents' => "lembaga/resume",
      'rs'    => $this->Dashboard_tte->Detail($id),
      'lembaga' => $this->session->userdata('lembaga_id'),
      'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
      'nik' => $nonik,
      'id' => $id,
      'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
      'cekid' => $cek,
  ); 

        // echo json_encode($data['cekid']['mutu']);
    $this->load->view('List_Rekomendasi',$data);
}

// generate pdf kars open

private function base64EncodeImage($filename = "")
{
    if (file_exists($filename)) {
        $type = pathinfo($filename, PATHINFO_EXTENSION);
        $data = file_get_contents($filename);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
    return '';
}

public function Kars($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    $this->load->library('pdfgenerator');
      $data['background_base64'] = $this->base64EncodeImage(FCPATH . 'assets/bgsertifikat/newKARS-0.jpg');
      $data['paripurna'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsparipurna.png');
      $data['utama'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsutama.png');
      $data['madya'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsmadya.png');

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

    $html =  $this->load->view('lembaga/Sertifikat_kars',$data,true);

          // $html =  base_url('assets/KARS1.png');


    $this->pdfgenerator->generate_kars($html,$file_pdf,$paper,$orientation);


}
public function Karslembaga($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    $this->load->library('pdfgenerator');
     $data['background_base64'] = $this->base64EncodeImage(FCPATH . 'assets/bgsertifikat/newKARS-1.jpg');
     $data['paripurna'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsparipurna.png');
     $data['utama'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsutama.png');
     $data['madya'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsmadya.png');

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

    $html =  $this->load->view('lembaga/Sertifikat_karslembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');


    $this->pdfgenerator->generate_kars($html,$file_pdf,$paper,$orientation);


}
public function Karsdirjen($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    $this->load->library('pdfgenerator');
     $data['background_base64'] = $this->base64EncodeImage(FCPATH . 'assets/bgsertifikat/newKARS-2.jpg');
     $data['paripurna'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsparipurna.png');
     $data['utama'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsutama.png');
     $data['madya'] = $this->base64EncodeImage(FCPATH . 'assets/capayan/karsmadya.png');

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

    $html =  $this->load->view('lembaga/Sertifikat_karsdirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');


    $this->pdfgenerator->generate_kars($html,$file_pdf,$paper,$orientation);


}
// generate pdf kars close



public function Lam($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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

public function Larsi($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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

public function Larsdhp($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);

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


public function Lafki($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    $this->load->library('pdfgenerator');

        // title dari pdf
    $this->data['title_pdf'] = 'Sertifikat';

        // filename dari pdf ketika didownload
    $file_pdf = 'lafki'.$id;
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    $this->load->library('pdfgenerator');

        // title dari pdf
    $this->data['title_pdf'] = 'Sertifikat';

        // filename dari pdf ketika didownload
    $file_pdf = 'lafkilembaga'.$id;
        // setting paper
    $paper = 'A3';
        //orientasi paper potrait / landscape
    $orientation = "portrait";
    $content = $this->Dashboard_tte->Detail($id);
    $data['data'] = $content;

       // echo json_encode($data[data]);

    $html =  $this->load->view('Lafki/Sertifikat_lafkilembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');


    $this->pdfgenerator->generatelafkilembaga($html,$file_pdf,$paper,$orientation);


}

public function Lafkidirjen($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
    $this->load->library('pdfgenerator');

        // title dari pdf
    $this->data['title_pdf'] = 'Sertifikat';

        // filename dari pdf ketika didownload
    $file_pdf = 'lafkidirjen'.$id;
        // setting paper
    $paper = 'A3';
        //orientasi paper potrait / landscape
    $orientation = "portrait";
    $content = $this->Dashboard_tte->Detail($id);
    $data['data'] = $content;

       // echo json_encode($data[data]);

    $html =  $this->load->view('Lafki/Sertifikat_lafkidirjen',$data,true);

          // $html =  base_url('assets/KARS1.png');


    $this->pdfgenerator->generatelafkidirjen($html,$file_pdf,$paper,$orientation);


}

public function Lars($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);
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
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);

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

    $html =  $this->load->view('Lars/Sertifikat_larslembaga',$data,true);

          // $html =  base_url('assets/KARS1.png');


    $this->pdfgenerator->generatelarslembaga($html,$file_pdf,$paper,$orientation);


}


public function Larsdirjen($id)
{
    $uri = $this->uri->segment(3);
    $id = decrypt_url($uri);

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

public function lembagatte()
{
        // $nik = '0803202100007062';
    $passphrase = $this->input->post('passphrase');
        // // $nm = $this->input->post('namars');
    $kd = $this->input->post('id');
    $nik = $this->input->post('nik');
        // $jabatan_id = $this->input->post('jabatan_id');
        // $NameFile = "filePdflembaga$kd.pdf";
    $url = base_url('Lembaga/resume/' .encrypt_url($kd));
    $urlback = base_url('Lembaga/Detail/' .encrypt_url($kd));

    $data = array(
        'nik' => $nik,
            // 'passphrase' => '!Bsre1221*',
        'passphrase' => $passphrase,
        'tampilan' => 'invisible',
        'image' => 'true',
        'halaman' => 'pertama',
        'text' => ''
    ); 

    $arrayName = array('id_rekomendasi' =>$kd,
        'nik'           =>$nik,
        'ststus'        =>1,
        'keterangan'    =>'succes', );

    if ($this->session->userdata('lembaga_id') == 'kars') {
        $filename = "Kars_lembaga".$kd.".pdf";
        $filedir = "Kars_dirjen".$kd.".pdf";
        $attachment = 'assets/generate/kars/' . $filename;
        $attachmentdir = 'assets/generate/kars/' . $filedir;
        $data['file'] = curl_file_create(
            FCPATH . $attachment,
            'application/pdf',
            $filename
        );
        $uploadDir = FCPATH . 'assets/generate/kars/tte';
    }elseif($this->session->userdata('lembaga_id') == 'lam'){
        $filename = "Lamlembaga".$kd.".pdf";
        $filedir = "Lamdirjen".$kd.".pdf";
        $attachment = 'assets/generate/lam/' . $filename;
        $attachmentdir = 'assets/generate/lam/' . $filedir;
        $data['file'] = curl_file_create(
            FCPATH . $attachment,
            'application/pdf',
            $filename
        );
        $uploadDir = FCPATH . 'assets/generate/lam/tte';
    }elseif($this->session->userdata('lembaga_id') == 'larsi'){
        $filename = "Larsilembaga".$kd.".pdf";
        $filedir = "Larsidirjen".$kd.".pdf";
        $attachment = 'assets/generate/larsi/' . $filename;
        $attachmentdir = 'assets/generate/larsi/' . $filedir;
        $data['file'] = curl_file_create(
            FCPATH . $attachment,
            'application/pdf',
            $filename
        );
        $uploadDir = FCPATH . 'assets/generate/larsi/tte';
    }elseif($this->session->userdata('lembaga_id') == 'larsdhp'){
        $filename = "Larsdhplembaga".$kd.".pdf";
        $filedir = "Larsdhpdirjen".$kd.".pdf";
        $attachment = 'assets/generate/larsdhp/' . $filename;
        $attachmentdir = 'assets/generate/larsdhp/' . $filedir;
        $data['file'] = curl_file_create(
            FCPATH . $attachment,
            'application/pdf',
            $filename
        );
        $uploadDir = FCPATH . 'assets/generate/larsdhp/tte';
    }elseif($this->session->userdata('lembaga_id') == 'lafki'){
        $filename = "lafkilembaga".$kd.".pdf";
        $filedir = "lafkidirjen".$kd.".pdf";
        $attachment = 'assets/generate/lafki/' . $filename;
        $attachmentdir = 'assets/generate/lafki/' . $filedir;
        $data['file'] = curl_file_create(
            FCPATH . $attachment,
            'application/pdf',
            $filename
        );
        $uploadDir = FCPATH . 'assets/generate/lafki/tte';
    }elseif($this->session->userdata('lembaga_id') == 'lars'){
        $filename = "Larslembaga".$kd.".pdf";
        $filedir = "Larsdirjen".$kd.".pdf";
        $attachment = 'assets/generate/lars/' . $filename;
        $attachmentdir = 'assets/generate/lars/' . $filedir;
        $data['file'] = curl_file_create(
            FCPATH . $attachment,
            'application/pdf',
            $filename
        );
        $uploadDir = FCPATH . 'assets/generate/lars/tte';
    }


        // print_r($data)

        // var_dump($data);
    $headers = array(
        'Authorization: Basic ZXNpZ24tc2luYXI6a3EmVW5EMzFAbA==',
        "Content-Type:multipart/form-data",
        );  // cURL headers for file uploading

    $ch = curl_init();
    $options = array(
       CURLOPT_URL => 'http://esign-e-sign.apps.prdocp.dc.kemkes.go.id/api/sign/pdf',
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS => $data,
       CURLOPT_USERPWD=> 'esign-sinar2'.':'.'s1n4r3344x',

           ); // cURL options

    curl_setopt_array($ch, $options);

    $result =  curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

       // var_dump($httpcode);exit;

    if($httpcode != 200)
    {
        curl_close($ch);
            // die('terjadi kesalahan saat mengupload file.');
        echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            Passprase Salah silahkan Coba lagi.....</div>');
        redirect($urlback);
    }

    if ($result === false) 
    {
        $info = curl_getinfo($ch);
        curl_close($ch);
            // die();
        $err = 'error occured during curl exec. Additioanl info: ' . var_export($info);
        echo "<script>alert('Galat: " . $err . "'); window.location.href = '" . $url ."'</script>";
    }

    curl_close($ch);


    $fp = fopen($uploadDir . $filename, 'w');
    fwrite($fp, $result);
    fclose($fp);
    $sertifikat1 = array('rekomendasi_id' => $kd,
        'pejabat_sertifikat_id' => $this->session->userdata('pid'),
        'url_tte' => $filename,
        'pengguna_id' => $this->session->userdata('id'),
    );
    $simpan = $this->db->insert('sertifikat_1',$sertifikat1);
    $this->dirgenlembagatte1($kd,$passphrase,$filename,$filedir,$attachmentdir,$uploadDir,$nik);

    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
       // echo json_encode($data);exit;
    redirect($url);
        // 

        // file_put_contents($result);

        // header('Content-type: ' . 'application/octet-stream');
        // header('Content-Disposition: ' . "attachment; filename=$filename");

}



public function dirgenlembagatte1($id,$passphrase,$filename,$filedir,$attachmentdir,$uploadDir,$nik)
{

    $kd = $id;
    $url = base_url('Lembaga/resume/' .encrypt_url($kd));
    $passphrase = $passphrase;

    $data = array(
        'nik' => $nik,
        'passphrase' => $passphrase,
        'tampilan' => 'invisible',
        'image' => 'true',
        'halaman' => 'pertama',
        'text' => ''
    ); 

    $data['file'] = curl_file_create(
        FCPATH . $attachmentdir,
        'application/pdf',
        $filedir
    );
        // print_r($data)

        // var_dump($data);
    $headers = array(
        'Authorization: Basic ZXNpZ24tc2luYXI6a3EmVW5EMzFAbA==',
        "Content-Type:multipart/form-data",
        );  // cURL headers for file uploading

    $ch = curl_init();
    $options = array(
       CURLOPT_URL => 'http://esign-e-sign.apps.prdocp.dc.kemkes.go.id/api/sign/pdf',
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_POSTFIELDS => $data,
       CURLOPT_USERPWD=> 'esign-sinar2'.':'.'s1n4r3344x',

           ); // cURL options

    curl_setopt_array($ch, $options);

    $result =  curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // var_dump($httpcode);exit();

    if($httpcode != 200)
    {
        curl_close($ch);
            // die('terjadi kesalahan saat mengupload file.');
        echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            Passprase Salah silahkan Coba lagi.....</div>');
        redirect($urlback);
    }

    if ($result === false) 
    {
        $info = curl_getinfo($ch);
        curl_close($ch);
            // die();
        $err = 'error occured during curl exec. Additioanl info: ' . var_export($info);
        echo "<script>alert('Galat: " . $err . "'); window.location.href = '" . $url ."'</script>";
    }

    curl_close($ch);


    $fp = fopen($uploadDir . $filedir, 'w');
    fwrite($fp, $result);
    fclose($fp);

    $data1 = array('id_rekomendasi' => $kd,
        'lembaga' => '1',
        'tgl_dibuat_lembaga' => date('Y-m-d H:i:s'),
        'sertifikat_1' => $filename);
    $simpan = $this->db->insert('Sertifikat_progres1',$data1);


    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
    redirect($url);


        // file_put_contents($result);

        // header('Content-type: ' . 'application/octet-stream');
        // header('Content-Disposition: ' . "attachment; filename=$filename");
        // echo $result;
}

public function surat_tugas()
{

    $idlpa=$this->session->userdata('lembaga_id');
    $sts = $this->uri->segment(3);
    $status = decrypt_url($sts);
     $listkd = $this->M_lpa->get_all_surtug($idlpa,$status);
    $kode_rs_list = array_map(function($item) {
        return $item->kode_rs;
    }, $listkd);
    $kd = implode(',', $kode_rs_list);
    if ($kd == null) {
        $kd = [];
    }else{
    $list = $this->M_lpa->get_nama_rs($kd);
    $merged_data = $this->merge_array($listkd, $list);
    $data['survei'] = $merged_data;
    }
    $data['contents'] = "STRS/home";
    // echo json_encode($);

    // echo "<pre>";
    // print_r($kd);
    // exit;
    $this->load->view('List_Rekomendasi',$data);
}

    private function merge_array($listkd, $list) {
        $result = [];
        
        foreach ($listkd as $survei) {
            foreach ($list as $rs) {
                if ($survei->kode_rs === $rs->Propinsi) {
                    // Gabungkan data survei dengan data rumah sakit
                    $merged_item = (object) array_merge((array) $survei, (array) $rs);
                    $result[] = $merged_item;
                }
            }
        }
        
        return $result;
    }

public function surat_tugas_detail()
{

    $ide = $this->uri->segment(3);
    $id = decrypt_url($ide);
    $this->surtug($id);
    $this->surtugttd($id);
    $detail = $this->M_lpa->get_id_surtug($id);
    $data = array('contents' => 'STRS/detail',
      'data'     => $detail,
      'id'      => $id
  );
    // echo json_encode($detail);
     $this->load->view('List_Rekomendasi',$data);
}

public function surtug($id)
{

   $this->load->library('pdfgenerator');
   $this->data['title_pdf'] = 'Sertifikat';
   $file_pdf = 'st'.$id;
   $paper = 'A4';
   $orientation = "potrait";
    $content = $this->M_lpa->get_surtug_byid($id);
        
        if (!empty($content)) {
            $kd = $content[0]->kode_rs;  // Tanpa json_encode
            $idlpa = $content[0]->lpa_satu; // Tanpa json_encode
             $rs = $this->M_lpa->get_nama_rs($kd);
             $LPA = $this->M_lpa->lpa($idlpa);
            $data['content'] = $content[0]; // Data dari surat tugas
            $data['rs'] = !empty($rs) ? $rs[0] : []; // Data rumah sakit (ambil satu data)
            $data['lpa'] = !empty($LPA) ? $LPA[0] : []; // Data LPA (ambil satu data)
        } else {
            $data['content'] = [];
            $data['rs'] = [];
            $data['lpa'] = [];
        }

      $html =  $this->load->view('STRS/st',$data,true);
      $this->pdfgenerator->generatesurtug($html,$file_pdf,$paper,$orientation);
}



public function surtugttd($id)
{

   $this->load->library('pdfgenerator');
   $this->data['title_pdf'] = 'stttd';
   $file_pdf = 'stttd'.$id;
   $paper = 'A4';
   $orientation = "potrait";
       $content = $this->M_lpa->get_surtug_byid($id);
        
        if (!empty($content)) {
            $kd = $content[0]->kode_rs;  // Tanpa json_encode
            $idlpa = $content[0]->lpa_satu; // Tanpa json_encode
             $rs = $this->M_lpa->get_nama_rs($kd);
             $LPA = $this->M_lpa->lpa($idlpa);
            $data['content'] = $content[0]; // Data dari surat tugas
            $data['rs'] = !empty($rs) ? $rs[0] : []; // Data rumah sakit (ambil satu data)
            $data['lpa'] = !empty($LPA) ? $LPA[0] : []; // Data LPA (ambil satu data)
        } else {
            $data['content'] = [];
            $data['rs'] = [];
            $data['lpa'] = [];
        }

   $html =  $this->load->view('STRS/stttd',$data,true);
   $this->pdfgenerator->generatesurtugtt($html,$file_pdf,$paper,$orientation);
}


public function ttesurtugrs()
{
    $id = $this->input->post('id');
    $url = base_url('Lembaga/surat_tugas_detail/'.encrypt_url($id));
    $nik = $this->input->post('nik');
    $passphrase = $this->input->post('passphrase');
    $filename = "stttd".$id.".pdf";
    $attachment = 'assets/surtugrs/surtugtt/'. $filename;
    $data = array(
        'nik' => $nik,
        'passphrase' => $passphrase,
        'tampilan' => 'invisible',
        'image' => 'true',
        'halaman' => 'pertama',
        'text' => ''
    ); 
    $data['file'] = curl_file_create(
        FCPATH . $attachment,
        'application/pdf',
        $filename
    );
    $headers = array(
        'Authorization: Basic ZXNpZ25jcy1kZXYta2VtZW5rZXM6VDJSUzNNNFJLdzJOU3FYZg==',
        "Content-Type:multipart/form-data",
        );  // cURL headers for file uploading
    $ch = curl_init();
    $options = array(
      CURLOPT_URL => 'http://esign-e-sign.apps.prdocp.dc.kemkes.go.id/api/sign/pdf',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_USERPWD=> 'esign-sinar2'.':'.'s1n4r3344xl',
           ); // cURL options

    curl_setopt_array($ch, $options);

    $result =  curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // var_dump($httpcode);

    if($httpcode != 200)
    {
        curl_close($ch);
            // die('terjadi kesalahan saat mengupload file.');
        // echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible " role="alert">
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        //     Passprase Salah silahkan Coba lagi.....</div>');

        echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            '.$result.'</div>');

        redirect($url);
    }

    if ($result === false) 
    {
        $info = curl_getinfo($ch);
        curl_close($ch);
            // die();
        $err = 'error occured during curl exec. Additioanl info: ' . var_export($info);
        echo "<script>alert('Galat: " . $err . "'); window.location.href = '" . $url ."'</script>";
    }


    curl_close($ch);
    $uploadDir = FCPATH . 'assets/surtugrs/surtugtte/final';
    $fp = fopen($uploadDir . $filename, 'w');
    fwrite($fp, $result);
    fclose($fp);
    $ttetgl = format_indo(date('Y-m-d'));
    $query = "UPDATE surtug_rs SET status_tte = 1 WHERE id =".$id;
    $sql = $this->sina->query($query);
    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
    redirect($url);
}

}
