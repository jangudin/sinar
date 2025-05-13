<?php 
 
class M_login extends CI_Model{	
	function cek_login($u,$p){		
		$hasil=$this->db->query("SELECT
										pengguna.id,
										pengguna.nama,
										pengguna.email,
										pengguna.password_,
										pengguna.pejabat_sertifikat_id,
										pengguna.created_at,
										pengguna.modified_at,
										pengguna.password,
										pejabat_sertifikat.nik,
										pejabat_sertifikat.nama,
										pejabat_sertifikat.email,
										pejabat_sertifikat.lembaga_akreditasi_id,
										pejabat_sertifikat.jabatan_sertifikat_id,
										pengguna.jabatan,
									FROM
										pengguna
										INNER JOIN pejabat_sertifikat ON pengguna.pejabat_sertifikat_id = pejabat_sertifikat.id
									WHERE
										db_akreditasi.pengguna.email = '$u'
										AND db_akreditasi.pengguna.`password` =md5('$p')");
		// echo $this->db->last_query();
        return $hasil;

        // $this->db->where('email', $u)->or_where('password', md5('$p'));
		// $query = $this->db->get('pengguna');
		// $user = $query->num_rows();
		//echo json_encode($user);
	}	
}
