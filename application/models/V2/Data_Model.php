<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Model extends CI_Model { // Match the filename case
    
    public function get_belum_tte($lem_id = null, $limit = 10, $offset = 0) {
        if (!$lem_id) {
            throw new Exception('Lembaga ID is required');
        }

        // Cast parameters
        $lem_id = (int)$lem_id;
        $limit = (int)$limit;
        $offset = (int)$offset;

        // Debug query parameters
        log_message('debug', 'Query parameters: lem_id=' . $lem_id);

        // Count query with explicit JOIN conditions
        $count_sql = "SELECT COUNT(*) as total
        FROM db_akreditasi.rekomendasi r
        INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
        INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
        LEFT JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
        WHERE ps.lembaga_akreditasi_id = $lem_id
        AND r.tanggal_surat_pengajuan_sertifikat > '2022-12-08'
        AND (sp.lembaga IS NULL OR sp.lembaga = '0')
        AND r.tanggal_terbit_sertifikat IS NOT NULL 
        AND r.tanggal_kadaluarsa_sertifikat IS NOT NULL";

        $total_rows = $this->db->query($count_sql)->row()->total;

        // Main query with debugging
        $sql = "SELECT DISTINCT
            r.id,
            r.no_sertifikat,
            ps.kode_rs AS kodeRS,
            d.RUMAH_SAKIT AS namaRS,
            ps.lembaga_akreditasi_id AS lembagaAkreditasiId,
            sp.id as IdProgres,
            sp.id_rekomendasi,
            COALESCE(sp.lembaga, '0') as lembaga,
            COALESCE(sp.mutu, '0') as mutu,
            COALESCE(sp.dirjen, '0') as dirjen
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

        // Debug final query
        $query = $this->db->query($sql, [$lem_id, $limit, $offset]);
        log_message('debug', 'Final query: ' . $this->db->last_query());

        return [
            'data' => $query->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }
    
    public function get_sudah_tte($lem_id = null, $limit = 10, $offset = 0) {
        // Cast parameters to integers
        $limit = (int)$limit;
        $offset = (int)$offset;
        
        // Count total rows first
        $count_sql = "SELECT COUNT(*) as total
        FROM db_akreditasi.rekomendasi r
        INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
        INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
        LEFT JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
        WHERE ps.lembaga_akreditasi_id = ?
        AND sp.lembaga = '1'
        AND sp.mutu = '1'
        AND sp.dirjen = '1'";
        
        $total_rows = $this->db->query($count_sql, array($lem_id))->row()->total;

        // Main query with limit and offset
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
            sp.tgl_dibuat_dirjen DESC
        LIMIT ? OFFSET ?";
            
        // Use consistent parameter binding
        $result = $this->db->query($sql, [(int)$lem_id, (int)$limit, (int)$offset]);
        
        return [
            'data' => $result->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }
}