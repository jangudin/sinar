<?php
class New_progres extends CI_Model{

	public function ceklpatte($cek)
	{
		if ($cek == 'Belum') {

			$hsl=$this->sina->query("
			SELECT
			a.kode_faskes,
			a.nama_faskes,
			b.id as lpa,
			c.id  as dirjen,
			c.url_sertifikat,
			a.lpa AS nmlpa
			FROM
			db_akreditasi_non_rs.data_sertifikat a
			LEFT JOIN db_akreditasi_non_rs.tte_lpa b ON a.id = db_akreditasi_non_rs.b.data_sertifikat_id
			LEFT JOIN db_akreditasi_non_rs.tte_dirjen c ON b.id = c.tte_lpa_id
			WHERE 
			b.id IS NULL");

		}elseif($cek == 'Sudah'){

			$hsl=$this->sina->query("
			SELECT
			a.kode_faskes,
			a.nama_faskes,
			b.id as lpa,
			c.id  as dirjen,
			c.url_sertifikat,
			a.lpa AS nmlpa
			FROM
			db_akreditasi_non_rs.data_sertifikat a
			LEFT JOIN db_akreditasi_non_rs.tte_lpa b ON a.id = db_akreditasi_non_rs.b.data_sertifikat_id
			LEFT JOIN db_akreditasi_non_rs.tte_dirjen c ON b.id = c.tte_lpa_id
			WHERE 
			b.id IS NOT NULL");

		}
		
		return $hsl->result();
	}


	public function cekdirjentte($cek)
	{
		if ($cek == 'Belum') {

			$hsl=$this->sina->query("
			SELECT
			a.kode_faskes,
			a.nama_faskes,
			b.id as lpa,
			c.id  as dirjen,
			c.url_sertifikat,
			a.lpa AS nmlpa
			FROM
			db_akreditasi_non_rs.data_sertifikat a
			LEFT JOIN db_akreditasi_non_rs.tte_lpa b ON a.id = db_akreditasi_non_rs.b.data_sertifikat_id
			LEFT JOIN db_akreditasi_non_rs.tte_dirjen c ON b.id = c.tte_lpa_id
			WHERE 
			b.id IS NOT NULL
			AND c.id IS NULL");

		}elseif($cek == 'Sudah'){

			$hsl=$this->sina->query("
			SELECT
			a.kode_faskes,
			a.nama_faskes,
			b.id as lpa,
			c.id  as dirjen,
			c.url_sertifikat,
			a.lpa AS nmlpa
			FROM
			db_akreditasi_non_rs.data_sertifikat a
			LEFT JOIN db_akreditasi_non_rs.tte_lpa b ON a.id = db_akreditasi_non_rs.b.data_sertifikat_id
			LEFT JOIN db_akreditasi_non_rs.tte_dirjen c ON b.id = c.tte_lpa_id
			WHERE 
			b.id IS NOT NULL
			AND c.id IS NOT NULL");

		}
		
		return $hsl->result();
	}


	public function lpacekdirjentte($cek,$lpa)
	{
		if ($cek == 'Belum') {

			$hsl=$this->sina->query("
			SELECT
			a.kode_faskes,
			a.nama_faskes,
			b.id as lpa,
			c.id  as dirjen,
			c.url_sertifikat,
			a.lpa AS nmlpa
			FROM
			db_akreditasi_non_rs.data_sertifikat a
			LEFT JOIN db_akreditasi_non_rs.tte_lpa b ON a.id = db_akreditasi_non_rs.b.data_sertifikat_id
			LEFT JOIN db_akreditasi_non_rs.tte_dirjen c ON b.id = c.tte_lpa_id
			WHERE 
			b.id IS NOT NULL
			AND c.id IS NULL
			AND a.lpa = '$lpa'");

		}elseif($cek == 'Sudah'){

			$hsl=$this->sina->query("
			SELECT
			a.kode_faskes,
			a.nama_faskes,
			b.id as lpa,
			c.id  as dirjen,
			c.url_sertifikat,
			a.lpa AS nmlpa
			FROM
			db_akreditasi_non_rs.data_sertifikat a
			LEFT JOIN db_akreditasi_non_rs.tte_lpa b ON a.id = db_akreditasi_non_rs.b.data_sertifikat_id
			LEFT JOIN db_akreditasi_non_rs.tte_dirjen c ON b.id = c.tte_lpa_id
			WHERE 
			b.id IS NOT NULL
			AND c.id IS NOT NULL
			AND a.lpa = '$lpa'");

		}
		
		return $hsl->result();
	}

}