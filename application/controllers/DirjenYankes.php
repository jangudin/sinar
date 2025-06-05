<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DirjenYankes extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Dashboard_tte');
        $this->load->model('Tte_non_rs');
        $this->sina = $this->load->database('sina', TRUE);
        $this->dbfaskes = $this->load->database('dbfaskes', TRUE);
        $this->load->helper('tanggal_indonesia');
       if ($this->session->userdata('status') != "login" || 
    !in_array($this->session->userdata('jabatan_id'), ['1', '10', '2','7'])) {
    // Akses ditolak
    redirect('auth'); // atau tampilkan view error
}
}
    public function index()
    {
        if($this->session->userdata('id') == '10'){
            $dir = 0;
        $mutu = 1;
        $data = array('contents' => 'List_dirjen',
           'data'    => $this->Dashboard_tte->list_dirjen($dir,$mutu),
           'belumtte' => $this->Dashboard_tte->jumlah_belum_tte($dir,$mutu),
         'sudahtte' => $this->Dashboard_tte->jumlah_sudah_tte($dir,$mutu),

       );
      //   var_dump($data);
        $this->load->view('List_Rekomendasi',$data);
        }else{
            echo "anda tidak berhak mengakses halaman ini";
            redirec('Auth');
        }
    }



    public function Dashboard()
    {
       $klinik = "Klinik";
       $pus ="Pusat Kesehatan Masyarakat";
       $lab ="Laboratorium Kesehatan";
       $utd ="Unit Transfusi Darah";
       $data = array('contents' => 'dashboard/index',
         'faskesk'   => $this->Dashboard_tte->chart_faskes_klinik(),
         'faskesRs'   => $this->Dashboard_tte->chart_faskes_rs(),
         'faskesp'   => $this->Dashboard_tte->chart_faskes_puskes(),
         'faskesl'   => $this->Dashboard_tte->chart_faskes_lab(),
         'faskesu'   => $this->Dashboard_tte->chart_faskes_utd(),
         'faskes'   => $this->Dashboard_tte->chart_faskes(),
         'statusk'   => $this->Dashboard_tte->chart_status($klinik),
         'statusp'   => $this->Dashboard_tte->chart_status($pus),
         'statusl'   => $this->Dashboard_tte->chart_status($lab),
         'statusu'   => $this->Dashboard_tte->chart_status($utd),
         'statusRS'   => $this->Dashboard_tte->chart_status_RS(),
     );
     //   echo json_encode($data['faskes']['provinsi']);
       $this->load->view('List_Rekomendasi',$data);
   }



public function monitoring($faskes = null, $jenis = null)
{
    $faskes = $faskes !== null ? urldecode($faskes) : null;
    $jenis = $jenis !== null ? urldecode($jenis) : null;

    $data = array(
        'contents' => 'dashboard/monitoringDirjen',
        'datam'    => [],
        'faskes'   => $faskes,
        'jenis'    => $jenis
    );

    if ($faskes !== null || $jenis !== null) {
        $data['datam'] = $this->Dashboard_tte->MonitoringDirjen($faskes, $jenis);
    }

    $this->load->view('List_Rekomendasi', $data);
}

public function tpmd()
{

    $data = array('contents' => 'tpmd',
        'data'    => $this->Tte_non_rs->list_faskes_tpmd(),
    );
     // echo json_encode($data['data']);
    $this->load->view('List_Rekomendasi',$data);
}

public function tpmdTTE()
{

    $data = array('contents' => 'tpmd_dirjen',
        'data'    => $this->Tte_non_rs->tpmd_dirjen_tte(),
    );
     // echo json_encode($data['data']);
    $this->load->view('List_Rekomendasi',$data);
}

public function detailtpmd()
{
    $id = $this->uri->segment(3);
    $this->filesertifikattpmd($id);
    $attachment = 'assets/TPMD/'.$id.'.pdf';
    $hasiltte = 'assets/TPMD/FINALdir'.$id.'.pdf';
    $data = array('contents' => 'detailtpmd',
        'detail'    => $this->Tte_non_rs->tpmd_dirjen_detail($id),
        'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
        'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
    );

  //  echo json_encode($this->session->userdata('nik'));
    $this->load->view('List_Rekomendasi',$data);
}


