<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('Tte_non_rs');
        $this->load->model('New_progres');
        $this->load->model('M_task');
        $this->sina = $this->load->database('sina', TRUE);
        $this->dbfaskes = $this->load->database('dbfaskes', TRUE);
        $this->load->library('encrypt');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

    public function index()
    {
       $this->load->view('task/dashboard');
   }

   public function update_sertifikat_nonrs() {
        $data = $this->input->post('data'); // Ambil data POST (jika ada)
        $fasyankes_input = $this->input->post('fasyankes_input'); // Mengambil input pencarian nama    // Mengambil input pencarian ID

        $messages = [
            '0' => "Tidak ada data yang dipilih.",
            '1' => "Puskesmas",
            '2' => "Klinik",
            '3' => "Labkes",
            '4' => "UTD"
        ];
        $message = isset($messages[$data]) ? $messages[$data] : "Input tidak valid.";

        $nama_fasyankes = '';
        $fasyankes_id = '';

        if (is_numeric($fasyankes_input)) {
            $fasyankes_id = $fasyankes_input;
        } else {
            // Jika input berupa string (nama), kita anggap itu adalah nama fasyankes
            $nama_fasyankes = $fasyankes_input;
        }

        $fasyankes_data = [];
        if ($data === '1') { // Hanya untuk Puskesma
            $fasyankes_data = $this->M_task->get_puskesmas($nama_fasyankes, $fasyankes_id);
        }

      // echo json_encode($fasyankes_data);
        $this->load->view('task/update_sertifikat_nonrs', [
            'message' => $message,
            'fasyankes_data' => $fasyankes_data
        ]);
    }

    public function update()
{
    // Ambil data dari POST
    $fasyankes_id = $this->input->post('fasyankes_id');
    $nama_fasyankes = $this->input->post('nama_fasyankes');
    $alamat = $this->input->post('alamat');
    $dsid = $this->input->post('dsid');

    // Update data fasyankes di database
    $data = [
        'name' => $nama_fasyankes,
        'alamat' => $alamat,
        'alamat_sertifikat' => $alamat
    ];

        $datads = [
        'nama_faskes' => $nama_fasyankes,
        'alamat' => $alamat,
    ];
    $update = $this->M_task->update_fasyankes($fasyankes_id, $data);
    $updateDS = $this->M_task->update_ds($dsid, $datads);

    // Setelah update, beri notifikasi dan kembali
    if ($update) {
        $this->session->set_flashdata('message', 'Data fasyankes berhasil diperbarui!');
    } else {
        $this->session->set_flashdata('message', 'Terjadi kesalahan saat memperbarui data.');
    }

    redirect('https://sinar.kemkes.go.id/Task/update_sertifikat_nonrs'); // Kembali ke halaman yang sesuai
}


    public function vendor()
    {
        $lpa = $this->session->userdata('lembaga_id');
        $url = "https://developer-portal-verification.kemkes.go.id/summary/data-verified?category=vendor";
        $get_url = file_get_contents($url);
        $data = json_decode($get_url);
        $file = $data->data;
        $data = array('contents' => 'task/vendor',
            'data'    => $this->Tte_non_rs->list_faskes_lembaga($lpa),
            'vendor'    => $this->M_task->vendor(),
            'datalist' =>$data->data,
            // 'sudah'  => $this->Tte_non_rs->faskes_detail($id),
        );

        // foreach ($file as $value) {

        //     $cek = array('dtoid' => json_encode($value->id),
        //                  'nameFacility' => $value->nameFacility,
        //                  'createAt'     => $value->createAt,);
        //     echo json_encode($cek);
        //     $this->dbfaskes->insert_batch('sim_pengembang_sink', $cek); 
        // }

   // echo json_encode($file);
   // print_r($file);
        $this->load->view('List_Rekomendasi',$data);
    }

    public function puskesmas()
    {

        $data = array('contents' => 'task/puskesmas');
        $this->load->view('List_Rekomendasi',$data);
    }

    public function integrasi_puskesmas()
    {

        $code_lama = $this->uri->segment(3);

        $url1 = 'https://api.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials';
        $ch = curl_init($url1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'client_id=gZCc3UyruaZwEGM0yrAvWgTQ34iAAzmkFhwJoNowxAv9HG26&client_secret=BfGK9aVB5YkiRIyicNigTOlPchHRrhYGLFO7G6L0zlORL4i6UKXGWRBjZfS4vSAz');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $data   = array(
            'record' => json_decode($result, true),
        );
        $token = $data['record']['access_token'];

       // $kode_sarana = $this->session->userdata('id_faskes');

        $authorization = "Authorization: Bearer ".$token;

        /* API URL */
        $url = 'https://api.kemkes.go.id/data/v1/mastersaranaindex/mastersarana?limit=10&page=1&jenis_sarana=102&identifier_kode_sarana='.$code_lama;

        /* Init cURL resource */
        $ch = curl_init($url);

        /* set the content type json */
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array($authorization ));

        /* set return type json */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* execute request */
        $result = curl_exec($ch);

        /* close cURL resource */
        curl_close($ch);

        // foreach ($data->data as $row){
        $data = json_decode($result);
        $cek = $data->data->data;
          //  echo json_encode($data);

        foreach ($cek as $value) {
            $arr_result = array(

                'name'          =>$value->name,
                'code'          =>$value->code,
                'kode_baru'    =>$value->kode_sarana,
                'alamat'         =>$value->alamat,
                'telp'          => $value->telp,
                    // 'operasional'   => $value->operasional,
                'provinsi_nama' => $value->provinsi->name,
                'provinsi_code' => $value->provinsi->code,
                'kabkot_nama' => $value->kabkota->name,
                'kabkot_code' => $value->kabkota->code,
                'kecamatan_nama' => $value->kecamatan->name,
                'kecamatan_code' => $value->kecamatan->code,
                'kelurahan_nama' => $value->kelurahan->name,
                'kelurahan_code' => $value->kelurahan->code,
            );
            echo json_encode($arr_result);
        }

    }

    public function perbaikan_sertifikat()
    {
        $faskes = $this->uri->segment(3) ?? null;
        $data = array('contents' => 'task/perbaikan_sertifikat',
            'databelum'    => $this->M_task->perbaikan($faskes),
        );
     // echo json_encode($data['data']);exit;
        $this->load->view('List_Rekomendasi',$data);
    }

    public function simpan_vendor()
    {
        $id=$this->input->post('id');
        $name=$this->input->post('nameFacility');
        $time=$this->input->post('createAt');

        $datasimpan =array(
            'dtoId' => $id,
            'nameFacility' => $name,
            'createAt' => $time,
        );
        $simpan = $this->dbfaskes->insert('sim_pengembang',$datasimpan);
        redirect(base_url('Task/vendor'));
    }


    public function ambil_dan_simpan_data()
{
    // Mengambil data dari session
    $lpa = $this->session->userdata('lembaga_id');
    
    // URL API
    $url = "https://developer-portal-verification.kemkes.go.id/summary/data-verified?category=vendor";
    
    // Menggunakan cURL untuk mengambil data API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);

    // Cek jika terjadi error saat mengambil data
    if (curl_errno($ch)) {
        // Menangani error
        echo "Error: " . curl_error($ch);
        curl_close($ch);
        return;
    }
    
    // Menutup koneksi cURL
    curl_close($ch);
    
    // Decode JSON response dari API
    $data = json_decode($response);
    
    // Pastikan data valid dan memiliki data yang diperlukan
    if ($data && isset($data->data)) {
        // Ambil data dari API
        $file = $data->data;

        // Loop untuk menyimpan data ke dalam database
        foreach ($file as $item) {
            $id = $item->dtoId;
            $name = $item->nameFacility;
            $time = $item->createAt;

            // Cek apakah dtoId sudah ada di database
            $this->dbfaskes->where('dtoId', $id);
            $existingData = $this->dbfaskes->get('sim_pengembang_copy2')->row();  // Ambil satu baris data yang sesuai

            if (!$existingData) {
                // Data belum ada, maka simpan ke dalam database
                $datasimpan = array(
                    'dtoId' => $id,
                    'nameFacility' => $name,
                    'createAt' => $time,
                );

                // Simpan data ke dalam tabel sim_pengembang
                $this->dbfaskes->insert('sim_pengembang_copy2', $datasimpan);
            } else {
                // Data sudah ada, lewati proses penyimpanan
                // Bisa menambahkan log jika perlu
                // echo "Data dengan dtoId {$id} sudah ada. Lewati penyimpanan.\n";
            }
        }
        
        // Setelah data berhasil disimpan, redirect ke halaman vendor
        redirect(base_url('Task/vendor'));
    } else {
        // Tangani jika data dari API tidak valid atau kosong
        echo "Data API tidak valid atau kosong.";
    }
}

}