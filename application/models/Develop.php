<?php 

class Develop extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}
	function cariData($kategori)
	{
		$NonRs=$this->sina->query("
			SELECT
			data_sertifikat.kode_faskes, 
			data_sertifikat.nama_faskes, 
			data_sertifikat.alamat, 
			data_sertifikat.jenis_faskes
			FROM
			data_sertifikat
			WHERE
			data_sertifikat.kode_faskes = '$KdFaskes'");
	}	
}