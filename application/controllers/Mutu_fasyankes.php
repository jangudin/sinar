<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutu_fasyankes extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model('Dashboard_tte');
      $this->load->model('Tte_non_rs');
      $this->load->model('New_progres');
      $this->load->model('Api_model');
      $this->sina = $this->load->database('sina', TRUE);
      $this->dbfaskes = $this->load->database('dbfaskes', TRUE);
      $this->load->helper('tanggal_indonesia');
      $this->load->library('encryption');
      if($this->session->userdata('status') != "login" || $this->session->userdata('jabatan_id') != '2'){
         redirect(base_url());
     }
 }
 public function index()
 {
    $id = 0;
    $data = array('contents' => 'list_mutu',
     'data'    => $this->Dashboard_tte->list_mutu($id)
 );
         //echo json_encode($data['data']);
    $this->load->view('List_Rekomendasi',$data);
}

public function monitoring()
{

    $faskes = $this->uri->segment(3) ?? null;
    $data = array('contents' => 'dashboard/monitoring',
        'datam'    => $this->Dashboard_tte->Monitoring($faskes),
    );
   // echo json_encode($data);
    $this->load->view('List_Rekomendasi',$data);
}

public function tpmdbelumverifikasi() 
{
    // 1. Call API and handle response
    $api_result = $this->Api_model->check_verification_status();
    if (empty($api_result)) {
        $this->session->set_flashdata('error', 'Tidak ada data dari API');
        redirect('mutu_fasyankes');
    }

    // 2. Process API data and sync to database
    try {
        $this->_sync_verification_data($api_result);
    } catch (Exception $e) {
        log_message('error', 'Error syncing verification data: ' . $e->getMessage());
    }

    // 3. Get data for view using standardized query
    $query = "SELECT 
                va.id,
                va.id_pengajuan,
                va.kode_faskes,
                va.id_faskes,
                dp.nama_pm 
             FROM db_akreditasi_non_rs.verifikasi_api va
             LEFT JOIN db_akreditasi_non_rs.data_sertifikat_tpmd dst 
                ON va.kode_faskes = dst.kode_faskes
             LEFT JOIN dbfaskes.data_pm dp 
                ON va.id_faskes = dp.id_faskes 
             WHERE dst.id IS NULL";

    $result = $this->sina->query($query)->result();

    // 4. Prepare view data
    $data = [
        'contents'  => 'tpmdbelumverifikasi',
        'databelum' => $result,
        'title'     => 'Daftar TPMD Belum Verifikasi'
    ];

    // 5. Load view
    $this->load->view('List_Rekomendasi', $data);
}

/**
 * Helper function to sync verification data
 * @param array $api_data Data from API
 * @return void
 */
private function _sync_verification_data($api_data) 
{
    foreach ($api_data as $row) {
        $data = [
            'id_pengajuan'         => $row['id'],         // Tambahkan id dari API
            'id_faskes'            => $row['id_faskes'],
            'kode_faskes'          => $row['kode_faskes'],
            'tanggal_usulan'       => $row['tanggal_usulan'],
            'status_verifikasi'    => $row['status_verifikasi'],
            'status_sertifikat'    => $row['status_sertifikat'],
            'status_setuju_katim'  => $row['status_setuju_katim'],
            'keterangan_katim'     => $row['keterangan_katim'],
            'tanggal_setuju_katim' => $row['tanggal_setuju_katim'],
            'last_sync'            => date('Y-m-d H:i:s')
        ];

        // Cek data existing berdasarkan id_pengajuan
        $exists = $this->sina->get_where('verifikasi_api', 
            ['id_pengajuan' => $row['id']])->row();

        if ($exists) {
            // Update jika sudah ada
            $this->sina->where('id_pengajuan', $row['id']);
            $this->sina->update('verifikasi_api', $data);
        } else {
            // Insert jika belum ada
            $this->sina->insert('verifikasi_api', $data);
        }
    }
}