public function filesertifikattpmd($id)
{
   // $kd = $this->uri->segment(3);
    $this->load->library('pdfgenerator');
    $this->data['title_pdf'] = 'Sertifikat';
    $content = $this->Tte_non_rs->tpmd_dirjen_detail($id);
    $data['data'] = $content;
    $file_pdf = "dir".$id;
    $paper = 'A4';
    $orientation = "landscape";
    // echo json_encode($this->session->userdata('nik'));
    $html =  $this->load->view('tpmd/sertifikatdirjen',$data,true);
    $this->pdfgenerator->generatetpmd($html, $file_pdf,$paper,$orientation);


}


public function monitoring_rs()
{

    $faskes = $this->uri->segment(3) ?? null;
    $data = array('contents' => 'dashboard/Dashbor_rs',
        'data'    => $this->Dashboard_tte->Dash_rs(),
    );
 // echo json_encode($data['datam']);
    $this->load->view('List_Rekomendasi',$data);
}

public function monitoring_tpmd()
{

    $faskes = $this->uri->segment(3) ?? null;
    $data = array('contents' => 'dashboard/monitoring_tpmd',
        'data'    => $this->Dashboard_tte->Dash_tpmd(),
    );
   // echo json_encode($data['data']);
    $this->load->view('List_Rekomendasi',$data);
}



public function sudahtte()
{
    $dir = 1;
    $mutu = 1;
    $data = array('contents' => 'List_dirjen',
       'data'    => $this->Dashboard_tte->sudahttedirjen($dir,$mutu),
        'belumtte' => $this->Dashboard_tte->jumlah_belum_tte(),
        'sudahtte' => $this->Dashboard_tte->jumlah_sudah_tte(),

   );
      //   var_dump($data);
    $this->load->view('List_Rekomendasi',$data);
}
public function nonrsbelumtte()
{
    $jenis_faskes_segment = $this->uri->segment(3);
    $jenis_faskes = isset($jenis_faskes_segment) && is_string($jenis_faskes_segment) ? urldecode($jenis_faskes_segment) : '';
    $jenis_segment = $this->uri->segment(4);
    $jenis = isset($jenis_segment) && is_string($jenis_segment) ? urldecode($jenis_segment) : '';
    $data = array('contents' => 'vnonrs',

        'prapus' => $this->Tte_non_rs->list_faskes_dirjen_belum($jenis_faskes,$jenis),
        'skmk' => $this->Tte_non_rs->list_faskes_dirjen_belum_skmk(),
         'belumtte' => $this->Tte_non_rs->jumlah_belum_tte(),
         'belumtte_dua' => $this->Tte_non_rs->jumlah_belum_tte_dua(),
         'sudahtte' => $this->Tte_non_rs->jumlah_sudah_tte(),
    );
   //   echo json_encode($jenis_faskes);
    $this->load->view('List_Rekomendasi',$data);
}

public function TPMDbelumtte()
{
    $data = array('contents' => 'tpmd_dirjen',
        'data'    => $this->Tte_non_rs->tpmd_dirjen(),
    );
    $this->load->view('List_Rekomendasi',$data);
}

public function nonrsdetailskmk()
{
    $faskes = urldecode($this->uri->segment(3));
    $id_p = $this->uri->segment(5);
    $id = $this->uri->segment(4);
    $this->filesertifikatkmk($faskes,$id,$id_p);
    $this->filesertifikatkmkkosong($faskes,$id,$id_p);
    $attachment = 'assets/faskessertif/finaltteshowttedir'.$id_p.'.pdf';
    $hasiltte = 'assets/faskessertif/'.$id_p.'.pdf';
    $data = array('contents' => 'vdetailnonrskmk',
     'detail'   =>$this->Tte_non_rs->bahansertifikat($faskes,$id,$id_p),
     'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
     'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
 );

    // echo json_encode($data['detail']);
    $this->load->view('List_Rekomendasi',$data);
}


