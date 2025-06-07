<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Model extends CI_Model { // Match the filename case
    
    public function get_belum_tte($lem_id = null) {
        $sql = "SELECT
            r.id,
            r.no_sertifikat,
            ps.kode_rs AS kodeRS,
            d.RUMAH_SAKIT AS namaRS,
            ps.lembaga_akreditasi_id AS lembagaAkreditasiId,
            sp.id as IdProgres,
            sp.id_rekomendasi,
            sp.lembaga,
            sp.mutu,
            sp.keterangan,
            sp.dirjen
        FROM
            db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` d ON d.Propinsi = ps.kode_rs
            LEFT JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
        WHERE
            ps.lembaga_akreditasi_id = ?
            AND (sp.lembaga IS NULL OR sp.mutu IS NULL OR sp.dirjen IS NULL)
            AND r.tanggal_terbit_sertifikat IS NOT NULL
            AND r.tanggal_kadaluarsa_sertifikat IS NOT NULL
        ORDER BY 
            r.tanggal_terbit_sertifikat DESC";
            
        return $this->db->query($sql, array($lem_id))->result();
    }
    
    public function get_sudah_tte($lem_id = null) {
        $sql = "SELECT
            r.id,
            r.no_sertifikat,
            ps.kode_rs AS kodeRS,
            d.RUMAH_SAKIT AS namaRS,
            ps.lembaga_akreditasi_id AS lembagaAkreditasiId,
            sp.id as IdProgres,
            sp.id_rekomendasi,
            sp.lembaga,
            sp.mutu,
            sp.keterangan,
            sp.dirjen,
            sp.tgl_dibuat_lembaga,
            sp.tgl_dibuat_mutu,
            sp.tgl_dibuat_dirjen
        FROM
            db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` d ON d.Propinsi = ps.kode_rs
            LEFT JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi 
        WHERE
            ps.lembaga_akreditasi_id = ?
            AND sp.lembaga = '1'
            AND sp.mutu = '1'
            AND sp.dirjen = '1'
        ORDER BY 
            sp.tgl_dibuat_dirjen DESC";
            
    return $this->db->query($sql, array($lem_id))->result();
}
}