public function tpmd()
{
        $timestamp = time(); // Generate current timestamp automatically

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mutufasyankes.kemkes.go.id/api/status_verif_katim',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-id: mutukemenkes',
                'x-pass: rsonline!@#$',
                'x-timestamp: ' . $timestamp,
                'cookie: TS01151b7a=0172bf5c62dd2ceae2dd097a56722b10bb38b719d6b709567a435f0acbfd7609311be64adf63726518bbb53037b16ed3f2fe02ddf983b945f66ac1a7309e127d73534784bd; ci_session=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%222851dca30c974d506d165ee0889fbea9%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A14%3A%22172.68.153.143%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A21%3A%22PostmanRuntime%2F7.29.2%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1735797792%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D601bd67b566384524bd50202bec6e5e6'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            log_message('error', 'cURL error: ' . $error_msg);
            show_error('An error occurred while processing the request. Please try again later.', 500);
            return;
        }

        curl_close($curl);

        // Decode JSON response
        $data = json_decode($response, true);

        // Memeriksa apakah decoding berhasil
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "Error decoding JSON: " . json_last_error_msg();
            exit;
        }

        // Menampilkan data
        $kodeFaskesList = [];
        foreach ($data as $item) {
    // Mengecek apakah status_setuju_katim adalah "Ya"
            if ($item['status_setuju_katim'] === 'Ya') {
                $kodeFaskesList[] = htmlspecialchars($item['kode_faskes']);
            }
        }


        $kodeFaskesString = implode("','", $kodeFaskesList);
        $where = "'" . $kodeFaskesString . "'";

        $datas = [
            'contents' => 'tpmd',
            'data' => $this->Tte_non_rs->tpmd($where),
        ];
       // echo json_encode($kodeFaskesList);exit;

        $this->load->view('List_Rekomendasi', $datas);
    }



    public function tpmdvalid()
    {
        $link = $this->uri->segment(2);
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://mutufasyankes.kemkes.go.id/api/status_verif_katim',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'x-id: mutukemenkes',
            'x-pass: rsonline!@#$',
            'x-timestamp:'.time(),
            'authorization: Basic ZXNpZ25jcy1kZXYta2VtZW5rZXM6VDJSUzNNNFJLdzJOU3FYZg==',
            'cookie: TS01151b7a=0172bf5c626263bce5ac123b86cd4ff7a4ddde96b21f83acafebf0b4fc0df6b095877375befa2093ca5a077ed89dd6ad5c9862a5c9074f3919bd0751dee2c08172a848bd19; ci_session=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22a4c35971c4ae66dbae05b2159f73c084%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A14%3A%2227.123.222.229%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A21%3A%22PostmanRuntime%2F7.29.2%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1723371143%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D309ff6593cc97eb0d93ec080147f9ef4'
        ),
      ));
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);

// Memeriksa apakah decoding berhasil
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "Error decoding JSON: " . json_last_error_msg();
            exit;
        }