public function nonrssudahtte()
{
    $faskes = 'Pusat Kesehatan Masyarakat';
    $status = 1;
    $data = array('contents' => 'vnonrssudah',
        'sudpus' => $this->Tte_non_rs->list_faskes_dirjen_sudah(),
        'belumtte' => $this->Tte_non_rs->jumlah_belum_tte(),
        'sudahtte' => $this->Tte_non_rs->jumlah_sudah_tte(),
    );
       // var_dump($data['sudpus']);
    $this->load->view('List_Rekomendasi',$data);
}


public function nonrsdetail()
{
    $id = $this->uri->segment(3);

    // Ambil data dari database
    $cek = $this->Tte_non_rs->list_faskes_dirjen_detail($id);
    

    // Cek jika $cek ada dan tidak kosong
    if (!empty($cek) && isset($cek[0])) {
        // Hanya mengakses elemen pertama jika ada
        $lembaga = $cek[0]->file_name;  
        $dirjenyankes = $cek[0]->url_sertifikat;  
        
        // Tentukan path file
        $attachment = 'assets/faskessertif/' . $dirjenyankes;
        $hasiltte = 'assets/faskessertif/' . $lembaga;
    } else {
        // Jika data tidak ada, beri nilai default
        $attachment = null;
        $hasiltte = null;
    }

    echo json_encode($attachment);exit;

    // Siapkan data untuk view
    $data = array(
        'contents'   => 'vdetailnonrs',
        'data'       => $this->Tte_non_rs->list_faskes_dirjen_detail($id),  // Bisa dibuang jika data sudah dimasukkan sebelumnya
        'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
        'hasiltte'   => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
    );

    // Tampilkan view
    $this->load->view('List_Rekomendasi', $data);
}



public function filesertifikatkmk($faskes,$id,$id_p)
{

    $this->load->library('pdfgenerator');
    $this->data['title_pdf'] = 'Sertifikat';
    $content = $this->Tte_non_rs->bahansertifikat($faskes,$id,$id_p);
    $data['data'] = $content;
    $file_pdf = "showttedir".$id_p;
    $paper = 'A4';
    $orientation = "landscape";

//    echo json_encode($data);
    $html =  $this->load->view('Sertifikatfaskesnew/sertifikatdirskmk',$data,true);
    $this->pdfgenerator->generatefaskes($html, $file_pdf,$paper,$orientation);

}

public function filesertifikatkmkkosong($faskes,$id,$id_p)
{

    $this->load->library('pdfgenerator');
    $this->data['title_pdf'] = 'Sertifikat';
    $content = $this->Tte_non_rs->bahansertifikat($faskes,$id,$id_p);
    $data['data'] = $content;
    $file_pdf = $id_p;
    $paper = 'A4';
    $orientation = "landscape";

//    echo json_encode($data);
    $html =  $this->load->view('Sertifikatfaskesnew/sertifikatkosong',$data,true);
    $this->pdfgenerator->generatefaskes($html, $file_pdf,$paper,$orientation);

}


