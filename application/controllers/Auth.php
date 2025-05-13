<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
		parent:: __construct();
		$this->load->model('m_login');
	}
	public function index()
{
    // Menginisialisasi sesi dan menghasilkan CAPTCHA
    $this->load->helper('string');
    $captcha = random_string('alnum', 6);
    $this->session->set_userdata('captcha_code', $captcha);

    $data['captcha'] = $captcha;
    $this->load->view('auth/index', $data);
}


	// 	public function page()
	// {
	// 	 $this->load->view('auth/index');

	// }

//     function aksi_login(){
// 		$u = str_replace("'", "", htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES));
// 		$p = str_replace("'", "", htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES));
// 		$cek = $this->m_login->cek_login($u,$p);
// 		$x = $cek->row_array();
// 		if($cek ->num_rows() > 0){
// 			$x = $cek->row_array();
// 			if($x['jabatan_sertifikat_id'] =='3'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$pid = $x['pejabat_sertifikat_id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('nik',$nik);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				$this->session->set_userdata('pid',$pid);
// 				redirect('Lembaga');
// 			}elseif($x['jabatan_sertifikat_id'] =='2'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$pid = $x['pejabat_sertifikat_id'];
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('nik',$nik);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				$this->session->set_userdata('pid',$pid);
// 				if($x['id'] == '48'){
// 					redirect('Mutu_fasyankes/nonrsbelumverifikasi');
// 				}else{
// 					redirect('Mutu_fasyankes');
// 				}
// 			}elseif($x['jabatan_sertifikat_id'] =='1'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('nik',$nik);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				if($x['id'] == '10'){
// 					redirect('DirjenYankes');
// 				}else{
// 					redirect('DirjenYankes/nonrsbelumtte');
// 				}
// 			}elseif($x['jabatan_sertifikat_id'] =='4'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				redirect('Monitoring');
// 			}elseif($x['jabatan_sertifikat_id'] =='5'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$this->session->set_userdata('nik',$nik);
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				redirect('AkreditasiNonRS');
// 			}elseif($x['jabatan_sertifikat_id'] =='7'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$this->session->set_userdata('nik',$nik);
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				redirect('AdminNomorSurat');
// 			}elseif($x['jabatan_sertifikat_id'] =='8'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$this->session->set_userdata('nik',$nik);
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				redirect('apps');
// 			}elseif($x['jabatan_sertifikat_id'] =='10'){ //
// 				$nik = $x['nik'];
// 				$name = $x['nama'];
// 				$lembaga = $x['lembaga_akreditasi_id'];
// 				$id = $x['id'];
// 				$jabatan = $x['jabatan_sertifikat_id'];
// 				$this->session->set_userdata('lembaga_id',$lembaga);
// 				$this->session->set_userdata('status','login');
// 				$this->session->set_userdata('jabatan_id',$jabatan);
// 				$this->session->set_userdata('nik',$nik);
// 				$this->session->set_userdata('name',$name);
// 				$this->session->set_userdata('id',$id);
// 				redirect('DirjenYankes/nonrsbelumtte');
// 			}
// 	}else{
// 		$url=base_url('Auth');
// 		echo $this->session->set_flashdata('msg','<div class="alert alert-danger">
// 			<p>Username atau Password salah.</p></div>');
// 		redirect($url);
// 	}
// }


public function aksi_login() {
    // Muat library form_validation
    $this->load->library('form_validation');

    // Atur aturan validasi untuk input email dan password
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[100]');

    // Jalankan validasi
    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, kembalikan ke halaman login dengan pesan error
        $this->session->set_flashdata('msg', validation_errors('<div class="alert alert-danger">', '</div>'));
        redirect('Auth');
        return;
    }

    // Ambil input yang telah divalidasi
    $email = $this->input->post('email', TRUE);
    $password = $this->input->post('password', TRUE);

    // Cek kredensial pengguna
    $cek = $this->m_login->cek_login($email, $password);

    if ($cek->num_rows() > 0) {
        $user = $cek->row_array();

        // Set data sesi umum
        $this->session->set_userdata([
            'status'      => 'login',
            'nik'         => $user['nik'] ?? '',
            'name'        => $user['nama'] ?? '',
            'id'          => $user['id'] ?? '',
            'pid'         => $user['pejabat_sertifikat_id'] ?? '',
            'lembaga_id'  => $user['lembaga_akreditasi_id'] ?? '',
            'jabatan_id'  => $user['jabatan_sertifikat_id'] ?? '',
        ]);

        // Arahkan pengguna berdasarkan jabatan_sertifikat_id
        switch ($user['jabatan_sertifikat_id']) {
            case '1':
                if ($user['id'] == '10') {
                    redirect('DirjenYankes');
                } else {
                    redirect('DirjenYankes/nonrsbelumtte');
                }
                break;
            case '2':
                if ($user['id'] == '48') {
                    redirect('Mutu_fasyankes/nonrsbelumverifikasi');
                } else {
                    redirect('Mutu_fasyankes');
                }
                break;
            case '3':
                redirect('Lembaga');
                break;
            case '4':
                redirect('Monitoring');
                break;
            case '5':
                redirect('AkreditasiNonRS');
                break;
            case '7':
                redirect('AdminNomorSurat');
                break;
            case '8':
                redirect('apps');
                break;
            case '10':
                redirect('DirjenYankes/nonrsbelumtte');
                break;
            default:
                // Jika jabatan tidak dikenali, kembalikan ke halaman login
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><p>Jabatan tidak dikenali.</p></div>');
                redirect('Auth');
                break;
        }
    } else {
        // Jika kredensial tidak cocok, kembalikan ke halaman login dengan pesan error
        $this->session->set_flashdata('msg', '<div class="alert alert-danger"><p>Username atau Password salah.</p></div>');
        redirect('Auth');
    }
}



	// function aksi_login(){

	// 	$u = $this->input->post('email');
 	// 	$p = md5($this->input->post('password'));
 	// 	$cek = $this->m_login->cek_login($u,$p);
 	// 	var_dump($cek);
 		

	// }
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
