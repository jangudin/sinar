<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_tugas extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('M_surat_tugas');
        $this->sina = $this->load->database('sina', TRUE);
        $this->load->library('encryption');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }
    public function general()
    {
        $lpa = $this->session->userdata('lembaga_id');
        $fas = $this->uri->segment(3);
        if (!$fas){
            $list = $this->M_surat_tugas->nol();
            $data = array('contents' => 'surtug/surattugas',
                            'data'   => $list);
        }else{
            $ket = $this->uri->segment(4);
            if ($fas == 'puskes') {

                $list = $this->M_surat_tugas->puskesmas($ket,$lpa);
                $data = array('contents' => 'surtug/surattugas',
                    'data'    => $list,
                );
            }
        }
       // echo json_encode($data['jenis']);exit;
        $this->load->view('List_Rekomendasi',$data);
    }

    public function klinik()
    {
        $ket = $this->uri->segment(3);
        $lpa = $this->session->userdata('lembaga_id');
        $list = $this->M_surat_tugas->klinik($lpa,$ket);
        $data = array('contents' => 'surtug/surattugasklinik',
                    'data'    => $list,
                );
        $this->load->view('List_Rekomendasi',$data);
    }

        public function labkes()
    {
        $ket = $this->uri->segment(3);
        $jnis = 'LABKES';
        $lpa = $this->session->userdata('lembaga_id');
        $list = $this->M_surat_tugas->labkes($lpa,$ket);
        $data = array('contents' => 'surtug/surattugaslab',
                    'data'    => $list,
                );
        $this->load->view('List_Rekomendasi',$data);
    }

            public function utd()
    {
        $ket = $this->uri->segment(3);
        $jnis = 'UTD';
        $lpa = $this->session->userdata('lembaga_id');
        $list = $this->M_surat_tugas->utd($lpa,$ket);
        $data = array('contents' => 'surtug/surattugasutd',
                    'data'    => $list,
                );
        $this->load->view('List_Rekomendasi',$data);
    }

    public function Detail()
    { 
        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'PUSKESMAS';
        $this->printsurat();
        $this->printsuratTTE();
        $attachment = 'assets/surtug/tte'.$id.'.pdf';
        $hasiltte = 'assets/surtug/'.$id.'.pdf';
        $data = array('contents' => 'surtug/review',
         // 'survei'  =>$this->M_surat_tugas->tgl_survei($kd),
         // 'jns'      => $jnis,
         // 'nar'  =>$this->M_surat_tugas->narahubung($kd),
         // 'data'    => $this->M_surat_tugas->printsurat($kd),
         'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
         'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
     );
     //  echo json_encode($data['survei']);exit;
        $this->load->view('List_Rekomendasi',$data);
    }


    public function detailklinik()
    { 
        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $this->printsuratklinik();
        $this->printsuratTTEklinik();
        $jnis = 'KLINIK';
        $attachment = 'assets/surtug/tte'.$id.'.pdf';
        $hasiltte = 'assets/surtug/'.$id.'.pdf';
        $data = array('contents' => 'surtug/review',
         // 'survei'  =>$this->M_surat_tugas->tgl_survei($kd),
         // 'jns'      => $jnis,
         // 'nar'  =>$this->M_surat_tugas->narahubung($kd),
         // 'data'    => $this->M_surat_tugas->printsuratklinik($id),
         'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
         'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
     );
       //echo json_encode($data['data']);exit;
        $this->load->view('List_Rekomendasi',$data);
    }



    public function detailab()
    { 
        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $this->printsuratlab();
        $this->printsuratTTElab();
        $jnis = 'LABKES';
        $attachment = 'assets/surtug/tte'.$id.'.pdf';
        $hasiltte = 'assets/surtug/'.$id.'.pdf';
        $data = array('contents' => 'surtug/review',
         // 'survei'  =>$this->M_surat_tugas->tgl_survei($kd),
         // 'jns'      => $jnis,
         // 'nar'  =>$this->M_surat_tugas->narahubung($kd),
         // 'data'    => $this->M_surat_tugas->printsuratlab($id),
         'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
         'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
     );
       //echo json_encode($data['data']);exit;
        $this->load->view('List_Rekomendasi',$data);
    }

        public function detaiutd()
    { 
        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $this->printsuratutd();
        $this->printsuratTTEutd();
        $jnis = 'LABKES';
        $attachment = 'assets/surtug/tte'.$id.'.pdf';
        $hasiltte = 'assets/surtug/'.$id.'.pdf';
        $data = array('contents' => 'surtug/review',
         // 'survei'  =>$this->M_surat_tugas->tgl_survei($kd),
         // 'jns'      => $jnis,
         // 'nar'  =>$this->M_surat_tugas->narahubung($kd),
         // 'data'    => $this->M_surat_tugas->printsuratlab($id),
         'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
         'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
     );
       //echo json_encode($data['data']);exit;
        $this->load->view('List_Rekomendasi',$data);
    }

        public function printsuratutd()
    {

        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'UTD';
        $data = array(
         'jns'      => $jnis,
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsuratutd($id),

     );
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = $id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = $id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surat',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }

    public function printsuratTTEutd()
    {

       $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'UTD';
        $data = array(
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsuratutd($id),
         'jns'      => $jnis,
     );
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = 'stte'.$id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = 'stte'.$id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surtugtte',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }


    public function printsuratlab()
    {

        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'LABKES';
        $data = array(
         'jns'      => $jnis,
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsuratlab($id),

     );
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = $id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = $id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surat',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }

    public function printsuratTTElab()
    {

       $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'LABKES';
        $data = array(
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsuratlab($id),
         'jns'      => $jnis,
     );
     
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = 'stte'.$id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = 'stte'.$id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surtugtte',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }

    public function printsuratklinik()
    {

        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'KLINIK';
        $data = array(
         'jns'      => $jnis,
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsuratklinik($id),

     );
          $content = $this->M_surat_tugas->printsuratklinik($id);
     foreach ($content as $key => $row) {
        $logoPath = FCPATH . $row->kop; // Sesuaikan dengan path logo
        $content[$key]->kop = $this->base64EncodeImage($logoPath);
    }
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = $id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = $id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surat',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }
    private function base64EncodeImage($path)
{
    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    } else {
        return ''; // atau gambar default
    }
}

    public function printsuratTTEklinik()
    {

       $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'KLINIK';
        $data = array(
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsuratklinik($id),
         'jns'      => $jnis,
     );
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = 'stte'.$id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = 'stte'.$id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surtugtte',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }


    public function printsurat()
    {

        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'PUSKESMAS';
        $data = array(
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsurat($id),
         'jns'      => $jnis,
     );
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = $id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = $id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surat',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }

    public function printsuratTTE()
    {

        $id = $this->uri->segment(3);
        $kd = $this->uri->segment(4);
        $jnis = 'PUSKESMAS';
        $data = array(
         'survei'  =>$this->M_surat_tugas->tgl_survei($id),
         'nar'  =>$this->M_surat_tugas->narahubung($kd),
         'data'    => $this->M_surat_tugas->printsurat($id),
         'jns'      => $jnis,
     );
       // $content = $this->M_surat_tugas->printsurat($id);
        $this->data['title_pdf'] = 'stte'.$id;
       // $data['data'] = $content;
        $this->load->library('pdfgenerator');
        $file_pdf = 'stte'.$id;
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('surtug/surtugtte',$data, true);     
        $this->pdfgenerator->surattugas($html, $file_pdf,$paper,$orientation);
    }

    public function ttesurtug()
    {
        $kd = $this->input->post('id');
        $jns = $this->input->post('jenis');
        $id = $this->input->post('id_rekomendasi');
        $tte_lpa_id = $this->input->post('lembaga');
        $url = base_url('Surat_tugas/detail/'.$id.'/'.$kd);
        $url1 = base_url('Surat_tugas/detailklinik/'.$id.'/'.$kd);
        $url2 = base_url('Surat_tugas/detailab/'.$id.'/'.$kd);
        $nik = $this->input->post('nik');
        $passphrase = $this->input->post('passphrase');
        $filename = "stte".$id.".pdf";
        $attachment = 'assets/surtug/' . $filename;
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
          CURLOPT_USERPWD=> 'esign-sinar'.':'.'kq&UnD31@l',
           ); // cURL options

        curl_setopt_array($ch, $options);
        
        $result =  curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // var_dump($result);

        if($httpcode != 200)
        {
            curl_close($ch);
            // die('terjadi kesalahan saat mengupload file.');
            echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Passprase Salah silahkan Coba lagi.....</div>');
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
        $uploadDir = FCPATH . 'assets/surtug/tte';
        $fp = fopen($uploadDir . $id.".pdf", 'w');
        fwrite($fp, $result);
        fclose($fp);
        $datasimpan =array(
            'lpa' => $tte_lpa_id,
            'id_fasyankes' => $kd,
            'id_pengajuan' => $id,
            'nama_file' => "tte".$id.".pdf",
        );
        $query = "SELECT id_fasyankes FROM surtug WHERE id_fasyankes = '".$id."'";
        $sql = $this->sina->query($query)->row_array();
        if ($sql == null) {
            $simpan = $this->sina->insert('surtug',$datasimpan);
        }
        echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            Berhasil melakukan Tandatangan Elektronik</div>');
        if ($jns == 'KLINIK') {
            redirect($url1);
        }elseif($jns == 'LABKES'){
            redirect($url2);
        }else{
             redirect($url);
        }
        
    }


}