// Menampilkan data
        foreach ($data as $item) {
           $kodeFaskesList[] = htmlspecialchars($item['kode_faskes']);

       }

       $kodeFaskesString = implode("','", $kodeFaskesList);
       $xt = "'" . $kodeFaskesString."'";

       $data = array('contents' => 'tpmd',
        'data'    => $this->Tte_non_rs->tpmdvalid($xt),
        'link'    => $link,
    );


       $this->load->view('List_Rekomendasi',$data);


   }

   public function Detailtpmd() {
    $timestamp = time();
    $kd = $this->uri->segment(3);  // Get the kd from the URI segment

    // Initialize cURL
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://mutufasyankes.kemkes.go.id/api/status_verif_katim/' . $kd,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'x-id: mutukemenkes',
            'x-pass: rsonline!@#$',
            'x-timestamp: ' . $timestamp,
            'cookie: TS01151b7a=0172bf5c62dd2ceae2dd097a56722b10bb38b719d6b709567a435f0acbfd7609311be64adf63726518bbb53037b16ed3f2fe02ddf983b945f66ac1a7309e127d73534784bd; ci_session=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%222851dca30c974d506d165ee0889fbea9%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A14%3A%22172.68.153.143%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A21%3A%22PostmanRuntime%2F7.29.2%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1735797792%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D601bd67b566384524bd50202bec6e5e6'
        ),
    ));

    // Execute cURL request and get the response
    $response = curl_exec($curl);
    $curl_error = curl_error($curl);
    curl_close($curl);

    if ($curl_error) {
        // Handle error (optional logging or display)
        log_message('error', 'cURL error: ' . $curl_error);
        show_error('Failed to fetch data.');
    }

    // Decode the JSON response
    $data = json_decode($response, true);

    if (empty($data)) {
        show_error('No data found.');
    }

    $elements = [];
    $tgl_survei = [];

    // Loop through the data and collect ids and survey dates
    foreach ($data as $row) {
        if (!isset($row["status_setuju_katim"])) {
            continue;
        }
        $elements[] = $row['id'];
        $tgl_survei[] = $row['tanggal_setuju_katim'];
    }

    // Prepare the ID and survey date as comma-separated strings
    $xt = implode(',', $elements);
    $ts = implode(',', $tgl_survei);

    // Call filesertifikattpmd function
    $this->filesertifikattpmd($kd, $xt, $ts);

    // Define file paths
    $attachment = 'assets/TPMD/' . $xt . '.pdf';
    $valid = 'assets/TPMD/dir' . $xt . '.pdf';
    $hasiltte = 'assets/TPMD/FINALdir' . $xt . '.pdf';

    // Query the database for the certificate data using query builder
    $this->sina->where('id_pengajuan', $xt);
    $query = $this->sina->get('data_sertifikat_tpmd');
    $cek = $query->row_array();

    // Prepare data for the view
    $data = array(
        'contents' => 'detailtpmddirektur',
        'detail' => $this->Tte_non_rs->detail_tpmd($kd),
        'idp' => $xt,
        'tgls' => $ts,
        'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
        'hasiltte' => is_file(FCPATH . $hasiltte) ? base_url($hasiltte) : null,
        'valid' => $cek,
    );

   // echo json_encode($cek);exit;
    // Load the view
    $this->load->view('List_Rekomendasi', $data);
}


public function simpanverifikasitpmd()
{
    $status = $this->input->post('status_direktur');
    $catatan = $this->input->post('catatan_direktur');
    $kode_faskes = $this->input->post('kode_faskes');
    $idp = $this->input->post('idp');
    $nama_faskes = $this->input->post('nama_faskes');
    $alamat = $this->input->post('alamat');
    $kecamatyan = $this->input->post('kecamatan');
    $kabkot = $this->input->post('kabkot');
    $provinsi = $this->input->post('provinsi');
    $status_akreditasi = $this->input->post('capayan');
    $tgl_survei = $this->input->post('tgl_surveior');
    $jenis = $this->input->post('jenis_faskes');
    $lpa = $this->input->post('lpa');
    $data_sertifikat = array('status' => $status,
     'kode_faskes'             => $kode_faskes,
     'id_pengajuan'             => $idp,
     'nama_faskes'             => $nama_faskes,
     'jenis_faskes'            => $jenis,
     'alamat'                  => $alamat,
     'kecamatan'               => $kecamatyan,
     'kabkot'                  => $kabkot,
     'provinsi'                => $provinsi,
     'status_akreditasi'       => $status_akreditasi,
     'file_tte_dir'             => "dir".$idp.".pdf",
     'tgl_survei'            => $tgl_survei,
     'lpa'                    => $lpa,);
    $where = array('id_pengajuan' => $persetujuan);
    $query = "SELECT id FROM data_sertifikat_tpmd WHERE id_pengajuan = '".$idp."'";
    $sql = $this->sina->query($query)->row_array();
    if ($sql == null) {
        $this->sina->insert('data_sertifikat_tpmd',$data_sertifikat);
    }

    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Verifikasi berhasil</div>');
    redirect('Mutu_fasyankes/detailtpmd/'.$kode_faskes);
    

}


