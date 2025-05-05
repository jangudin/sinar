<?php
class M_profile extends CI_Model{

	function data_profile($id){
		$hsl=$this->db->query("
                                        SELECT
                                                pengguna.nama,
                                                pengguna.email,
                                                pejabat_sertifikat.lembaga_akreditasi_id,
                                                pejabat_sertifikat.nik,
                                                pengguna.password_,
                                                pengguna.`password`,
                                                lembaga_akreditasi.nama AS nama_lembaga
                                        FROM
                                                pengguna
                                                LEFT JOIN pejabat_sertifikat ON pengguna.pejabat_sertifikat_id = pejabat_sertifikat.id
                                                LEFT JOIN lembaga_akreditasi ON pejabat_sertifikat.lembaga_akreditasi_id = lembaga_akreditasi.id 
                                        WHERE
                                                pengguna.id = '$id'");
                                                return $hsl->result();
                                	}
                                }