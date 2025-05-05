<?php 

class M_home extends CI_Model{	
	function select_data($table,$where){		
		return $this->db->get_where($table,$where);
	}

	function get_data($table){

		$this->db->like('id_pengajuan', $keyword);
		$this->db->or_like('kode_faskes', $keyword);
		$this->db->or_like('nama_faskes', $keyword);

    $result = $this->sina->get($table)->result(); // Tampilkan data siswa berdasarkan keyword
    
    return $result; 
}



}