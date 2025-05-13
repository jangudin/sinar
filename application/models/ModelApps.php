<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelApps extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get menu and submenu data based on user ID
     * 
     * @param int $user_id User's ID (to filter access)
     * @return array Menu and submenu accessible by the user
     */
   public function getMenuAndSubMenuByUser ($user_id)
{
        $this->db->select('
            apps_menu.id as menu_id,
            apps_menu.nama_menu,
            apps_menu.icon,
            apps_sub_menu.id as sub_id,
            apps_sub_menu.nama_sub_menu
        ');
        $this->db->from('apps_role_akses');
        $this->db->join('apps_menu', 'apps_role_akses.id_apps_menu = apps_menu.id', 'left');
        $this->db->join('apps_sub_menu', 'apps_role_akses.id_apps_sub_menu = apps_sub_menu.id', 'left');
        $this->db->where('apps_role_akses.id_user', $user_id);
        $query = $this->db->get();

        $result = $query->result_array();

        // Grouping
        $menu_data = [];
        foreach ($result as $row) {
            $menu_id = $row['menu_id'];
            if (!isset($menu_data[$menu_id])) {
                $menu_data[$menu_id] = [
                    'nama_menu' => $row['nama_menu'],
                    'icon' => $row['icon'],
                    'sub_menu' => []
                ];
            }

            if (!empty($row['sub_id'])) {
                $menu_data[$menu_id]['sub_menu'][] = $row['nama_sub_menu'];
            }
        }

        return $menu_data;
    }

    function getJabatan($pejabat) 
     {
        $this->db->select('id,jenis');
        $this->db->from('apps_jabatan');
        $this->db->where('id', $pejabat);        
    }
    /**
     * Get all menu data
     * 
     * @return array All menu data
     */
            public function getAllMenu()
            {
                $this->db->select('
            a.*,
            b.status_usulan_id, b.keterangan,
            h.nama AS status_usulan,
            c.nama AS jenis_fasyankes_nama,
            d.nama AS jenis_survei,
            e.nama AS jenis_akreditasi,
            f.nama AS status_akreditasi,
            g.nama AS lpa,
            tf.kode_faskes, tf.id_faskes,
            dk.nama_klinik AS nama_fasyankes,
            dk.id_prov AS provinsi_id,
            pr.id_prop, pr.nama_prop,
            dk.id_kota AS kabkota_id,
            kt.id_kota, kt.nama_kota,
            i.penerimaan_pengajuan_usulan_survei_id,
            i.url_surat_permohonan_survei, i.url_profil_fasyankes, i.url_laporan_hasil_penilaian_mandiri,
            i.url_pps_reakreditasi, i.url_surat_usulan_dinas,
            i.update_dfo, i.update_aspak, i.update_sisdmk, i.update_inm, i.update_ikp,
            i.id AS berkas_usulan_survei_id,
            j.id AS kelengkapan_berkas_id,
            j.kelengkapan_berkas_usulan, j.kelengkapan_berkas_usulan_catatan,
            j.kelengkapan_dfo, j.kelengkapan_dfo_catatan,
            j.kelengkapan_sarpras_alkes, j.kelengkapan_sarpras_alkes_catatan,
            j.kelengkapan_nakes, j.kelengkapan_nakes_catatan,
            j.kelengkapan_laporan_inm, j.kelengkapan_laporan_inm_catatan,
            j.kelengkapan_laporan_ikp, j.kelengkapan_laporan_ikp_catatan,
            k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2,
            k.id AS penetapan_tanggal_survei_id,
            k.url_dokumen_kontrak, k.url_surat_tugas, k.tanggal_survei,
            k.metode_survei_id, k.url_dokumen_pendukung_ep,
            k.surveior_satu, k.status_surveior_satu,
            k.surveior_dua, k.status_surveior_dua,
            l.id AS trans_final_ep_surveior_id,
            l.final AS status_final_ep,
            m.id AS pengiriman_laporan_survei_id,
            m.tanggal_survei_satu, m.tanggal_survei_dua, m.tanggal_survei_tiga,
            m.url_bukti_satu, m.url_bukti_dua, m.url_bukti_tiga,
            n.id AS penetapan_verifikator_id,
            n.users_id AS users_verifikator,
            o.id AS trans_final_ep_verifikator_id,
            o.final AS status_final_ep_verifikator,
            p.id AS pengiriman_rekomendasi_id,
            p.url_surat_rekomendasi_status,
            q.id AS pengajuan_id,
            q.status_rekomendasi_id AS pengajuan_rekomendasi,
            q.catatan_ketua, q.status_persetujuan, q.catatan_terima, q.created_at,
            r.id AS direktur_id,
            r.status_direktur AS direktur,
            r.persetujuan_ketua_id, r.catatan_direktur
        ');

        $this->db->from('db_akreditasi_non_rs.pengajuan_usulan_survei a');
        $this->db->join('db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei b', 'a.id = b.pengajuan_usulan_survei_id', 'left');
        $this->db->join('db_akreditasi_non_rs.jenis_fasyankes c', 'a.jenis_fasyankes = c.id', 'left');
        $this->db->join('db_akreditasi_non_rs.jenis_survei d', 'a.jenis_survei_id = d.id', 'left');
        $this->db->join('db_akreditasi_non_rs.jenis_akreditasi e', 'a.jenis_akreditasi_id = e.id', 'left');
        $this->db->join('db_akreditasi_non_rs.status_akreditasi f', 'a.status_akreditasi_id = f.id', 'left');
        $this->db->join('db_akreditasi_non_rs.lpa g', 'a.lpa_id = g.id', 'left');
        $this->db->join('dbfaskes.trans_final tf', 'a.fasyankes_id = tf.kode_faskes', 'left');
        $this->db->join('dbfaskes.data_klinik dk', 'tf.id_faskes = dk.id_faskes', 'left');
        $this->db->join('dbfaskes.propinsi pr', 'dk.id_prov = pr.id_prop', 'left');
        $this->db->join('dbfaskes.kota kt', 'dk.id_kota = kt.id_kota', 'left');
        $this->db->join('db_akreditasi_non_rs.status_usulan h', 'b.status_usulan_id = h.id', 'left');
        $this->db->join('db_akreditasi_non_rs.berkas_usulan_survei i', 'i.penerimaan_pengajuan_usulan_survei_id = b.id', 'left');
        $this->db->join('db_akreditasi_non_rs.kelengkapan_berkas j', 'j.berkas_usulan_survei_id = i.id', 'left');
        $this->db->join('db_akreditasi_non_rs.penetapan_tanggal_survei k', 'k.kelengkapan_berkas_id = j.id', 'left');
        $this->db->join('db_akreditasi_non_rs.trans_final_ep_surveior l', 'l.penetapan_tanggal_survei_id = k.id', 'left');
        $this->db->join('db_akreditasi_non_rs.pengiriman_laporan_survei m', 'm.penetapan_tanggal_survei_id = k.id', 'left');
        $this->db->join('db_akreditasi_non_rs.penetapan_verifikator n', 'n.pengiriman_laporan_survei_id = m.id', 'left');
        $this->db->join('db_akreditasi_non_rs.trans_final_ep_verifikator o', 'o.penetapan_verifikator_id = n.id', 'left');
        $this->db->join('db_akreditasi_non_rs.pengiriman_rekomendasi p', 'p.trans_final_ep_verifikator_id = o.id', 'inner');
        $this->db->join('db_akreditasi_non_rs.persetujuan_ketua q', 'q.pengiriman_rekomendasi_id = p.id', 'left');
        $this->db->join('db_akreditasi_non_rs.persetujuan_direktur r', 'r.persetujuan_ketua_id = q.id', 'left');
        $this->db->join('db_akreditasi_non_rs.data_sertifikat s', 'r.id = s.persetujuan_direktur_id', 'left');
        $this->db->join('db_akreditasi_non_rs.tte_lpa t', 's.id = t.data_sertifikat_id', 'left');
        $this->db->join('db_akreditasi_non_rs.tte_dirjen u', 't.id = u.tte_lpa_id', 'left');

        $this->db->where('c.nama', 'Klinik');
        $this->db->where('dk.jenis_klinik', 'Utama');
        $this->db->order_by('q.created_at', 'ASC');

        $query = $this->db->get();
        return $query->result();

    }

}
