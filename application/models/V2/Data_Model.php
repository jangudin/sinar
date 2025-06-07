<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Model extends CI_Model { // Match the filename case
    
    public function get_belum_tte($lem_id = null, $limit = 10, $offset = 0) {
        // Validate lembaga_id
        if (!$lem_id || !is_numeric($lem_id)) {
            log_message('error', 'Invalid lembaga_id: ' . var_export($lem_id, true));
            throw new Exception('Invalid Lembaga ID');
        }

        // Use Query Builder instead of raw SQL for better security
        $this->db->select('
            r.id,
            r.no_sertifikat,
            ps.kode_rs AS kodeRS,
            d.RUMAH_SAKIT AS namaRS,
            COALESCE(sp.lembaga, "0") as lembaga,
            COALESCE(sp.mutu, "0") as mutu,
            COALESCE(sp.dirjen, "0") as dirjen
        ', FALSE);

        $this->db->from('db_akreditasi.rekomendasi r');
        $this->db->join('db_akreditasi.survei s', 's.id = r.survei_id', 'inner');
        $this->db->join('db_akreditasi.pengajuan_survei ps', 'ps.id = s.pengajuan_survei_id', 'inner');
        $this->db->join('db_fasyankes.data d', 'd.Propinsi = ps.kode_rs', 'inner');
        $this->db->join('db_akreditasi.Sertifikat_progres1 sp', 'r.id = sp.id_rekomendasi', 'left');

        // Add WHERE conditions
        $where = [
            'ps.lembaga_akreditasi_id' => $lem_id,
            'r.tanggal_terbit_sertifikat IS NOT NULL' => NULL,
            'r.tanggal_kadaluarsa_sertifikat IS NOT NULL' => NULL
        ];
        $this->db->where($where);
        $this->db->where('r.tanggal_surat_pengajuan_sertifikat >', '2022-12-08');
        $this->db->where('(sp.lembaga IS NULL OR sp.lembaga = "0")');

        // Get total rows before adding limit
        $total_rows = $this->db->get()->num_rows();

        // Clone the query for data with limit
        $this->db->limit($limit, $offset);
        $this->db->order_by('r.tanggal_terbit_sertifikat', 'DESC');
        
        $query = $this->db->get();
        
        // Debug information
        log_message('debug', 'Last Query: ' . $this->db->last_query());
        log_message('debug', 'Total Rows: ' . $total_rows);
        log_message('debug', 'Results: ' . $query->num_rows());

        return [
            'data' => $query->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }

    public function get_sudah_tte($lem_id = null, $limit = 10, $offset = 0) {
        // Similar structure but for completed TTE
        if (!$lem_id || !is_numeric($lem_id)) {
            log_message('error', 'Invalid lembaga_id: ' . var_export($lem_id, true));
            throw new Exception('Invalid Lembaga ID');
        }

        $this->db->select('
            r.id,
            r.no_sertifikat,
            ps.kode_rs AS kodeRS,
            d.RUMAH_SAKIT AS namaRS,
            sp.lembaga,
            sp.mutu,
            sp.dirjen,
            sp.tgl_dibuat_dirjen
        ', FALSE);

        $this->db->from('db_akreditasi.rekomendasi r');
        $this->db->join('db_akreditasi.survei s', 's.id = r.survei_id', 'inner');
        $this->db->join('db_akreditasi.pengajuan_survei ps', 'ps.id = s.pengajuan_survei_id', 'inner');
        $this->db->join('db_fasyankes.data d', 'd.Propinsi = ps.kode_rs', 'inner');
        $this->db->join('db_akreditasi.Sertifikat_progres1 sp', 'r.id = sp.id_rekomendasi', 'inner');

        // Add WHERE conditions for completed TTE
        $where = [
            'ps.lembaga_akreditasi_id' => $lem_id,
            'sp.lembaga' => '1',
            'sp.mutu' => '1',
            'sp.dirjen' => '1'
        ];
        $this->db->where($where);

        // Get total rows before adding limit
        $total_rows = $this->db->get()->num_rows();

        // Clone the query for data with limit
        $this->db->limit($limit, $offset);
        $this->db->order_by('sp.tgl_dibuat_dirjen', 'DESC');
        
        $query = $this->db->get();
        
        // Debug information
        log_message('debug', 'Last Query: ' . $this->db->last_query());
        log_message('debug', 'Total Rows: ' . $total_rows);
        log_message('debug', 'Results: ' . $query->num_rows());

        return [
            'data' => $query->result(),
            'total_rows' => $total_rows,
            'per_page' => $limit
        ];
    }
}