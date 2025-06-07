<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Model extends CI_Model { // Match the filename case
    
    public function get_belum_tte($lem_id = null) {
        $sql = "SELECT
            db_akreditasi.rekomendasi.id,
            db_akreditasi.rekomendasi.no_sertifikat,
            db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
            db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
            db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
            db_akreditasi.Sertifikat_progres1.lembaga,
            db_akreditasi.Sertifikat_progres1.mutu,
            db_akreditasi.Sertifikat_progres1.keterangan,
            db_akreditasi.Sertifikat_progres1.dirjen,
            db_akreditasi.sertifikasi.rekomendasi_id 
        FROM
            db_akreditasi.rekomendasi
            LEFT JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
            LEFT JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
            LEFT JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
            LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi
            LEFT JOIN db_akreditasi.sertifikasi ON db_akreditasi.rekomendasi.id = db_akreditasi.sertifikasi.rekomendasi_id 
        WHERE
            lembaga_akreditasi_id = ? 
            AND rekomendasi.tanggal_surat_pengajuan_sertifikat > '2022-12-08'
            AND db_akreditasi.Sertifikat_progres1.lembaga IS NULL
            AND rekomendasi.tanggal_terbit_sertifikat IS NOT NULL 
            AND rekomendasi.tanggal_kadaluarsa_sertifikat IS NOT NULL";
            
        $query = $this->db->query($sql, array($lem_id));
        return $query->result();
    }
}