<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
		parent:: __construct();
		$this->load->model('m_login');
	}
	public function index()
	{
		 $this->load->view('auth/index');

		// echo"mohon maaf sedang perbaikan";
	}

	// 	public function page()
	// {
	// 	 $this->load->view('auth/index');

	// }

    function aksi_login(){
		$u = str_replace("'", "", htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES));
		$p = str_replace("'", "", htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES));
		$cek = $this->m_login->cek_login($u,$p);
		$x = $cek->row_array();
		if($cek ->num_rows() > 0){
			$x = $cek->row_array();
			if($x['jabatan_sertifikat_id'] =='3'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$pid = $x['pejabat_sertifikat_id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('nik',$nik);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				$this->session->set_userdata('pid',$pid);
				redirect('Lembaga');
			}elseif($x['jabatan_sertifikat_id'] =='2'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$pid = $x['pejabat_sertifikat_id'];
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('nik',$nik);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				$this->session->set_userdata('pid',$pid);
				redirect('Mutu_fasyankes');
			}elseif($x['jabatan_sertifikat_id'] =='1'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('nik',$nik);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				redirect('DirjenYankes');
			}elseif($x['jabatan_sertifikat_id'] =='4'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				redirect('Monitoring');
			}elseif($x['jabatan_sertifikat_id'] =='5'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$this->session->set_userdata('nik',$nik);
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				redirect('AkreditasiNonRS');
			}elseif($x['jabatan_sertifikat_id'] =='7'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$this->session->set_userdata('nik',$nik);
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				redirect('AdminNomorSurat');
			}elseif($x['jabatan_sertifikat_id'] =='8'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$this->session->set_userdata('nik',$nik);
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				$this->session->set_userdata('id_apps_role_akses',$id_apps_role_akses);

				redirect('apps');
			}elseif($x['jabatan_sertifikat_id'] =='10'){ //
				$nik = $x['nik'];
				$name = $x['nama'];
				$lembaga = $x['lembaga_akreditasi_id'];
				$id = $x['id'];
				$jabatan = $x['jabatan_sertifikat_id'];
				$this->session->set_userdata('lembaga_id',$lembaga);
				$this->session->set_userdata('status','login');
				$this->session->set_userdata('jabatan_id',$jabatan);
				$this->session->set_userdata('nik',$nik);
				$this->session->set_userdata('name',$name);
				$this->session->set_userdata('id',$id);
				redirect('DirjenYankes/nonrsbelumtte');
			}
	}else{
		$url=base_url('Auth');
		echo $this->session->set_flashdata('msg','<div class="alert alert-danger">
			<p>Username atau Password salah.</p></div>');
		redirect($url);
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