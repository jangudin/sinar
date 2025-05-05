<?php
class M_task extends CI_Model{


        public function get_puskesmas($nama_fasyankes,$fasyankes_id) {
        // Query untuk mengambil data Puskesmas
                $query = "
                SELECT
                b.status_usulan_id,
                b.keterangan,
                h.nama AS status_usulan,
                c.nama AS jenis_fasyankes_nama,
                d.nama AS jenis_survei,
                e.nama AS jenis_akreditasi,
                f.nama AS status_akreditasi,
                g.nama AS lpa,
                a.fasyankes_id,
                puskesmas_pusdatin.id AS idpp,
                puskesmas_pusdatin.name AS nama_fasyankes,
                puskesmas_pusdatin.provinsi_code AS provinsi_id,
                puskesmas_pusdatin.provinsi_nama AS nama_prop,
                puskesmas_pusdatin.kabkot_code AS kabkota_id,
                puskesmas_pusdatin.kabkot_nama AS nama_kota,
                puskesmas_pusdatin.kecamatan_nama AS nama_kecamatan,
                puskesmas_pusdatin.alamat,
                puskesmas_pusdatin.alamat_sertifikat,
                puskesmas_pusdatin.kode_baru,
                i.penerimaan_pengajuan_usulan_survei_id,
                i.url_surat_permohonan_survei,
                i.url_profil_fasyankes,
                i.url_laporan_hasil_penilaian_mandiri,
                i.url_pps_reakreditasi,
                i.url_surat_usulan_dinas,
                i.update_dfo,
                i.update_aspak,
                i.update_sisdmk,
                i.update_inm,
                i.update_ikp,
                i.id AS berkas_usulan_survei_id,
                j.id AS kelengkapan_berkas_id,
                j.kelengkapan_berkas_usulan,
                j.kelengkapan_berkas_usulan_catatan,
                j.kelengkapan_dfo,
                j.kelengkapan_dfo_catatan,
                j.kelengkapan_sarpras_alkes,
                j.kelengkapan_sarpras_alkes_catatan,
                j.kelengkapan_nakes,
                j.kelengkapan_nakes_catatan,
                j.kelengkapan_laporan_inm,
                j.kelengkapan_laporan_inm_catatan,
                j.kelengkapan_laporan_ikp,
                j.kelengkapan_laporan_ikp_catatan,
                k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2,
                k.id AS penetapan_tanggal_survei_id,
                k.url_dokumen_kontrak,
                k.url_surat_tugas,
                k.tanggal_survei,
                k.metode_survei_id,
                k.url_dokumen_pendukung_ep,
                k.surveior_satu,
                k.status_surveior_satu,
                k.surveior_dua,
                k.status_surveior_dua,
                l.id AS trans_final_ep_surveior_id,
                l.final AS status_final_ep,
                m.id AS pengiriman_laporan_survei_id,
                m.tanggal_survei_satu,
                m.tanggal_survei_dua,
                m.tanggal_survei_tiga,
                m.url_bukti_satu,
                m.url_bukti_dua,
                m.url_bukti_tiga,
                n.id AS penetapan_verifikator_id,
                n.users_id AS users_verifikator,
                o.id AS trans_final_ep_verifikator_id,
                o.final AS status_final_ep_verifikator,
                p.id AS pengiriman_rekomendasi_id,
                p.url_surat_rekomendasi_status,
                q.id AS pengajuan_id,
                q.status_rekomendasi_id AS pengajuan_rekomendasi,
                q.catatan_ketua,
                q.status_persetujuan,
                q.catatan_terima,
                q.created_at,
                r.id AS direktur_id,
                r.status_direktur AS direktur,
                r.persetujuan_ketua_id,
                r.catatan_direktur,
                db_akreditasi_non_rs.tte_lpa.id,
                db_akreditasi_non_rs.tte_dirjen.id,
                db_akreditasi_non_rs.data_sertifikat.id AS dsid,
                db_akreditasi_non_rs.data_sertifikat.id_pengajuan
                FROM
                pengajuan_usulan_survei a
                LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
                LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
                LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
                LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
                LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
                LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
                LEFT OUTER JOIN dbfaskes.puskesmas_pusdatin ON a.fasyankes_id = puskesmas_pusdatin.kode_sarana
                LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
                LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
                LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
                LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
                LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
                LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
                LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
                LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
                INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
                LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
                LEFT JOIN db_akreditasi_non_rs.data_sertifikat ON r.id = db_akreditasi_non_rs.data_sertifikat.persetujuan_direktur_id
                LEFT JOIN db_akreditasi_non_rs.tte_lpa ON db_akreditasi_non_rs.data_sertifikat.id = db_akreditasi_non_rs.tte_lpa.data_sertifikat_id
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen ON db_akreditasi_non_rs.tte_lpa.id = db_akreditasi_non_rs.tte_dirjen.tte_lpa_id
                WHERE
                1 = 1 
                AND b.status_usulan_id = 3 
                AND c.nama = 'Pusat Kesehatan Masyarakat'";
                        // Tambahkan kondisi berdasarkan input
                if ($nama_fasyankes == null) {
                    $query .= " AND a.fasyankes_id = '$fasyankes_id' ";
            } else {
                    $query .= " AND puskesmas_pusdatin.name = '$nama_fasyankes' ";
            }
            $query .= " ORDER BY q.created_at DESC
                        LIMIT 1";
            $result = $this->sina->query($query);
            return $result->result_array();
    }