public function Detail()
{
    if($this->session->userdata('id') == '10'){
        $dir = 1;
        $id = $this->uri->segment(3);
        $nonik = $this->session->userdata('nik'); 
        
        $data['idrek'] = $this->Dashboard_tte->detail_mutu($id);
        
        // Menetapkan nilai default untuk $dirjen dan $attachment
        $dirjen = null;
        $attachment = null;

        foreach($data['idrek'] as $file) {
            if ($file->lembagaAkreditasiId == 'kars') {
                $dirjen = 'assets/generate/kars/showfiletteKars_dirjen'.$id.'.pdf';
                $attachment = 'assets/generate/kars/tteKars_lembaga'.$id.'.pdf';
            }
            elseif($file->lembagaAkreditasiId == 'lam'){
                $dirjen = 'assets/generate/lam/showfiletteLamdirjen'.$id.'.pdf';
                $attachment = 'assets/generate/lam/tteLamlembaga'.$id.'.pdf';
            }
            elseif($file->lembagaAkreditasiId == 'lafki'){
                $dirjen = 'assets/generate/lafki/showfilettelafkidirjen'.$id.'.pdf';
                $attachment = 'assets/generate/lafki/ttelafkilembaga'.$id.'.pdf';
            }
            elseif($file->lembagaAkreditasiId == 'larsi'){
                $dirjen = 'assets/generate/larsi/showfiletteLarsidirjen'.$id.'.pdf';
                $attachment = 'assets/generate/larsi/tteLarsilembaga'.$id.'.pdf';
            }
            elseif($file->lembagaAkreditasiId == 'larsdhp'){
                $dirjen = 'assets/generate/larsdhp/showfiletteLarsdhpdirjen'.$id.'.pdf';
                $attachment = 'assets/generate/larsdhp/tteLarsdhplembaga'.$id.'.pdf';
            }
            elseif($file->lembagaAkreditasiId == 'lars'){
                $dirjen = 'assets/generate/lars/showfiletteLarsdirjen'.$id.'.pdf';
                $attachment = 'assets/generate/lars/tteLarslembaga'.$id.'.pdf';
            }
        }

        // Pastikan $dirjen dan $attachment ada
        $data = array(
            'contents' => 'Detail_dirjen',
            'data'     => $this->Dashboard_tte->detail_dirjenu($id),
            'dirjen'   => is_file(FCPATH . $dirjen) ? base_url($dirjen) : null,
            'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
            'id' => $id,
            'nik' => $nonik
        );
        
        // Load view
        $this->load->view('List_Rekomendasi', $data);
    } else {
        echo "anda tidak berhak mengakses halaman ini";
        redirect('Auth');
    }
}

public function Dirjentte()
{
    $kd = $this->input->post('id');
    $lembaga = $this->input->post('lembaga');
    $nik = $this->input->post('nik');
    $passphrase = $this->input->post('passphrase');
    $url = base_url('DirjenYankes/Detail/' . $kd);

    $data = array(
        'nik' => $nik,
        'passphrase' => $passphrase,
            // 'passphrase' => '!Bsre1221*',
        'tampilan' => 'invisible',
        'image' => 'true',
        'halaman' => 'pertama',
        'text' => ''
    ); 

    if ($lembaga == 'kars') {
        $filename = "tteKars_dirjen".$kd.".pdf";
        $attachment = 'assets/generate/kars/' . $filename;
    }elseif ($lembaga == 'lafki' ) {
        $filename = "ttelafkidirjen".$kd.".pdf";
        $attachment = 'assets/generate/lafki/' . $filename;
    }elseif ($lembaga == 'larsdhp' ) {
        $filename = "tteLarsdhpdirjen".$kd.".pdf";
        $attachment = 'assets/generate/larsdhp/' . $filename;
    }elseif ($lembaga == 'larsi' ) {
        $filename = "tteLarsidirjen".$kd.".pdf";
        $attachment = 'assets/generate/larsi/' . $filename;
    }elseif ($lembaga == 'lam' ) {
        $filename = "tteLamdirjen".$kd.".pdf";
        $attachment = 'assets/generate/lam/' . $filename;
    }elseif ($lembaga == 'lars' ) {
        $filename = "tteLarsdirjen".$kd.".pdf";
        $attachment = 'assets/generate/lars/' . $filename;
    }

    $data['file'] = curl_file_create(
        FCPATH . $attachment,
        'application/pdf',
        $filename
    );
        // print_r($data)

        // var_dump($data);
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

    if ($lembaga == 'kars') {
        $uploadDir = FCPATH . 'assets/generate/kars/showfile';
    }elseif ($lembaga == 'lafki' ) {
        $uploadDir = FCPATH . 'assets/generate/lafki/showfile';
    }elseif ($lembaga == 'larsdhp' ) {
        $uploadDir = FCPATH . 'assets/generate/larsdhp/showfile';
    }elseif ($lembaga == 'larsi' ) {
        $uploadDir = FCPATH . 'assets/generate/larsi/showfile';
    }elseif ($lembaga == 'lam' ) {
        $uploadDir = FCPATH . 'assets/generate/lam/showfile';
    }elseif ($lembaga == 'lars' ) {
        $uploadDir = FCPATH . 'assets/generate/lars/showfile';
    }

    $fp = fopen($uploadDir . $filename, 'w');
    fwrite($fp, $result);
    fclose($fp);

    $id = $kd;
    $dirjen = 1;
    $timedirjen = date('Y-m-d H:i:s');
    $this->Dashboard_tte->ttedirjen($dirjen,$id,$timedirjen);

    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
    redirect($url);
        // 

        // file_put_contents($result);

        // header('Content-type: ' . 'application/octet-stream');
        // header('Content-Disposition: ' . "attachment; filename=$filename");
        // echo $result;
}

