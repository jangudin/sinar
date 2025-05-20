<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminNomorSurat extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '256M');
        $this->sina = $this->load->database('sina', TRUE);
        $this->load->model('M_nomor_surat');
        $this->load->library('encryption');
        $this->load->helper('tanggal_indonesia');
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }
    public function index()
    {
        redirect(base_url('AdminNomorSurat/nomor'));
    }
public function nomor($jenis_faskes = null, $kategori = null)
{
    $data = array(
        'contents' => 'adminsuarat',
        'data'     => [],
        'belum'    => (object)['belum' => 0],
    );

    // Jika parameter filter tersedia, baru ambil data
    if ($jenis_faskes !== null || $kategori !== null) {
        $data['data'] = $this->M_nomor_surat->tampil_faskes($jenis_faskes, $kategori);
    }

    $this->load->view('List_Rekomendasi', $data);
}
    public function deletedata()
    {
        $id = $this->input->post('id');
        $this->M_nomor_surat->delete_nomor($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-danger">Nomor berhasil dihapus.</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

     public function SudahInput()
    {
        $id = $this->session->userdata('lembaga_id');
        // $page = $this->input->get('page') ?? null;
        // $faskes = $this->input->get('faskes') ?? null;
        if ($this->uri->segment(4) !== null) {
            $jenis = urldecode($this->uri->segment(4));
        } else {
            $jenis = ''; // Atau nilai default lainnya
        }
        if ($this->uri->segment(3) !== null) { // Pastikan ini adalah segment yang benar
            $faskes = urldecode($this->uri->segment(3));
        } else {
            $faskes = ''; // Atau nilai default lainnya
        }
        // Memastikan pemanggilan jumlah_belum dengan dua argumen
        $data = array(
            'contents' => 'adminsuarat',
            'data' => $this->M_nomor_surat->SudahInput($faskes, $jenis),
            'belum' => $this->M_nomor_surat->jumlah_belum($faskes, $jenis),
        );
        
       // echo json_encode($data['data']);
        $this->load->view('List_Rekomendasi',$data);
    }


        public function tes()
    {
        $kd = '1090293';
        $where = array ('kode_faskes' =>$kd);
        $datacek= $this->M_nomor_surat->select_data('data_sertifikat',$where)->row_array();
        if($datacek['lpa'] == "KEMENKES"){

            $ttelpak = array(
                'data_sertifikat_id' => $datacek['id'],
                'jenis_faskes' => 'Pusat Kesehatan Masyarakat',
                'lpa' => 'KEMENKES',
                );

           echo json_encode($ttelpak);

         }

       // echo json_encode($datacek['lpa']);

        // print_r($datacek);
    }

    public function tpmd($value='')
    {
        $data = array('contents' => 'adminsurattpmd',
                      'data'    => $this->M_nomor_surat->tpmd_belum_input(),
                      'belum' => $this->M_nomor_surat->jumlah_belum_tpmd(),
      );

       // echo json_encode($data);
         $this->load->view('List_Rekomendasi',$data);
    }

        public function tpmdnomor($value='')
    {
        $data = array('contents' => 'adminsurattpmd',
                      'data'    => $this->M_nomor_surat->tpmd_sudah_input(),
      );

       // echo json_encode($data);
         $this->load->view('List_Rekomendasi',$data);
    }



    public function Export_data()
    {
        $page = $this->input->get('page') ?? null;
        $faskes = $this->input->get('faskes') ?? null;
        $data = array('contents' => 'export',
                      'data'    => $this->M_nomor_surat->view());
        
       // echo json_encode($data['jumlah']);
        $this->load->view('List_Rekomendasi',$data);
    }


        public function input_nomor_tpmd($value='')
    {
        $post = $this->input->post();
        $user = $this->session->userdata('name');
        foreach ($this->input->post('id') as $ids){
            $nomor_surat = $post['nomor_surat'][$ids];
            $nomor = "YM.02.01/B/".$nomor_surat."/2025";
            $tgl_nomor_surat = $post['tgl_nomor_surat'][$ids];            
            $data = array('nomor_surat' => $nomor,
                      'tgl_nomor_surat' => $tgl_nomor_surat,);
        $where = array ('kode_faskes' => $ids);
         echo json_encode($user);exit;
         $this->sina->update('data_sertifikat_tpmd',$data,$where);

        }
        // $kode = $this->input->post('kode_faskes');
        // $nomor_surat = $this->input->post('nomor_surat');
        // $nomor = "YM.02.01/D/".$nomor_surat."/2023";
        // $tgl_nomor_surat = $this->input->post('tgl_nomor_surat');
        // $jnsf = $this->input->post('jenisfaskes');

        // $data = array('nomor_surat' => $nomor,
        //               'tgl_nomor_surat' => $tgl_nomor_surat,);
        // $where = array ('kode_faskes' => $kode);

        // $this->sina->update('data_sertifikat',$data,$where);
        redirect('AdminNomorSurat/tpmd');
    

}


        public function input_nomor()
        {
            $post = $this->input->post();
            $jnsf = $post['jenisfaskes'];
            $nik = $this->session->userdata('nik');

            foreach ($post['id'] as $ids) {
                $nomor_surat_input = $post['nomor_surat'][$ids];
                $tgl_nomor_surat = $post['tgl_nomor_surat'][$ids];

                // Format nomor sesuai NIK
                if ($nik == '3275041501810019') {
                    $nomor = "YM.02.01/B/" . $nomor_surat_input . "/2025";
                } else {
                    $nomor = "YM.02.01/D/" . $nomor_surat_input . "/2025";
                }

                // Data yang akan disimpan
                $data = [
                    'nomor_surat' => $nomor,
                    'tgl_nomor_surat' => $tgl_nomor_surat
                ];

                $where = ['kode_faskes' => $ids];

                // Simpan ke tabel data_sertifikat
                $this->sina->update('data_sertifikat', $data, $where);

                // Cek kembali data sertifikat
                $datacek = $this->M_nomor_surat->select_data('data_sertifikat', $where)->row_array();

                // Jika LPA adalah KEMENKES, insert ke tte_lpa
                if ($datacek && $datacek['lpa'] == "KEMENKES") {
                    $ttelpak = [
                        'data_sertifikat_id' => $datacek['id'],
                        'kode_faskes' => $ids,
                        'jenis_faskes' => $jnsf,
                        'lpa' => 'KEMENKES',
                    ];

                    // Cek duplikat agar tidak insert berulang
                    $cek_tte = $this->db->get_where('tte_lpa', [
                        'kode_faskes' => $ids,
                        'data_sertifikat_id' => $datacek['id']
                    ])->num_rows();

                    if ($cek_tte == 0) {
                        $this->sina->insert('tte_lpa', $ttelpak);
                    }
                }
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success">Nomor surat berhasil disimpan.</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }


    public function tambah_nomor()
    {
        $kode = $this->input->post('kode_faskes');
        $gettgl['tglsurvei'] = $this->M_nomor_surat->tgl_survei($kode);
        $nomor_surat = $this->input->post('nomor_surat');
        if ($this->session->userdata('nomor') == 'Klinik') {
            $nomor = "YM.02.01/D.VI/SERTI/".$nomor_surat."/2025";
            $post = $this->input->post(); 
            $datak = array('nama_faskes' =>$post['nama_faskes'],
                'persetujuan_ketua_id' =>$post['persetujuan_ketua_id'],
                'jenis_faskes' =>$post['jenis_faskes'],
                'kode_faskes' =>$post['kode_faskes'],
                'nomor_surat' =>$nomor,
                'tgl_surat' => $post['tgl_surat'],
                'alamat'    => $post['alamat'],
                'kecamatan'  => $post['kecamatan'],
                'kabkot'    => $post['kabkot'],
                'provinsi'  => $post['provinsi'],
                'capayan'   => $post['capayan'],
                'kdlembaga' => $post['kdlembaga'],
                'logo_ttd'      => $post['logo_ttd'],
                'tgl_surveior' => $gettgl['tglsurvei'][0]->tanggal_survei,
            );
            $where = array('nomor_surat' => $nomor);
            $datacek= $this->M_nomor_surat->select_data('sertifikat_nomor',$where)->row();
            if ($datacek == null) {

                $tambah = $this->sina->insert('sertifikat_nomor',$datak);

                if($tambah==true){
                   echo $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>Data Berhasil Di simpan </div>');
               }
               else{
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>Data Gagal Disimpan </div>');
            }
        }else{

          echo $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>Nomor Surat Yang di input Sudah Ada</div>');
      }
  } else {
    $nomor = "YM.02.01/D/".$nomor_surat."/2025";
    $post = $this->input->post(); 
    $datap = array('nama_faskes' =>$post['nama_faskes'],
        'persetujuan_direktur_id' =>$post['persetujuan_ketua_id'],
        'jenis_faskes' =>$post['jenis_faskes'],
        'kode_faskes' =>$post['kode_faskes'],
        'nomor_surat' =>$nomor,
        'tgl_surat' => $post['tgl_surat'],
        'alamat'    => $post['alamat'],
        'kecamatan'  => $post['kecamatan'],
        'kabkot'    => $post['kabkot'],
        'provinsi'  => $post['provinsi'],
        'capayan'   => $post['capayan'],
        'kdlembaga' => $post['kdlembaga'],
        'logo_ttd'      => $post['logo_ttd'],
        'tgl_surveior' => $gettgl['tglsurvei'][0]->tanggal_survei,
    );
    $where = array('nomor_surat' => $nomor);
    $datacek= $this->M_nomor_surat->select_data('sertifikat_nomor_puskesmas',$where)->row();
    if ($datacek == null) {

        $tambah = $this->sina->insert('sertifikat_nomor_puskesmas',$datap);

        if($tambah==true){
         echo $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>Data Berhasil Di simpan </div>');
     }
     else{
        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>Data Gagal Disimpan </div>');
    }
}else{

  echo $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>Nomor Surat Yang di input Sudah Ada</div>');
}
}

redirect('AdminNomorSurat');

       // echo json_encode($gettgl['tglsurvei'][0]->tanggal_survei);exit;
}

}
