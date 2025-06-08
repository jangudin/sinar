<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Model extends CI_Model { // Match the filename case
    
    public function get_belum_tte($lem_id = null, $limit = 10, $offset = 0) {
        // Cast parameters to integers
        $lem_id = (int)$lem_id;
        $limit = (int)$limit;
        $offset = (int)$offset;

        // Get total count first with a separate query
        $count_sql = "SELECT COUNT(DISTINCT r.id) as total 
            FROM db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            LEFT JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
            WHERE ps.lembaga_akreditasi_id = ?
            AND r.tanggal_surat_pengajuan_sertifikat > '2022-12-08'
            AND (sp.lembaga IS NULL OR sp.lembaga = '0')";

        $total_rows = $this->db->query($count_sql, [$lem_id])->row()->total;

        // Main query for data
        $sql = "SELECT DISTINCT
            r.id,
            r.no_sertifikat,
            ps.kode_rs AS kodeRS,
            d.RUMAH_SAKIT AS namaRS,
            ps.lembaga_akreditasi_id,
            COALESCE(sp.id, 0) as IdProgres,
            COALESCE(sp.id_rekomendasi, 0) as id_rekomendasi,
            COALESCE(sp.lembaga, '0') as lembaga,
            COALESCE(sp.mutu, '0') as mutu,
            COALESCE(sp.dirjen, '0') as dirjen,
            COALESCE(sp.keterangan, '') as keterangan,
            DATE_FORMAT(r.tanggal_terbit_sertifikat, '%d-%m-%Y') as tgl_terbit,
            DATE_FORMAT(r.tanggal_kadaluarsa_sertifikat, '%d-%m-%Y') as tgl_kadaluarsa
        FROM db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` d ON d.Propinsi = ps.kode_rs
            LEFT JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
        WHERE ps.lembaga_akreditasi_id = ?
            AND r.tanggal_surat_pengajuan_sertifikat > '2022-12-08'
            AND (sp.lembaga IS NULL OR sp.lembaga = '0')
            AND r.tanggal_terbit_sertifikat IS NOT NULL 
            AND r.tanggal_kadaluarsa_sertifikat IS NOT NULL
        ORDER BY r.tanggal_terbit_sertifikat DESC
        LIMIT ? OFFSET ?";

        // Execute the main query
        $result = $this->db->query($sql, [$lem_id, $limit, $offset]);

        return [
            'data' => $result->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }

    public function get_sudah_tte($lem_id = null, $limit = 10, $offset = 0) {
        // Cast parameters
        $lem_id = (int)$lem_id;
        $limit = (int)$limit;
        $offset = (int)$offset;

        // Main query for completed TTE
        $sql = "SELECT DISTINCT
            r.id,
            r.no_sertifikat,
            ps.kode_rs AS kodeRS,
            d.RUMAH_SAKIT AS namaRS,
            ps.lembaga_akreditasi_id,
            sp.id as IdProgres,
            sp.id_rekomendasi,
            sp.lembaga,
            sp.mutu,
            sp.dirjen,
            DATE_FORMAT(sp.tgl_dibuat_lembaga, '%d-%m-%Y') as tgl_lembaga,
            DATE_FORMAT(sp.tgl_dibuat_mutu, '%d-%m-%Y') as tgl_mutu,
            DATE_FORMAT(sp.tgl_dibuat_dirjen, '%d-%m-%Y') as tgl_dirjen,
            DATE_FORMAT(r.tanggal_terbit_sertifikat, '%d-%m-%Y') as tgl_terbit,
            DATE_FORMAT(r.tanggal_kadaluarsa_sertifikat, '%d-%m-%Y') as tgl_kadaluarsa
        FROM
            db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` d ON d.Propinsi = ps.kode_rs
            INNER JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
        WHERE
            ps.lembaga_akreditasi_id = ?
            AND sp.lembaga = '1'
            AND sp.mutu = '1'
            AND sp.dirjen = '1'
        ORDER BY 
            sp.tgl_dibuat_dirjen DESC
        LIMIT ? OFFSET ?";

        // Get total rows count
        $count_sql = str_replace('SELECT DISTINCT', 'SELECT COUNT(DISTINCT r.id) as total', 
                               substr($sql, 0, strpos($sql, 'ORDER BY')));
        
        $total_rows = $this->db->query($count_sql, [$lem_id])->row()->total;
        $result = $this->db->query($sql, [$lem_id, $limit, $offset]);

        return [
            'data' => $result->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }
}