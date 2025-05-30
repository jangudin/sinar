<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AkreditasiNonRS extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('Tte_non_rs');
        $this->load->model('New_progres');
        $this->load->model('Dashboard_tte');
        $this->sina = $this->load->database('sina', TRUE);
        $this->load->library('encryption');
        $this->load->library('Pdfgenerator');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }
    public function index()
    {
        $lpa = $this->session->userdata('lembaga_id');
        $data = array('contents' => 'AkreditasiNonRS',
            'data'    => $this->Tte_non_rs->list_faskes_lembaga($lpa),
            // 'sudah'  => $this->Tte_non_rs->faskes_detail($id),
        );
     // echo json_encode($data['data']);exit;
      //  $this->load->view('pemeliharaan');
        $this->load->view('List_Rekomendasi',$data);
    }

     public function dashboard()
    {
        $lpa = $this->session->userdata('lembaga_id');
        $data = array('contents' => 'AkreditasiNonRS',
            'data'    => $this->Tte_non_rs->list_faskes_lembaga($lpa),
            // 'sudah'  => $this->Tte_non_rs->faskes_detail($id),
        );
     // echo json_encode($data['data']);exit;
      //  $this->load->view('pemeliharaan');
         $this->load->view('List_Rekomendasi',$data);
    }

    public function cekdirjen()
    {
        $lpa = $this->session->userdata('lembaga_id');
        $fun = $this->uri->segment(2);
        $cek = $this->uri->segment(3);
        $data = array('contents' => 'new_progres',
                       'data'    => $this->New_progres->lpacekdirjentte($cek,$lpa),
                       'cek'    => $cek
                    );
      //   var_dump($data['data']);
     $this->load->view('List_Rekomendasi',$data);
    }

    public function nonrssudahtte()
    {
        $id = $this->session->userdata('lembaga_id');
        $data = array('contents' => 'AkreditasiNonRSsudah',
                        // 'widget' => $this->Tte_non_rs->widget($id),
            'data'    => $this->Tte_non_rs->list_faskes_lembaga_sudah($id),
                       // 'sudah'  => $this->Tte_non_rs->faskes_detail($id),
                       // 'puskesmas' => $this->Tte_non_rs->list_belumttePuskesmas($id),
                       // 'puskesmassudah' => $this->Tte_non_rs->list_sudahttePuskesmas($id)
        );
     // echo json_encode($data['data']);exit;
        $this->load->view('List_Rekomendasi',$data);
    }


       public function monitoring()
   {

    $faskes = $this->uri->segment(3) ?? null;
    $lpaid = $this->session->userdata('lembaga_id');
    $data = array('contents' => 'dashboard/monitoringNonRS',
        'datam'    => $this->Dashboard_tte->Monitoringfaskes($faskes,$lpaid),
    );
  // echo json_encode($data['datam']);
    $this->load->view('List_Rekomendasi',$data);
}


    public function ttesertifikat()
    {
        $id = $this->uri->segment(3);
        $faskes = $this->uri->segment(4);
        $idp = $this->uri->segment(5);
        $attachment = 'assets/faskessertif/ttelembaga'.$idp.'.pdf';
        $hasiltte = 'assets/faskessertif/'.$idp.'.pdf';
        $this->filesertifikatlembaga($id,$idp);
        $this->filesertifikatdir($id,$idp);
        $data = array('contents' => 'fasyankes_detail',
           'data'    => $this->Tte_non_rs->detail_faskes($idp),
           'idp'    => $idp,
           'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
           'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
       );
        $this->load->view('List_Rekomendasi',$data);
    }


        public function ttesertifikatkemkes()
    {
        $id = $this->uri->segment(3);
        $faskes = $this->uri->segment(4);
        $idp = $this->uri->segment(5);
        $attachment = 'assets/faskessertif/ttelembaga'.$idp.'.pdf';
        $hasiltte = 'assets/faskessertif/'.$idp.'.pdf';
        // if ($this->session->userdata('lembaga_id') == "KEMENKES") {
        //      $this->filesertifikatlembaga($id,$idp);
        //     $this->filesertifikatdir($id,$idp);
        //     $this->filesertifikatlembagakmk($id,$idp);
        //     $this->filesertifikatdirkmk($id,$idp);
        // }else{
             $this->filesertifikatlembagakmk($id,$idp);
             $this->filesertifikatdirkmk($id,$idp);
        // }

           
        $data = array('contents' => 'fasyankes_detail',
           'data'    => $this->Tte_non_rs->detail_faskes($idp),
           'idp'    => $idp,
           'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
           'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
       );
        $this->load->view('List_Rekomendasi',$data);
      //   echo json_encode($data['data']);exit;
    }

    public function Generate_ulang()
    {
               $faskes = urldecode($this->uri->segment(3));
               $id = $this->uri->segment(4);
               $id_p = $this->uri->segment(5);
               $url = base_url('AkreditasiNonRS/ttesertifikat/'.$id.'/'.$faskes.'/'.$id_p);

               $content = $this->Tte_non_rs->bahansertifikat($faskes,$id,$id_p);
                $data['data'] = $content;

                // Fungsi base64 untuk gambar
                $data['background_base64'] = $this->base64EncodeImage(FCPATH . 'assets/faskesbg/backgroundsertifikat.jpeg');
                $data['capayan_paripurna'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/paripurna.png');
                $data['capayan_utama'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/utama.png');
                $data['capayan_madya'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/madya.png');
                $data['capayan_dasar'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/dasar.png');

                $data['ttd_lembaga'] = $this->base64EncodeImage(FCPATH . 'assets/ttd/kepala.png');
                $data['ttd_dirjen'] = $this->base64EncodeImage(FCPATH . 'assets/ttd/dirjen.png');

                $html = $this->load->view('Sertifikatfaskesnew/sertifikatkosong', $data, true);
                $this->pdfgenerator->generatefaskes($html, $id_p, 'A4', 'landscape');

              redirect($url);
     }

    public function review()
    {
        $id = $this->uri->segment(3);
        $faskes = $this->uri->segment(4);
        $idp = $this->uri->segment(5);
        $attachment = 'assets/faskessertif/ttelembaga'.$idp.'.pdf';
        $hasiltte = 'assets/faskessertif/'.$id.'.pdf';
        $datafaskes = $this->Tte_non_rs->detail_faskes($idp);
        $data = array('contents' => 'fasyankes_detail',
            'idp'    => $idp,
           'data'    => $datafaskes,
           'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
           'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
       );

        $this->load->view('List_Rekomendasi',$data);
       //  echo json_encode($data['data']);exit;
    }


public function filesertifikatdir($id,$idp)
{   
    $id = $this->uri->segment(3);
    $this->load->library('pdfgenerator');
    $this->load->model('Tte_non_rs');

    $content = $this->Tte_non_rs->detail_faskes($idp);

    if (!$content) {
        show_error('Data tidak ditemukan atau kosong.');
    }

    foreach ($content as $key => $row) {
        // Encode logo lembaga ke base64
        $logoPath = FCPATH . $row->logo;
        $content[$key]->logo = $this->base64EncodeImage($logoPath);

        // === Tentukan TTD Dirjen ===
        $use_dirjendua = false;

        if ($row->jenis_faskes === 'Pusat Kesehatan Masyarakat'){
            $data['dir'] = $this->base64EncodeImage(FCPATH . 'assets/ttdfaskes/dirjendua.png');
        }elseif($row->jenis_faskes === 'Klinik' && $row->kategoriFaskes === 'Pratama'){
             $data['dir'] = $this->base64EncodeImage(FCPATH . 'assets/ttdfaskes/dirjendua.png');
        }elseif($row->jenis_faskes === 'Klinik' && $row->kategoriFaskes === 'Utama'){
            $data['dir'] = $this->base64EncodeImage(FCPATH . 'assets/ttdfaskes/dirjen.png');
        }elseif($row->jenis_faskes === 'Unit Transfusi Darah'){
            $data['dir'] = $this->base64EncodeImage(FCPATH . 'assets/ttdfaskes/dirjen.png');
        }elseif($row->jenis_faskes === 'Laboratorium' && substr($row->kategoriFaskes, 0, 18) ==='Laboratorium Medis'){
            $data['dir'] = $this->base64EncodeImage(FCPATH . 'assets/ttdfaskes/dirjen.png');
        }elseif($row->jenis_faskes === 'Laboratorium' && substr($row->kategoriFaskes, 0, 18) !=='Laboratorium Medis'){
            $data['dir'] = $this->base64EncodeImage(FCPATH . 'assets/ttdfaskes/dirjendua.png');
        }
    }

    // Kirim data utama
    $data['data'] = $content;

    // Background dan capayan base64 (cukup sekali karena tidak tergantung baris)
    $data['background_base64'] = $this->base64EncodeImage(FCPATH . 'assets/faskesbg/backgroundsertifikat.jpeg');
    $data['capayan_paripurna'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/paripurna.png');
    $data['capayan_utama'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/utama.png');
    $data['capayan_madya'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/madya.png');
    $data['capayan_dasar'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/dasar.png');

    // Set nama file dan layout PDF
    $file_pdf = "dir" . $idp;
    $paper = 'A4';
    $orientation = "landscape";

    // Render view dan generate PDF
    $html = $this->load->view('Sertifikatfaskesnew/sertifikatdir', $data, true);
    $this->pdfgenerator->generatefaskes($html, $file_pdf, $paper, $orientation);

   // $this->load->view('Sertifikatfaskesnew/sertifikatdir', $data, true);
}


public function filesertifikatlembaga($id,$idp)
{
    $id = $this->uri->segment(3);
    // atau gunakan parameter $id jika dari route langsung

    // Load library PDF
    $this->load->library('pdfgenerator');

    // Load model
    $this->load->model('Tte_non_rs');

    // Ambil data dari model
    $content = $this->Tte_non_rs->detail_faskes($idp);

    // Jika data kosong
    if (!$content) {
        show_error('Data tidak ditemukan atau kosong.');
    }

    // Proses base64 image (logo dan gambar lainnya)
    foreach ($content as $key => $row) {
        $logoPath = FCPATH . $row->logo; // Sesuaikan dengan path logo
        $content[$key]->logo = $this->base64EncodeImage($logoPath);
    }

    // Kirim ke view
    $data['data'] = $content;

    // Background dan capayan base64
    $data['background_base64'] = $this->base64EncodeImage(FCPATH . 'assets/faskesbg/backgroundsertifikat.jpeg');
    $data['capayan_paripurna'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/paripurna.png');
    $data['capayan_utama'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/utama.png');
    $data['capayan_madya'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/madya.png');
    $data['capayan_dasar'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/dasar.png');
    $data['ttd_dirjen'] = $this->base64EncodeImage(FCPATH . 'assets/ttd/dirjen.png');

    // Judul file PDF
    $file_pdf = "lembaga" .$idp;

    // Ukuran dan orientasi
    $paper = 'A4';
    $orientation = "landscape";

    // Render view ke HTML
    $html = $this->load->view('Sertifikatfaskesnew/sertifikatlembaga', $data, true);

    // Generate PDF
    $this->pdfgenerator->generatefaskes($html, $file_pdf, $paper, $orientation);
}

public function filesertifikatkosong($id,$idp)
{
    $id = $this->uri->segment(3);
    // atau gunakan parameter $id jika dari route langsung

    // Load library PDF
    $this->load->library('pdfgenerator');

    // Load model
    $this->load->model('Tte_non_rs');

    // Ambil data dari model
    $content = $this->Tte_non_rs->detail_faskes($idp);

    // Jika data kosong
    if (!$content) {
        show_error('Data tidak ditemukan atau kosong.');
    }

    // Proses base64 image (logo dan gambar lainnya)
    foreach ($content as $key => $row) {
        $logoPath = FCPATH . $row->logo; // Sesuaikan dengan path logo
        $content[$key]->logo = $this->base64EncodeImage($logoPath);
    }

    // Kirim ke view
    $data['data'] = $content;

    // Background dan capayan base64
    $data['background_base64'] = $this->base64EncodeImage(FCPATH . 'assets/faskesbg/backgroundsertifikat.jpeg');
    $data['capayan_paripurna'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/paripurna.png');
    $data['capayan_utama'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/utama.png');
    $data['capayan_madya'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/madya.png');
    $data['capayan_dasar'] = $this->base64EncodeImage(FCPATH . 'assets/faskessertif/capayan/dasar.png');
    $data['ttd_dirjen'] = $this->base64EncodeImage(FCPATH . 'assets/ttd/dirjen.png');

    // Judul file PDF
    $file_pdf = "lembaga" .$idp;

    // Ukuran dan orientasi
    $paper = 'A4';
    $orientation = "landscape";

    // Render view ke HTML
    $html = $this->load->view('Sertifikatfaskesnew/sertifikatlembagaulang', $data, true);

    // Generate PDF
    $this->pdfgenerator->generatefaskes($html, $file_pdf, $paper, $orientation);
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




        public function filesertifikatlembagakmk($id,$idp)
    {

        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Sertifikat';
        $content = $this->Tte_non_rs->detail_faskes($idp);
        $data['data'] = $content;
        $file_pdf = "ttelembaga".$idp;
        $paper = 'A4';
        $orientation = "landscape";
       // echo json_encode($data['data']);
        $html =  $this->load->view('Sertifikatfaskesnew/sertifikatlembaga',$data,true);


        $this->pdfgenerator->generatefaskes($html, $file_pdf,$paper,$orientation);

         //  $this->load->view('tespage');

        
    }
    public function filesertifikatdirkmk($id,$idp)
    {

        $id = $this->uri->segment(3);
        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Sertifikat';
        $content = $this->Tte_non_rs->detail_faskes($idp);
        $data['data'] = $content;
        $file_pdf = "showttedir".$idp;
        $paper = 'A4';
        $orientation = "landscape";
              // echo json_encode($data['data']);
        $html =  $this->load->view('Sertifikatfaskesnew/sertifikatdir',$data,true);


        $this->pdfgenerator->generatefaskes($html, $file_pdf,$paper,$orientation);

         //  $this->load->view('tespage');

        
    }

   public function filesertifikatdirtes()
    {

        $id = '1237375';
        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Sertifikat';
        $content = $this->Tte_non_rs->detail_faskes($idp);
        $data['data'] = $content;
        $file_pdf = "dir".$id;
        $paper = 'A4';
        $orientation = "landscape";
              // echo json_encode($data['data']);
        $html =  $this->load->view('Sertifikatfaskesnew/sertifikatdir',$data,true);


        $this->pdfgenerator->generatefaskesdir($html, $file_pdf,$paper,$orientation);

         //  $this->load->view('tespage');

        
    }



    public function prosesttelembaga()
    {
        $kd = $this->input->post('id');
        $idp = $this->input->post('idp');
        $lpa = $this->input->post('lembaga');
        $nik = $this->input->post('nik');
        $sertifikat_nomor_id = $this->input->post('sertifikat_nomor_id');
        $passphrase = $this->input->post('passphrase');
        $jenis = $this->input->post('jenis');
        $url = base_url('AkreditasiNonRS/ttesertifikat/' . $kd.'/'.$jenis.'/'.$idp);
        // $url = base_url('AkreditasiNonRS/AkreditasiNonRS');
        $content = $this->Tte_non_rs->Sertifikat_detail($idp);
        $data['faskes'] = $content;
        $filename = "dir".$idp.".pdf";
        $attachment = 'assets/faskessertif/' . $filename;
        $data = array(
            'nik' => $nik,
            'passphrase' => $passphrase,
            // 'passphrase' => '!Bsre1221*',
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
          CURLOPT_USERPWD=> 'esign-sinar2'.':'.'s1n4r3344x',
           ); // cURL options

        curl_setopt_array($ch, $options);
        
        $result =  curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // var_dump($httpcode);

        if($httpcode != 200)
        {
             $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            // die('terjadi kesalahan saat mengupload file.');
            echo $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               '.$result.' </div>');
            redirect($url);
        }else{

            //------------------------------- TTE LPA


    







            //----------------------------------------


            $this->ttedironlembaga($nik,$passphrase,$idp);
             $tglberakhir = format_indo(date('Y-m-d', strtotime('+5 year', strtotime( date('Y-m-d') ))));
            $ttetgl = format_indo(date('Y-m-d'));
            $lembagasimpan =array(
                'id_pengajuan' => $idp,
                'kode_faskes' => $kd,
                'data_sertifikat_id' => $sertifikat_nomor_id,
                'jenis_faskes' => $jenis,
                'lpa' => $lpa,
                'tgl_berakhir' => $tglberakhir,
                'tgl_tte' => $ttetgl,
                'status_tte' => '1',
                'file_name' => "ttelembaga".$idp.".pdf",
                'file_tte_dir' => "showttedir".$idp.".pdf",
            );
            $query = "SELECT kode_faskes FROM tte_lpa WHERE id_pengajuan = '".$idp."'";
            $sql = $this->sina->query($query)->row_array();
            //$simpan = $this->sina->insert('tte_lpa',$lembagasimpan);
            if ($sql == null) {
                $simpan = $this->sina->insert('tte_lpa',$lembagasimpan);
            }
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
        $uploadDir = FCPATH . 'assets/faskessertif/showtte';
        $fp = fopen($uploadDir . $filename, 'w');
        fwrite($fp, $result);
        fclose($fp);

       echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
      redirect($url);
   }


   public function prosesvalidasilembaga()
    {
        $kd = $this->input->post('id');
        $idp = $this->input->post('idp');
        $lpa = $this->input->post('lembaga');
        $sertifikat_nomor_id = $this->input->post('sertifikat_nomor_id');
        $jenis = $this->input->post('jenis');
        $tglberakhir = format_indo(date('Y-m-d', strtotime('+5 year', strtotime( date('Y-m-d') ))));
        $ttetgl = format_indo(date('Y-m-d'));
        $lembagasimpan =array(
                'id_pengajuan' => $idp,
                'kode_faskes' => $kd,
                'data_sertifikat_id' => $sertifikat_nomor_id,
                'jenis_faskes' => $jenis,
                'lpa' => $lpa,
                'tgl_berakhir' => $tglberakhir,
                'tgl_tte' => $ttetgl,
                'status_tte' => '1',
                'file_name' => "ttelembaga".$idp.".pdf",
                'file_tte_dir' => "showttedir".$idp.".pdf",
            );
            $query = "SELECT kode_faskes FROM tte_lpa WHERE id_pengajuan = '".$idp."'";
            $sql = $this->sina->query($query)->row_array();
            //$simpan = $this->sina->insert('tte_lpa',$lembagasimpan);
            if ($sql == null) {
                $simpan = $this->sina->insert('tte_lpa',$lembagasimpan);

                       echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        File berhasil dibuat  </div>');
      redirect('AkreditasiNonRS');
            }
   }

   public function ttedironlembaga($nik,$passphrase,$idp)
   {

    $filenamebl = "lembaga".$idp.".pdf";
    $attachment = 'assets/faskessertif/' . $filenamebl;
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
        $filenamebl
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
      CURLOPT_USERPWD=> 'esign-sinar2'.':'.'s1n4r3344x',
           ); // cURL options

    curl_setopt_array($ch, $options);

    $result =  curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $uploadDir = FCPATH . 'assets/faskessertif/tte';
    $fp = fopen($uploadDir . $filenamebl, 'w');
    fwrite($fp, $result);
    fclose($fp);
    }

// public function surat_tugas()
// {

// }


}
