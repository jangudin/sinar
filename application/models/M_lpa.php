<?php 

class M_lpa extends CI_Model{	


	public function lpa($idlpa) {
		$this->db->where('id_lpa', $idlpa);
		$query = $this->db->get('db_akreditasi.template_surat_tugas');
		return $query->result();
    //         $str = $this->db->last_query();



    // echo "<pre>";

    // print_r($str);

    // exit;
	}

	function get_all_surtug($idlpa,$status){

		$hsl= $this->sina->query("SELECT
			s.id,
			s.kode_rs,
			s.no_surat_tugas,
			sv1.nama AS nama_surveior_satu,
			sv2.nama AS nama_surveior_dua,
			lpa1.inisial AS lpa_satu,
			lpa2.inisial AS lpa_dua,
			s.tanggal_survei_1,
			s.tanggal_survei_2,
			s.tanggal_survei_3,
			s.tanggal_survei_4,
			s.narahubung_rs,
			s.no_hp_narahubung,
			sv1.no_hp AS no_hp1,
			sv1.provinsi_id ,
			sv1.bidang_id,
			sv2.bidang_id,
			sv2.provinsi_id,
			sv2.no_hp AS no_hp2,
			b1.bidang AS bid1,
			b2.bidang AS bid2,
			prov1.nama_prop AS prv1,
			prov2.nama_prop AS prv2,
			s.jabatan_surveior_satu,
			s.jabatan_surveior_dua
			FROM
			surtug_rs s
			LEFT JOIN user_surveior AS sv1 ON s.surveior_id_satu = sv1.id
			LEFT JOIN user_surveior AS sv2 ON s.surveior_id_dua = sv2.id
			LEFT JOIN lpa AS lpa1 ON sv1.lpa_id = lpa1.id
			LEFT JOIN lpa AS lpa2 ON sv2.lpa_id = lpa2.id
			LEFT JOIN bidang AS b1 ON sv1.bidang_id = b1.id
			LEFT JOIN bidang AS b2 ON sv2.bidang_id = b2.id 
			LEFT JOIN dbfaskes.propinsi AS prov1 ON sv1.provinsi_id = prov1.id_prop
			LEFT JOIN dbfaskes.propinsi AS prov2 ON sv2.provinsi_id = prov2.id_prop 
			WHERE
			lpa1.inisial = '$idlpa' AND
			s.status_tte = '$status'");
		if ($status == null) {
			return [];
		}else{
		 return $hsl->result();


    // $str = $this->sina->last_query();
    // echo "<pre>";
    // print_r($str);
    // exit;
		}
	}

	function get_surtug_byid($id){

		$hsl= $this->sina->query("SELECT
			s.id,
			s.kode_rs,
			s.no_surat_tugas,
			sv1.nama AS nama_surveior_satu,
			sv2.nama AS nama_surveior_dua,
			lpa1.inisial AS lpa_satu,
			lpa2.inisial AS lpa_dua,
			s.tanggal_survei_1,
			s.tanggal_survei_2,
			s.tanggal_survei_3,
			s.tanggal_survei_4,
			s.narahubung_rs,
			s.no_hp_narahubung,
			sv1.no_hp AS no_hp1,
			sv1.provinsi_id ,
			sv1.bidang_id,
			sv2.bidang_id,
			sv2.provinsi_id,
			sv2.no_hp AS no_hp2,
			b1.bidang AS bid1,
			b2.bidang AS bid2,
			prov1.nama_prop AS prv1,
			prov2.nama_prop AS prv2,
			s.jabatan_surveior_satu,
			s.jabatan_surveior_dua
			FROM
			surtug_rs s
			LEFT JOIN user_surveior AS sv1 ON s.surveior_id_satu = sv1.id
			LEFT JOIN user_surveior AS sv2 ON s.surveior_id_dua = sv2.id
			LEFT JOIN lpa AS lpa1 ON sv1.lpa_id = lpa1.id
			LEFT JOIN lpa AS lpa2 ON sv2.lpa_id = lpa2.id
			LEFT JOIN bidang AS b1 ON sv1.bidang_id = b1.id
			LEFT JOIN bidang AS b2 ON sv2.bidang_id = b2.id
			LEFT JOIN dbfaskes.propinsi AS prov1 ON sv1.provinsi_id = prov1.id_prop
			LEFT JOIN dbfaskes.propinsi AS prov2 ON sv2.provinsi_id = prov2.id_prop
			WHERE
			s.id = '$id'");
		return $hsl->result();
	}

	function get_nama_rs($kd){

		$hsl= $this->nmrs->query("SELECT `data`.RUMAH_SAKIT, `data`.Propinsi, `data`.ALAMAT FROM `data` WHERE `data`.Propinsi IN (".$kd.")");
		if ($kd == null) {
			return [];
		}else{
			return $hsl->result();
		}
	}

	function get_rs_id($kd){

		$hsl= $this->nmrs->query("SELECT `data`.RUMAH_SAKIT, `data`.Propinsi,`data`.ALAMAT FROM `data` WHERE `data`.Propinsi='$kd'");
		$str = $hsl->result();
	}

	function get_id_surtug($id){

		$hsl= $this->sina->query("SELECT * FROM surtug_rs WHERE id = '$id'");
		return $hsl->result();
	}
}