    public function update_fasyankes($fasyankes_id, $data)
    {
        // Update data berdasarkan fasyankes_id
        $this->dbfaskes->where('id', $fasyankes_id);
        return $this->dbfaskes->update('puskesmas_pusdatin', $data); // Ganti dengan nama tabel Anda
}

    public function update_ds($dsid, $datads)
    {
        // Update data berdasarkan fasyankes_id
        $this->dbfaskes->where('id', $dsid);
        return $this->sina->update('data_sertifikat', $datads); // Ganti dengan nama tabel Anda
}



function vendor(){
  $hsl=$this->dbfaskes->query("SELECT * FROM sim_pengembang ORDER BY dtoId DESC");
  return $hsl->result();
}

function Puskesmas(){
        $hsl=$this->dbfaskes->query("SELECT * FROM puskesmas_pusdatin");
        return $hsl->result();
}

public function perbaikan($faskes)
{
        $puskesmas=$this->sina->query("SELECT
                a.*,
                b.status_usulan_id,
                b.keterangan,
                h.nama AS status_usulan,
                c.nama AS jenis_fasyankes_nama,
                d.nama AS jenis_survei,
                e.nama AS jenis_akreditasi,
                f.nama AS status_akreditasi,
                g.nama AS lpa,
                puskesmas_pusdatin.name AS nama_fasyankes,
                puskesmas_pusdatin.alamat_sertifikat AS alamat,
                puskesmas_pusdatin.provinsi_code AS provinsi_id,
                puskesmas_pusdatin.provinsi_nama AS nama_prop,
                puskesmas_pusdatin.kabkot_code AS kabkota_id,
                puskesmas_pusdatin.kabkot_nama AS nama_kota,
                puskesmas_pusdatin.kecamatan_nama AS kecamatan,
                i.penerimaan_pengajuan_usulan_survei_id,
                i.url_surat_permohonan_survei,
                i.url_profil_fasyankes,
                i.url_laporan_hasil_penilaian_mandiri,
                i.url_pps_reakreditasi,
                i.url_surat_usulan_dinas,
                i.update_dfo,
                i.update_aspak,
                i.update_sisdmk,
                i.update_inm,
                i.update_ikp,
                i.id AS berkas_usulan_survei_id,
                j.id AS kelengkapan_berkas_id,
                j.kelengkapan_berkas_usulan,
                j.kelengkapan_berkas_usulan_catatan,
                j.kelengkapan_dfo,
                j.kelengkapan_dfo_catatan,
                j.kelengkapan_sarpras_alkes,
                j.kelengkapan_sarpras_alkes_catatan,
                j.kelengkapan_nakes,
                j.kelengkapan_nakes_catatan,
                j.kelengkapan_laporan_inm,
                j.kelengkapan_laporan_inm_catatan,
                j.kelengkapan_laporan_ikp,
                j.kelengkapan_laporan_ikp_catatan,
                k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2,
                k.id AS penetapan_tanggal_survei_id,
                k.url_dokumen_kontrak,
                k.url_surat_tugas,
                k.tanggal_survei,
                k.metode_survei_id,
                k.url_dokumen_pendukung_ep,
                k.surveior_satu,
                k.status_surveior_satu,
                k.surveior_dua,
                k.status_surveior_dua,
                l.id AS trans_final_ep_surveior_id,
                l.final AS status_final_ep,
                m.id AS pengiriman_laporan_survei_id,
                m.tanggal_survei_satu,
                m.tanggal_survei_dua,
                m.tanggal_survei_tiga,
                m.url_bukti_satu,
                m.url_bukti_dua,
                m.url_bukti_tiga,
                n.id AS penetapan_verifikator_id,
                n.users_id AS users_verifikator,
                o.id AS trans_final_ep_verifikator_id,
                o.final AS status_final_ep_verifikator,
                p.id AS pengiriman_rekomendasi_id,
                p.url_surat_rekomendasi_status,
                q.id AS pengajuan_id,
                q.status_rekomendasi_id AS pengajuan_rekomendasi,
                q.catatan_ketua,
                q.status_persetujuan,
                q.catatan_terima,
                q.created_at,
                r.id AS direktur_id,
                r.status_direktur AS direktur,
                r.persetujuan_ketua_id,
                r.catatan_direktur,
                r.created_at AS tgldir 
                FROM
                pengajuan_usulan_survei a
                LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
                LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
                LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
                LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
                LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
                LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
                LEFT OUTER JOIN dbfaskes.puskesmas_pusdatin ON a.fasyankes_id = puskesmas_pusdatin.kode_sarana
                LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
                LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
                LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
                LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
                LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
                LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
                LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
                LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
                INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
                LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                INNER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
                WHERE
                1 = 1 
                AND q.id IS NOT NULL
                AND c.nama = 'Pusat Kesehatan Masyarakat'
                AND r.status_direktur = 2
                ORDER BY
                a.created_at asc");

$klinik=$this->sina->query("SELECT
        a.*,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        f.nama AS status_akreditasi,
        g.nama AS lpa,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        data_klinik.nama_klinik AS nama_fasyankes,
        data_klinik.alamat_faskes_versi_akreditasi AS alamat,
        data_klinik.id_prov AS provinsi_id,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_klinik.id_kota AS kabkota_id,
        kota.id_kota AS id_kota,
        kota.nama_kota AS nama_kota,
        kecamatan.nama_camat AS kecamatan,
        i.penerimaan_pengajuan_usulan_survei_id,
        i.url_surat_permohonan_survei,
        i.url_profil_fasyankes,
        i.url_laporan_hasil_penilaian_mandiri,
        i.url_pps_reakreditasi,
        i.url_surat_usulan_dinas,
        i.update_dfo,
        i.update_aspak,
        i.update_sisdmk,
        i.update_inm,
        i.update_ikp,
        i.id AS berkas_usulan_survei_id,
        j.id AS kelengkapan_berkas_id,
        j.kelengkapan_berkas_usulan,
        j.kelengkapan_berkas_usulan_catatan,
        j.kelengkapan_dfo,
        j.kelengkapan_dfo_catatan,
        j.kelengkapan_sarpras_alkes,
        j.kelengkapan_sarpras_alkes_catatan,
        j.kelengkapan_nakes,
        j.kelengkapan_nakes_catatan,
        j.kelengkapan_laporan_inm,
        j.kelengkapan_laporan_inm_catatan,
        j.kelengkapan_laporan_ikp,
        j.kelengkapan_laporan_ikp_catatan,
        k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2,
        k.id AS penetapan_tanggal_survei_id,
        k.url_dokumen_kontrak,
        k.url_surat_tugas,
        k.tanggal_survei,
        k.metode_survei_id,
        k.url_dokumen_pendukung_ep,
        k.surveior_satu,
        k.status_surveior_satu,
        k.surveior_dua,
        k.status_surveior_dua,
        l.id AS trans_final_ep_surveior_id,
        l.final AS status_final_ep,
        m.id AS pengiriman_laporan_survei_id,
        m.tanggal_survei_satu,
        m.tanggal_survei_dua,
        m.tanggal_survei_tiga,
        m.url_bukti_satu,
        m.url_bukti_dua,
        m.url_bukti_tiga,
        n.id AS penetapan_verifikator_id,
        n.users_id AS users_verifikator,
        o.id AS trans_final_ep_verifikator_id,
        o.final AS status_final_ep_verifikator,
        p.id AS pengiriman_rekomendasi_id,
        p.url_surat_rekomendasi_status,
        q.id AS pengajuan_id,
        q.status_rekomendasi_id AS pengajuan_rekomendasi,
        q.catatan_ketua,
        q.status_persetujuan,
        q.catatan_terima,
        q.created_at,
        r.id AS direktur_id,
        r.status_direktur AS direktur,
        r.persetujuan_ketua_id,
        r.catatan_direktur,
        r.created_at AS tgldir  
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
        LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
        LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
        LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
        LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
        LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
        LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
        LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
        LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
        LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
        LEFT OUTER JOIN dbfaskes.kecamatan ON dbfaskes.data_klinik.id_camat = dbfaskes.kecamatan.id_camat
        LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
        LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
        LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
        LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
        LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
        LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
        INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        INNER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        WHERE
        1 = 1
        AND c.nama = 'Klinik'
        AND q.id IS NOT NULL
        AND r.status_direktur = 2
        ORDER BY
        a.created_at DESC");


$labkes=$this->sina->query("SELECT
        a.*,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        f.nama AS status_akreditasi,
        g.nama AS lpa,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        data_labkes.nama_lab AS nama_fasyankes,
        data_labkes.id_prov AS provinsi_id,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_labkes.id_kota AS kabkota_id,
        kota.id_kota AS id_kota,
        kota.nama_kota AS nama_kota,
        i.penerimaan_pengajuan_usulan_survei_id,
        i.url_surat_permohonan_survei,
        i.url_profil_fasyankes,
        i.url_laporan_hasil_penilaian_mandiri,
        i.url_pps_reakreditasi,
        i.url_surat_usulan_dinas,
        i.update_dfo,
        i.update_aspak,
        i.update_sisdmk,
        i.update_inm,
        i.update_ikp,
        i.id AS berkas_usulan_survei_id,
        j.id AS kelengkapan_berkas_id,
        j.kelengkapan_berkas_usulan,
        j.kelengkapan_berkas_usulan_catatan,
        j.kelengkapan_dfo,
        j.kelengkapan_dfo_catatan,
        j.kelengkapan_sarpras_alkes,
        j.kelengkapan_sarpras_alkes_catatan,
        j.kelengkapan_nakes,
        j.kelengkapan_nakes_catatan,
        j.kelengkapan_laporan_inm,
        j.kelengkapan_laporan_inm_catatan,
        j.kelengkapan_laporan_ikp,
        j.kelengkapan_laporan_ikp_catatan,
        k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2,
        k.id AS penetapan_tanggal_survei_id,
        k.url_dokumen_kontrak,
        k.url_surat_tugas,
        k.tanggal_survei,
        k.metode_survei_id,
        k.url_dokumen_pendukung_ep,
        k.surveior_satu,
        k.status_surveior_satu,
        k.surveior_dua,
        k.status_surveior_dua,
        l.id AS trans_final_ep_surveior_id,
        l.final AS status_final_ep,
        m.id AS pengiriman_laporan_survei_id,
        m.tanggal_survei_satu,
        m.tanggal_survei_dua,
        m.tanggal_survei_tiga,
        m.url_bukti_satu,
        m.url_bukti_dua,
        m.url_bukti_tiga,
        n.id AS penetapan_verifikator_id,
        n.users_id AS users_verifikator,
        o.id AS trans_final_ep_verifikator_id,
        o.final AS status_final_ep_verifikator,
        p.id AS pengiriman_rekomendasi_id,
        p.url_surat_rekomendasi_status,
        q.id AS pengajuan_id,
        q.status_rekomendasi_id AS pengajuan_rekomendasi,
        q.catatan_ketua,
        q.status_persetujuan,
        q.catatan_terima,
        q.created_at,
        r.id AS direktur_id,
        r.status_direktur AS direktur,
        r.persetujuan_ketua_id,
        r.catatan_direktur,
        r.created_at AS tgldir  
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
        LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
        LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
        LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
        LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
        LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
        LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
        LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
        LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_labkes.id_prov = dbfaskes.propinsi.id_prop
        LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_labkes.id_kota = dbfaskes.kota.id_kota
        LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
        LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
        LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
        LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
        LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
        LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
        INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        WHERE
        1 = 1
        AND c.nama = 'Laboratorium Kesehatan'
        AND q.id IS NOT NULL
        AND r.id IS NOT NULL
        AND r.status_direktur = 2
        ORDER BY
        a.created_at DESC");


if ($faskes == null) {
        return [];
}elseif ($faskes == 'Puskesmas') {
        return $puskesmas->result();
}elseif($faskes == 'Klinik'){
        return $klinik->result();
}elseif($faskes == 'Labkes'){
        return $labkes->result();
}

}
}