public function filesertifikattpmd($kd,$xt,$ts)
{
    $kd = $this->uri->segment(3);
    $this->load->library('pdfgenerator');
    $this->data['title_pdf'] = 'Sertifikat';
    $content = $this->Tte_non_rs->detail_tpmd($kd);
    $data['data'] = $content;
    $data['tgls'] = $ts;
    $file_pdf = $xt;
    $paper = 'A4';
    $orientation = "landscape";
    // echo json_encode($data['data']);
    $html =  $this->load->view('tpmd/sertifikatkosong',$data,true);
    $this->pdfgenerator->generatetpmd($html, $file_pdf,$paper,$orientation);


}


public function ceklpa()
{
    $fun = $this->uri->segment(2);
    $cek = $this->uri->segment(3);
    $data = array('contents' => 'new_progres',
     'data'    => $this->New_progres->ceklpatte($cek),
     'cek'    => $cek
 );
       //  var_dump($fun);
    $this->load->view('List_Rekomendasi',$data);
}

public function cekdirjen()
{
    $fun = $this->uri->segment(2);
    $cek = $this->uri->segment(3);
    $data = array('contents' => 'new_progres',
     'data'    => $this->New_progres->cekdirjentte($cek),
     'cek'    => $cek
 );
       //  var_dump($fun);
    $this->load->view('List_Rekomendasi',$data);
}


public function sudahverif()
{

    $id = 0;
    $this->load->library('encryption');
    $data = array('contents' => 'listsudahverif',
     'data'    => $this->Dashboard_tte->sudahverif($id)
 );
      //  echo json_encode($data['data']);
    $this->load->view('List_Rekomendasi',$data);
}

public function verifikasisertifikat()
{
    $id = 0;
    $data = array('contents' => 'verifikasidirektur',
     'data'    => $this->Tte_non_rs->belumverifikasi()
 );
      //  echo json_encode($data['data']);
    $this->load->view('List_Rekomendasi',$data);
}
public function Detail()
{
    if ($this->session->userdata('id') == '3') {
        $id = $this->uri->segment(3);
        $data['idrek'] = $this->Dashboard_tte->detail_mutu($id);

        // Inisialisasi variabel attachment
        $attachment = null;

        // Periksa apakah $data['idrek'] adalah array dan tidak kosong
        if (!empty($data['idrek']) && is_array($data['idrek'])) {
            foreach ($data['idrek'] as $file) {
                if (isset($file->lembagaAkreditasiId)) {
                    switch ($file->lembagaAkreditasiId) {
                        case 'lafki':
                            $attachment = 'assets/generate/lafki/ttelafkilembaga' . $id . '.pdf';
                            break;
                        case 'kars':
                            $attachment = 'assets/generate/kars/tteKars_lembaga' . $id . '.pdf';
                            break;
                        case 'lars':
                            $attachment = 'assets/generate/lars/tteLarslembaga' . $id . '.pdf';
                            break;
                        case 'lam':
                            $attachment = 'assets/generate/lam/tteLamlembaga' . $id . '.pdf';
                            break;
                        case 'larsdhp':
                            $attachment = 'assets/generate/larsdhp/tteLarsdhplembaga' . $id . '.pdf';
                            break;
                        case 'larsi':
                            $attachment = 'assets/generate/larsi/tteLarsilembaga' . $id . '.pdf';
                            break;
                        default:
                            // Jika tidak ada yang cocok, biarkan $attachment tetap null
                            break;
                    }

                    // Jika file ditemukan, keluar dari loop
                    if ($attachment && file_exists(FCPATH . $attachment)) {
                        break;
                    } else {
                        // Jika file tidak ada, set $attachment ke null
                        $attachment = null;
                    }
                }
            }
        }

        $data = array(
            'contents'   => 'Detail_mutu',
            'data'       => $this->Dashboard_tte->detail_mutu($id),
            'skorsing'   => $this->Dashboard_tte->cek_skorsing_surveor($id),
            'nilai'      => $this->Dashboard_tte->penilaian_bab($id),
            'attachment' => $attachment ? base_url($attachment) : null,
            'id'         => $id
        );

        $this->load->view('List_Rekomendasi', $data);
    } else {
        redirect('Mutu_fasyankes/nonrsbelumverifikasi');
    }
}


