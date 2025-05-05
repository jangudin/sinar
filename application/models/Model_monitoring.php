<?php 
 
class Model_monitoring extends CI_Model{	
	function daftar_rs(){		
	$hasil=$this->db->query(" SELECT
									db_akreditasi.rekomendasi.id,
									db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
									db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
									db_akreditasi.Sertifikat_progres1.tgl_dibuat_lembaga AS tte_lembaga,
									db_akreditasi.Sertifikat_progres1.lembaga,
									db_akreditasi.Sertifikat_progres1.mutu,
									db_akreditasi.Sertifikat_progres1.dirjen,
									db_fasyankes.`data`.Propinsi,
									db_akreditasi.capaian_akreditasi.nama,
									db_akreditasi.Sertifikat_progres1.sertifikat_2 
								FROM
									db_akreditasi.rekomendasi
									INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
									INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
									INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
									LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi
									INNER JOIN db_akreditasi.capaian_akreditasi ON db_akreditasi.rekomendasi.capaian_akreditasi_id = db_akreditasi.capaian_akreditasi.id 
								ORDER BY
									db_akreditasi.Sertifikat_progres1.dirjen DESC");
			return $hasil;
	}
	function jumlahrekomendasi()
	{
		return $this->db->query("SELECT
											COUNT(db_akreditasi.rekomendasi.id) AS jumlah_rek
										FROM
											db_akreditasi.rekomendasi
											INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
											INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
											INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
											LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi
										ORDER BY db_akreditasi.Sertifikat_progres1.dirjen DESC")->result();
	}

		function jumlahlembaga()
	{
		return $this->db->query("SELECT
									db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
									COUNT(db_akreditasi.rekomendasi.id) jumlah
								FROM
									db_akreditasi.rekomendasi
									INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
									INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
									INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
									LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi
								GROUP BY
									db_akreditasi.pengajuan_survei.lembaga_akreditasi_id
								ORDER BY 
									db_akreditasi.pengajuan_survei.lembaga_akreditasi_id DESC")->result();
	}

	function dikerjakanlem()
	{
		return $this->db->query("SELECT
									count(db_akreditasi.rekomendasi.id) lembaga
								FROM
									db_akreditasi.rekomendasi
									INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
									INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
									INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
									LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi
								WHERE 
									db_akreditasi.Sertifikat_progres1.lembaga = 1
								ORDER BY db_akreditasi.Sertifikat_progres1.dirjen DESC")->result();
	}

	function dikerjakanmutu()
	{
		return $this->db->query("SELECT
									count(db_akreditasi.rekomendasi.id) mutu
								FROM
									db_akreditasi.rekomendasi
									INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
									INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
									INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
									LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi
								WHERE 
									db_akreditasi.Sertifikat_progres1.mutu = 1
								ORDER BY db_akreditasi.Sertifikat_progres1.dirjen DESC")->result();
	}

	function dikerjakandirjen()
	{
		return $this->db->query("SELECT
									count(db_akreditasi.rekomendasi.id) dirjen
								FROM
									db_akreditasi.rekomendasi
									INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
									INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
									INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
									LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi
								WHERE 
									db_akreditasi.Sertifikat_progres1.dirjen = 1
								ORDER BY db_akreditasi.Sertifikat_progres1.dirjen DESC")->result();
	}
}