public function ttedirjenonrs()
{
    $kd = $this->input->post('id');
    $idp = $this->input->post('idp');
    $jenis = $this->input->post('jenis');
    $tte_lpa_id = $this->input->post('tte_lpa_id');
    $url = base_url('DirjenYankes/nonrsdetail/' .$idp.'/'.$jenis);
    $nik = $this->input->post('nik');
    $passphrase = $this->input->post('passphrase');
    $content = $this->Tte_non_rs->Sertifikat_detail($kd);
    $data['faskes'] = $content;
    $cek = $this->Tte_non_rs->list_faskes_dirjen_detail($idp);
    $filename = $cek[0]->file_tte_dir;
    $attachment = 'assets/faskessertif/' . $filename;
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
      CURLOPT_USERPWD=> 'esign-sinar2'.':'.'s1n4r3344x',
           ); // cURL options

    curl_setopt_array($ch, $options);
   //  echo json_encode($options);exit;

    $result =  curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
           var_dump($httpcode);
    // echo json_encode($result);exit;
    

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
    $uploadDir = FCPATH . 'assets/faskessertif/finaltte';
    $fp = fopen($uploadDir . $filename, 'w');
    fwrite($fp, $result);
    fclose($fp);
    $ttetgl = format_indo(date('Y-m-d'));
    $datasimpan =array(
        'tte_lpa_id' => $tte_lpa_id,
        'id_faskes' => $kd,
        'tgl_tte' => $ttetgl,
        'url_sertifikat' => "finaltte".$filename,
        'status_tte' => 1
    );
    $query = "SELECT id_faskes FROM tte_dirjen WHERE id_faskes = '".$kd."'";
    $sql = $this->sina->query($query)->row_array();
    $simpan = $this->sina->insert('tte_dirjen',$datasimpan);
    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
    redirect($url);
}


public function ttedirjenTPMD()
{
    $kd = $this->input->post('id');
    $idp = $this->input->post('idp');
    $jenis = $this->input->post('jenis');
    $data_sertifikat_tpmd_id = $this->input->post('data_sertifikat_tpmd_id');
    $url = base_url('DirjenYankes/detailtpmd/' .$idp);
    $nik = $this->input->post('nik');
    $passphrase = $this->input->post('passphrase');
     $cek = $this->Tte_non_rs->tpmd_dirjen_detail($idp);
    $filename = $cek[0]->file_tte_dir;
    $attachment = 'assets/TPMD/'.$filename;
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
      CURLOPT_USERPWD=> 'esign-sinar2'.':'.'s1n4r3344x',
           ); // cURL options

    curl_setopt_array($ch, $options);

    $result =  curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


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
    $uploadDir = FCPATH . 'assets/TPMD/FINAL';
    $fp = fopen($uploadDir . $filename, 'w');
    fwrite($fp, $result);
    fclose($fp);
    $ttetgl = format_indo(date('Y-m-d'));
    $datasimpan =array(
        'data_sertifikat_tpmd_id' => $data_sertifikat_tpmd_id,
        'id_faskes' => $kd,
        'tgl_tte' => $ttetgl,
        'url_sertifikat' => "FINAL".$filename,
        'status_tte' => 1
    );
    $simpan = $this->sina->insert('TPMD_tte_dirjen',$datasimpan);
    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
    redirect($url);
}




}