public function Verifikasi_mutu()
{
  $id = $this->input->post('id');
  $mutu = $this->input->post('status');
  $keterangan = $this->input->post('keterangan');
  $time = date('Y-m-d H:i:s');
  $url = base_url('Mutu_fasyankes/Detail/'.$id);
  $this->Dashboard_tte->verifikasi_mutu($mutu,$keterangan,$id,$time);
  $query = "SELECT id FROM sertifikat_1 WHERE rekomendasi_id = '".$id."'";
  $sql = $this->db->query($query)->row_array();
  $sertifikat_2 = array('sertifikat_id_1'       => $sql['id'],
    'pejabat_sertifikat_id' => $this->session->userdata('pid'),
    'status_validasi_sertifikat_id' => $mutu,
    'pengguna_id'                   => $this->session->userdata('id'));
  $simpan = $this->db->insert('sertifikat_2',$sertifikat_2);
  echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    Berhasil Verifikasi.....</div>');

  redirect($url);


}

public function nonrsbelumverifikasi()
{

$faskes_segment = $this->uri->segment(3);
$faskes = (isset($faskes_segment) && is_string($faskes_segment)) ? urldecode($faskes_segment) : '';
$jenis_segment = $this->uri->segment(4);
$jenis = (isset($jenis_segment) && is_string($jenis_segment)) ? urldecode($jenis_segment) : '';
    $data = array('contents' => 'listmutunonrs',
     'databelum'    => $this->Tte_non_rs->belumverifikasi($faskes,$jenis)
 );
   // echo json_encode($faskes);exit;
    $this->load->view('List_Rekomendasi',$data);
}

public function nonrssudahverifikasi()
{

    $faskes = $this->input->get('faskes') ?? null;
    $data = array('contents' => 'listmutunonrssudahverif',
     'databelum'    => $this->Tte_non_rs->sudahverifikasi($faskes)
 );
      //  print($data['databelum']);
    $this->load->view('List_Rekomendasi',$data);
}



public function Detailnonrs()
{
    $faskes = $this->uri->segment(3) ? urldecode($this->uri->segment(3)) : '';
    $id     = $this->uri->segment(4);
    $id_p   = $this->uri->segment(5);

    // Validasi parameter
    if (!$faskes || !$id || !$id_p) {
        show_error("Parameter tidak lengkap atau salah.", 400, "Bad Request");
        return;
    }

    // Panggil generate file sertifikat
    $this->filesertifikat($faskes, $id, $id_p);

    // Tentukan path sertifikat PDF
    $attachment_path = 'assets/faskessertif/' . $id_p . '.pdf';
    $attachment_url = is_file(FCPATH . $attachment_path) ? base_url($attachment_path) : null;

    // Ambil data detail dari model
    $detail = $this->Tte_non_rs->bahansertifikat($faskes, $id, $id_p);

    $data = array(
        'contents'   => 'detailmutunonrs',
        'detail'     => $detail,
        'attachment' => $attachment_url
    );

    // Kirim ke view
    $this->load->view('List_Rekomendasi', $data);
}


