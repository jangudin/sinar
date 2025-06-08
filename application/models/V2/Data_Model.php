<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Model extends CI_Model { // Match the filename case
    
    public function get_belum_tte($lem_id = null, $limit = 10, $offset = 0, $search = '') {
        if (empty($lem_id)) {
            throw new Exception('Lembaga ID is required');
        }

        $limit = (int)$limit;
        $offset = (int)$offset;
        
        // Base WHERE conditions
        $where = "WHERE ps.lembaga_akreditasi_id = ?
            AND r.tanggal_surat_pengajuan_sertifikat > '2022-12-08'
            AND (sp.lembaga IS NULL OR sp.lembaga = '0')
            AND r.tanggal_terbit_sertifikat IS NOT NULL 
            AND r.tanggal_kadaluarsa_sertifikat IS NOT NULL";
        
        // Add search condition if search term exists
        $params = [$lem_id];
        if (!empty($search)) {
            $where .= " AND (r.no_sertifikat LIKE ? OR ps.kode_rs LIKE ? OR d.RUMAH_SAKIT LIKE ?)";
            $search_param = "%{$search}%";
            $params = array_merge($params, [$search_param, $search_param, $search_param]);
        }

        // Count query
        $count_sql = "SELECT COUNT(DISTINCT r.id) as total 
            FROM db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` d ON d.Propinsi = ps.kode_rs
            LEFT JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
            $where";

        $total_rows = $this->db->query($count_sql, $params)->row()->total;

        // Main query
        $sql = "SELECT 
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
        $where
        ORDER BY r.tanggal_terbit_sertifikat DESC
        LIMIT ? OFFSET ?";

        // Add limit and offset to params
        $params[] = $limit;
        $params[] = $offset;

        $result = $this->db->query($sql, $params);

        return [
            'data' => $result->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }

    public function get_sudah_tte($lem_id = null, $limit = 10, $offset = 0, $search = '') {
        if (empty($lem_id)) {
            throw new Exception('Lembaga ID is required');
        }

        $limit = (int)$limit;
        $offset = (int)$offset;

        // Base WHERE conditions
        $where = "WHERE ps.lembaga_akreditasi_id = ?
            AND sp.lembaga = '1'
            AND sp.mutu = '1'
            AND sp.dirjen = '1'
            AND r.tanggal_terbit_sertifikat IS NOT NULL 
            AND r.tanggal_kadaluarsa_sertifikat IS NOT NULL
            AND r.tanggal_surat_pengajuan_sertifikat > '2022-12-08'";

        // Add search condition if search term exists
        $params = [$lem_id];
        if (!empty($search)) {
            $where .= " AND (r.no_sertifikat LIKE ? OR ps.kode_rs LIKE ? OR d.RUMAH_SAKIT LIKE ?)";
            $search_param = "%{$search}%";
            $params = array_merge($params, [$search_param, $search_param, $search_param]);
        }

        // Count query
        $count_sql = "SELECT COUNT(DISTINCT r.id) as total 
            FROM db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` d ON d.Propinsi = ps.kode_rs
            INNER JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
            $where";

        $total_rows = $this->db->query($count_sql, $params)->row()->total;

        // Main query
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
        FROM db_akreditasi.rekomendasi r
            INNER JOIN db_akreditasi.survei s ON s.id = r.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ps ON ps.id = s.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` d ON d.Propinsi = ps.kode_rs
            INNER JOIN db_akreditasi.Sertifikat_progres1 sp ON r.id = sp.id_rekomendasi
        $where
        ORDER BY sp.tgl_dibuat_dirjen DESC
        LIMIT ? OFFSET ?";

        $params[] = $limit;
        $params[] = $offset;

        $result = $this->db->query($sql, $params);

        return [
            'data' => $result->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }
}