public function simpanverifikasi($value = '')
{
    // Ambil data dari input
    $status = $this->input->post('status_direktur');
    $persetujuan = $this->input->post('persetujuan_ketua_id');
    $catatan = $this->input->post('catatan_direktur');
    $kode_faskes = $this->input->post('kode_faskes');
    $idp = $this->input->post('idp');
    $nama_faskes = $this->input->post('nama_faskes');
    $alamat = $this->input->post('alamat');
    $kecamatyan = $this->input->post('kecamatan');
    $kabkot = $this->input->post('kabkot');
    $provinsi = $this->input->post('provinsi');
    $status_akreditasi = $this->input->post('capayan');
    $tgl_survei = $this->input->post('tgl_surveior');
    $logo = $this->input->post('logo');
    $jenis = $this->input->post('jenis_faskes');
    $lpa = $this->input->post('lpa');
    $kategori_faskes = $this->input->post('kategori_faskes');

    // Siapkan data untuk disimpan
    $verifikasi = array(
        'status_direktur' => $status,
        'persetujuan_ketua_id' => $persetujuan,
        'catatan_direktur' => $catatan
    );

    // Cek apakah persetujuan sudah ada
    $query = "SELECT id FROM persetujuan_direktur WHERE persetujuan_ketua_id = " . $this->db->escape($persetujuan);
    $sql = $this->sina->query($query)->row_array();

    if ($sql == null) {
        // Jika belum ada, simpan data persetujuan
        $this->sina->insert('persetujuan_direktur', $verifikasi);
        $id = $this->sina->insert_id(); // Ambil ID yang baru saja disimpan
    } else {
        // Jika sudah ada, ambil ID yang ada
        $id = $sql['id'];
    }

    // Siapkan data sertifikat
    $data_sertifikat = array(
        'persetujuan_direktur_id' => $id,
        'kode_faskes' => $kode_faskes,
        'id_pengajuan' => $idp,
        'nama_faskes' => $nama_faskes,
        'jenis_faskes' => $jenis,
        'alamat' => $alamat,
        'kecamatan' => $kecamatyan,
        'kabkot' => $kabkot,
        'provinsi' => $provinsi,
        'status_akreditasi' => $status_akreditasi,
        'tgl_survei' => $tgl_survei,
        'logo' => $logo,
        'lpa' => $lpa,
        'kategoriFaskes' => $kategori_faskes
    );

    // Cek apakah data sertifikat sudah ada
    $cds = "SELECT id FROM data_sertifikat WHERE kode_faskes = " . $this->db->escape($kode_faskes);
    $hcds = $this->sina->query($cds)->row_array();

    if ($hcds != null) {
        // Jika sudah ada, lakukan update
        $this->sina->where('kode_faskes', $kode_faskes);
        $this->sina->update('data_sertifikat', $data_sertifikat);
    } else {
        // Jika belum ada, lakukan insert
        $this->sina->insert('data_sertifikat', $data_sertifikat);
    }

    // Set flashdata dan redirect sesuai jenis faskes
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Verifikasi berhasil</div>');

    switch ($jenis) {
        case 'Pusat Kesehatan Masyarakat':
            redirect('Mutu_fasyankes/nonrsbelumverifikasi?faskes=Puskesmas');
            break;
        case 'Klinik':
            redirect('Mutu_fasyankes/nonrsbelumverifikasi?faskes=Klinik');
            break;
        case 'Laboratorium Kesehatan':
            redirect('Mutu_fasyankes/nonrsbelumverifikasi');
            break;
        case 'Unit Transfusi Darah':
            redirect('Mutu_fasyankes/nonrsbelumverifikasi?faskes=utd');
            break;
        default:
            redirect('Mutu_fasyankes/nonrsbelumverifikasi');
            break;
    }
}


public function filesertifikat($faskes,$id,$id_p)
{
    $this->load->library('pdfgenerator');
    $this->load->model('Tte_non_rs');

    // Ambil data sertifikat
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
}

private function base64EncodeImage($filename = "")
{
    if (file_exists($filename)) {
        $type = pathinfo($filename, PATHINFO_EXTENSION);
        $data = file_get_contents($filename);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
    return '';
}






public function ttedirnonrs()
{
    $kd = $this->input->post('id');
    $jenis = $this->input->post('jenis');
    $url = base_url('Mutu_fasyankes/Detailnonrs/' . $kd.'/'.$jenis);
    $nik = $this->input->post('nik');
    $tte_lembaga_id = $this->input->post('tte_lembaga_id');
    $passphrase = $this->input->post('passphrase');
    $content = $this->Tte_non_rs->Sertifikat_detail($kd);
    $data['faskes'] = $content;
    $filename = "showttedir".$kd.".pdf";
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
    $uploadDir = FCPATH . 'assets/faskessertif/finaltte';
    $fp = fopen($uploadDir . $filename, 'w');
    fwrite($fp, $result);
    fclose($fp);
    $ttetgl = format_indo(date('Y-m-d'));
    $datasimpan =array(
        'tte_lembaga_id' => $tte_lembaga_id,
        'id_faskes' => $kd,
        'tgltte' => $ttetgl,
        'url' => "finaltte".$filename,
        'status_tte' => 1
    );
    $simpan = $this->sina->insert('tte_direktur',$datasimpan);
    echo $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Berhasil melakukan Tandatangan Elektronik</div>');
    redirect($url);
}


public function tpmd_detail($id_pengajuan = null)
{
    // Validasi parameter
    if (!$id_pengajuan) {
        $id_pengajuan = $this->uri->segment(3);
        if (!$id_pengajuan) {
            $this->session->set_flashdata('error', 'ID Pengajuan tidak valid');
            redirect('mutu_fasyankes/tpmdbelumverifikasi');
        }
    }

    // Query untuk mendapatkan detail TPMD
    $query = "SELECT
                    verifikasi_api.status_setuju_katim,
                    db_akreditasi_non_rs.verifikasi_api.id,
                    db_akreditasi_non_rs.verifikasi_api.kode_faskes,
                    db_akreditasi_non_rs.verifikasi_api.id_faskes,
                    dbfaskes.data_pm.nama_pm,
                    dbfaskes.propinsi_dagri.nama_prop,
                    dbfaskes.kota.nama_kota,
                    dbfaskes.kecamatan.nama_camat,
                    dbfaskes.data_pm.alamat_faskes 
                FROM
                    db_akreditasi_non_rs.verifikasi_api
                    LEFT JOIN db_akreditasi_non_rs.data_sertifikat_tpmd ON verifikasi_api.kode_faskes = data_sertifikat_tpmd.kode_faskes
                    LEFT JOIN dbfaskes.data_pm ON db_akreditasi_non_rs.verifikasi_api.id_faskes = dbfaskes.data_pm.id_faskes
                    LEFT JOIN dbfaskes.propinsi_dagri ON dbfaskes.data_pm.id_prov_pm = dbfaskes.propinsi_dagri.id_prop
                    LEFT JOIN dbfaskes.kota ON dbfaskes.data_pm.id_kota_pm = dbfaskes.kota.id_kota
                    LEFT JOIN dbfaskes.kecamatan ON dbfaskes.data_pm.id_camat_pm = dbfaskes.kecamatan.id_camat 
                WHERE
                    verifikasi_api.id_pengajuan = ?";

    $detail = $this->sina->query($query, [$id_pengajuan])->row();

    if (!$detail) {
        $this->session->set_flashdata('error', 'Data TPMD tidak ditemukan');
        redirect('mutu_fasyankes/tpmdbelumverifikasi');
    }

    // Generate sertifikat jika status katim "Ya"
    $attachment = null;
    $valid = null;
    $hasiltte = null;

    if ($detail->status_setuju_katim === 'Ya') {
        $file_paths = [
            'attachment' => 'assets/TPMD/' . $id_pengajuan . '.pdf',
            'valid' => 'assets/TPMD/dir' . $id_pengajuan . '.pdf',
            'hasiltte' => 'assets/TPMD/FINALdir' . $id_pengajuan . '.pdf'
        ];

        foreach ($file_paths as $key => $path) {
            if (file_exists(FCPATH . $path)) {
                $$key = base_url($path);
            }
        }
    }

    // Prepare data untuk view
    $data = [
        'contents' => 'tpmd_detail',
        'title' => 'Detail TPMD',
        'detail' => $detail,
        'attachment' => $attachment,
        'valid' => $valid,
        'hasiltte' => $hasiltte
    ];

    $this->load->view('List_Rekomendasi', $data);
}
}