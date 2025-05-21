<?php
class Tte_non_rs extends CI_Model{

        public function widget($lem_id)
        {
                $hsl=$this->sina->query("SELECT jenis_faskes, COUNT(kode_faskes) jumlah_perfaskes FROM `sertifikat_nomor`
                       WHERE kdlembaga='$lem_id'
                       GROUP BY jenis_faskes");
                return $hsl->result();
        }

        public function list_faskes_lembaga($lpa)
        {
                $hsl=$this->sina->query("SELECT
                       a.id,
                       a.id_pengajuan,
                       a.persetujuan_direktur_id,
                       a.kode_faskes,
                       a.nama_faskes,
                       a.jenis_faskes,
                       a.alamat,
                       a.kecamatan,
                       a.kabkot,
                       a.provinsi,
                       a.status_akreditasi,
                       a.tgl_survei,
                       a.logo,
                       a.nomor_surat,
                       a.tgl_nomor_surat,
                       a.lpa AS lpa_id,
                       a.created_at,
                       a.updated_at,
                       b.id AS id_lpa,
                       b.data_sertifikat_id,
                       b.tgl_berakhir,
                       b.tgl_tte,
                       b.status_tte,
                       b.file_name,
                       b.created_at,
                       b.updated_at 
                       FROM
                       data_sertifikat AS a
                       LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                       WHERE 
                       a.lpa = '".$lpa."' AND
                       a.nomor_surat IS NOT NULL
                       AND b.id IS NULL");
                return $hsl->result();
        }



        public function tpmd($where)
        {
                $hsl=$this->dbfaskes->query("SELECT
                        data_pm.nama_pm,
                        trans_final.kode_faskes_baru 
                        FROM
                        trans_final
                        INNER JOIN data_pm ON trans_final.id_faskes = data_pm.id_faskes 
                        LEFT JOIN db_akreditasi_non_rs.data_sertifikat_tpmd ON dbfaskes.trans_final.kode_faskes_baru = db_akreditasi_non_rs.data_sertifikat_tpmd.kode_faskes
                        WHERE
                        trans_final.kode_faskes_baru IN ($where) AND
                        db_akreditasi_non_rs.data_sertifikat_tpmd.kode_faskes IS NULL");
                return $hsl->result();
        }


        public function tpmdvalid($xt)
        {

                $hsl=$this->dbfaskes->query("SELECT
                        data_pm.nama_pm,
                        trans_final.kode_faskes_baru 
                        FROM
                        trans_final
                        INNER JOIN data_pm ON trans_final.id_faskes = data_pm.id_faskes 
                        LEFT JOIN db_akreditasi_non_rs.data_sertifikat_tpmd ON dbfaskes.trans_final.kode_faskes_baru = db_akreditasi_non_rs.data_sertifikat_tpmd.kode_faskes
                        WHERE
                        trans_final.kode_faskes_baru IN ($xt) AND
                        db_akreditasi_non_rs.data_sertifikat_tpmd.kode_faskes IS NOT NULL");

                if ($xt == null) {
                        return [];
                }else{
                        return $hsl->result();
                }
        }




        public function tpmd_dirjen()
        {
                $hsl=$this->sina->query("SELECT
                        data_sertifikat_tpmd.id,
                        data_sertifikat_tpmd.id_pengajuan,
                        data_sertifikat_tpmd.kode_faskes,
                        data_sertifikat_tpmd.nama_faskes,
                        data_sertifikat_tpmd.jenis_faskes,
                        data_sertifikat_tpmd.alamat,
                        data_sertifikat_tpmd.kecamatan,
                        data_sertifikat_tpmd.kabkot,
                        data_sertifikat_tpmd.provinsi,
                        data_sertifikat_tpmd.status_akreditasi,
                        data_sertifikat_tpmd.tgl_survei,
                        data_sertifikat_tpmd.nomor_surat,
                        data_sertifikat_tpmd.tgl_nomor_surat,
                        data_sertifikat_tpmd.lpa,
                        data_sertifikat_tpmd.`status` 
                        FROM
                        data_sertifikat_tpmd
                        LEFT JOIN TPMD_tte_dirjen ON data_sertifikat_tpmd.id = TPMD_tte_dirjen.data_sertifikat_tpmd_id 
                        WHERE
                        TPMD_tte_dirjen.id IS NULL
                        AND data_sertifikat_tpmd.nomor_surat IS NOT NULL");
                return $hsl->result();
        }


        public function tpmd_dirjen_tte()
        {
                $hsl=$this->sina->query("SELECT
        *
                        FROM
                        TPMD_tte_dirjen
                        INNER JOIN
                        data_sertifikat_tpmd
                        ON 
                        TPMD_tte_dirjen.data_sertifikat_tpmd_id = data_sertifikat_tpmd.id");
                return $hsl->result();
        }

        public function detail_tpmd($kd)
        {
                $hsl=$this->dbfaskes->query("SELECT
                        data_pm.nama_pm,
                        trans_final.kode_faskes_baru,
                        data_pm.alamat_faskes,
                        kecamatan.nama_camat,
                        kota.nama_kota_temp1,
                        propinsi.nama_prop 
                        FROM
                        trans_final
                        INNER JOIN data_pm ON trans_final.id_faskes = data_pm.id_faskes
                        INNER JOIN kecamatan ON data_pm.id_camat_pm = kecamatan.id_camat
                        INNER JOIN kota ON data_pm.id_kota_pm = kota.id_kota
                        INNER JOIN propinsi ON data_pm.id_prov_pm = propinsi.id_prop
                        WHERE
                        trans_final.kode_faskes_baru ='".$kd."'");
                return $hsl->result();
        }




        public function tpmd_dirjen_detail($id)
        {
                $hsl=$this->sina->query("SELECT
                        data_sertifikat_tpmd.id,
                        data_sertifikat_tpmd.id_pengajuan,
                        data_sertifikat_tpmd.kode_faskes AS kode_faskes_baru,
                        data_sertifikat_tpmd.nama_faskes AS nama_pm,
                        data_sertifikat_tpmd.jenis_faskes,
                        data_sertifikat_tpmd.alamat AS alamat_faskes,
                        data_sertifikat_tpmd.kecamatan AS nama_camat,
                        data_sertifikat_tpmd.kabkot AS nama_kota_temp1,
                        data_sertifikat_tpmd.provinsi AS nama_prop,
                        data_sertifikat_tpmd.status_akreditasi,
                        data_sertifikat_tpmd.tgl_survei,
                        data_sertifikat_tpmd.nomor_surat,
                        data_sertifikat_tpmd.tgl_nomor_surat,
                        data_sertifikat_tpmd.file_tte_dir,
                        data_sertifikat_tpmd.lpa,
                        data_sertifikat_tpmd.`status` 
                        FROM
                        data_sertifikat_tpmd
                        LEFT JOIN TPMD_tte_dirjen ON data_sertifikat_tpmd.id = TPMD_tte_dirjen.data_sertifikat_tpmd_id 
                        WHERE
                        data_sertifikat_tpmd.id_pengajuan = ".$id."
                        AND data_sertifikat_tpmd.nomor_surat IS NOT NULL");
                return $hsl->result();
        }

        public function list_faskes_tpmd()
        {
                $hsl=$this->sina->query("SELECT
                        id,
                        nama_faskes,
                        kode_faskes
                        FROM
                        data_sertifikat AS a
                        WHERE 
                        a.jenis_faskes = 'tpmd'");
                return $hsl->result();
        }

        public function list_faskes_lembaga_sudah($lpa)
        {
                $hsl=$this->sina->query("SELECT
                        a.id,
                        a.id_pengajuan,
                        a.persetujuan_direktur_id,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at 
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        WHERE a.lpa = '".$lpa."'
                        AND b.id IS NOT NULL");
                return $hsl->result();
        }

        public function sudahttelpa()
        {
                $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at 
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        WHERE 
                        b.id IS NOT NULL");
                return $hsl->result();
        }

        public function list_faskes_dirjen_belum($jenis_faskes,$jenis)
        {
                if ($jenis_faskes == null) {
                        return [];
                }elseif ($jenis_faskes == 'Klinik'){
                        $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.id_pengajuan,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at,
                        data_klinik.jenis_klinik AS kategori_faskes
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
                        LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
                        WHERE 
                        b.id IS NOT NULL
                        AND  c.id IS NULL
                        AND a.jenis_faskes = '$jenis_faskes'
                        AND data_klinik.jenis_klinik = '$jenis'
                        ORDER BY
                        b.tgl_tte ASC 
                        LIMIT 100
                        ");
                        return $hsl->result();
                }elseif ($jenis_faskes == 'Pusat Kesehatan Masyarakat') {
                        $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.id_pengajuan,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at,
                        puskesmas_pusdatin.jenis_pelayanan AS kategori_faskes
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        LEFT OUTER JOIN dbfaskes.puskesmas_pusdatin ON a.kode_faskes = puskesmas_pusdatin.kode_sarana
                        WHERE 
                        b.id IS NOT NULL
                        AND  c.id IS NULL
                        AND a.jenis_faskes = '$jenis_faskes'
                        ORDER BY
                        b.tgl_tte ASC 
                        LIMIT 100
                        ");
                        return $hsl->result();
                }elseif ($jenis_faskes == 'Laboratorium') {
                        $jenis_escape = $this->sina->escape($jenis);
                                $whereJenis = '';
                        if (strtolower($jenis) === 'laboratorium medis') {
                                $whereJenis = " AND LEFT(kategoriFaskes, 18) = 'Laboratorium Medis' ";
                        } elseif (strtolower($jenis) === 'laboratorium Kesehatan') {
                                $whereJenis = " AND LEFT(kategoriFaskes, 18) != 'Laboratorium Medis' ";
                        }

                        $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.id_pengajuan,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at,
                        data_labkes.jenis_lab AS kategori_faskes
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
                        LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
                        WHERE 
                        b.id IS NOT NULL
                        AND  c.id IS NULL
                        AND a.jenis_faskes = '$jenis_faskes'
                        $whereJenis
                        ORDER BY
                        b.tgl_tte ASC 
                        LIMIT 100
                        ");
                        return $hsl->result();
                }elseif ($jenis_faskes == 'Unit Transfusi Darah') {
                        $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.id_pengajuan,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at,
                        data_utd.jenis_utd AS kategori_faskes
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
                        LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
                        WHERE 
                        b.id IS NOT NULL
                        AND  c.id IS NULL
                        AND a.jenis_faskes = '$jenis_faskes'
                        ORDER BY
                        b.tgl_tte ASC 
                        LIMIT 100
                        ");
                        return $hsl->result();
                }


                // $str = $this->sina->last_query();



                // echo "<pre>";
                // print_r($str);
                // exit;
                
        }

        public function list_faskes_dirjen_belumkmk()
        {
                $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.id_pengajuan,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        WHERE 
                        b.id IS NOT NULL
                        AND  c.id IS NULL
                        -- AND  a.lpa NOT IN ('KEMENKES') 
                        /* AND a.jenis_faskes IN ('klinik','Pusat Kesehatan Masyarakat')*/
                        ORDER BY
                        b.tgl_tte ASC 
                        LIMIT 100
                        ");
                return $hsl->result();
        }

        public function list_faskes_dirjen_belum_skmk()
        {
                $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        WHERE 
                        c.id_faskes IS NULL
                        AND a.lpa = 'KEMENKES'
                        ORDER BY
                        b.tgl_tte ASC 
                        LIMIT 100");
                return $hsl->result();
        }

        public function list_faskes_dirjen_sudah()
        {
                $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.id_pengajuan,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        WHERE b.id IS NOT NULL
                        AND  c.id_faskes IS NOT NULL");
                return $hsl->result();
        }

        public function list_faskes_dirjen_detail($id)
        {
                $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.kode_faskes,
                        a.id_pengajuan,
                        a.nama_faskes,
                        a.jenis_faskes,
                        a.alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name,
                        b.created_at,
                        b.updated_at,
                        c.url_sertifikat,
                        b.file_name AS url_lpa,
                        b.file_tte_dir
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        WHERE b.id IS NOT NULL
                        AND a.id_pengajuan = '".$id."'
                        GROUP BY a.id_pengajuan
                        ORDER BY a.created_at desc");
                return $hsl->result();
        }

        public function detail_faskes($idp)
        {
                $hsl=$this->sina->query("SELECT
                        a.id,
                        a.persetujuan_direktur_id,
                        a.id_pengajuan,
                        a.kode_faskes,
                        a.nama_faskes,
                        a.jenis_faskes,
                        LEFT(a.alamat,72) as alamat,
                        a.kecamatan,
                        a.kabkot,
                        a.provinsi,
                        a.status_akreditasi,
                        a.tgl_survei,
                        a.logo,
                        a.lpa,
                        a.status_lpak,
                        a.nomor_surat,
                        a.tgl_nomor_surat,
                        a.lpa AS lpa_id,
                        a.kategoriFaskes,
                        a.created_at,
                        a.updated_at,
                        b.id AS id_lpa,
                        b.data_sertifikat_id,
                        b.tgl_berakhir,
                        b.tgl_tte,
                        b.status_tte,
                        b.file_name AS url_sertifikat,
                        b.file_name,
                        b.created_at,
                        b.updated_at 
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        WHERE a.id_pengajuan = '".$idp."'
                        ORDER BY
                        a.id DESC
                        LIMIT 1");
                return $hsl->result();
        }

    public function belumverifikasi($faskes = null, $jenis = null)
    {
        if ($faskes === null) {
            return [];
        }

        if ($faskes === 'Pusat Kesehatan Masyarakat') {
            $sql = "
                SELECT a.*, b.status_usulan_id, b.keterangan, h.nama AS status_usulan,
                    c.nama AS jenis_fasyankes_nama, d.nama AS jenis_survei, e.nama AS jenis_akreditasi,
                    f.nama AS status_akreditasi, g.nama AS lpa, puskesmas_pusdatin.name AS nama_fasyankes,
                    puskesmas_pusdatin.provinsi_code AS provinsi_id, puskesmas_pusdatin.provinsi_nama AS nama_prop,
                    puskesmas_pusdatin.kabkot_code AS kabkota_id, puskesmas_pusdatin.kabkot_nama AS nama_kota,
                    i.penerimaan_pengajuan_usulan_survei_id, i.url_surat_permohonan_survei,
                    i.url_profil_fasyankes, i.url_laporan_hasil_penilaian_mandiri, i.url_pps_reakreditasi,
                    i.url_surat_usulan_dinas, i.update_dfo, i.update_aspak, i.update_sisdmk, i.update_inm,
                    i.update_ikp, i.id AS berkas_usulan_survei_id, j.id AS kelengkapan_berkas_id,
                    j.kelengkapan_berkas_usulan, j.kelengkapan_berkas_usulan_catatan, j.kelengkapan_dfo,
                    j.kelengkapan_dfo_catatan, j.kelengkapan_sarpras_alkes, j.kelengkapan_sarpras_alkes_catatan,
                    j.kelengkapan_nakes, j.kelengkapan_nakes_catatan, j.kelengkapan_laporan_inm,
                    j.kelengkapan_laporan_inm_catatan, j.kelengkapan_laporan_ikp, j.kelengkapan_laporan_ikp_catatan,
                    k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2, k.id AS penetapan_tanggal_survei_id,
                    k.url_dokumen_kontrak, k.url_surat_tugas, k.tanggal_survei, k.metode_survei_id,
                    k.url_dokumen_pendukung_ep, k.surveior_satu, k.status_surveior_satu, k.surveior_dua,
                    k.status_surveior_dua, l.id AS trans_final_ep_surveior_id, l.final AS status_final_ep,
                    m.id AS pengiriman_laporan_survei_id, m.tanggal_survei_satu, m.tanggal_survei_dua,
                    m.tanggal_survei_tiga, m.url_bukti_satu, m.url_bukti_dua, m.url_bukti_tiga,
                    n.id AS penetapan_verifikator_id, n.users_id AS users_verifikator,
                    o.id AS trans_final_ep_verifikator_id, o.final AS status_final_ep_verifikator,
                    p.id AS pengiriman_rekomendasi_id, p.url_surat_rekomendasi_status, q.id AS pengajuan_id,
                    q.status_rekomendasi_id AS pengajuan_rekomendasi, q.catatan_ketua, q.status_persetujuan,
                    q.catatan_terima, q.created_at, r.id AS direktur_id, r.status_direktur AS direktur,
                    r.persetujuan_ketua_id, r.catatan_direktur
                FROM pengajuan_usulan_survei a
                LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
                LEFT JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
                LEFT JOIN jenis_survei d ON a.jenis_survei_id = d.id
                LEFT JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
                LEFT JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
                LEFT JOIN lpa g ON a.lpa_id = g.id
                LEFT JOIN dbfaskes.puskesmas_pusdatin ON a.fasyankes_id = puskesmas_pusdatin.kode_sarana
                LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
                LEFT JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
                LEFT JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
                LEFT JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
                LEFT JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
                LEFT JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
                LEFT JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
                LEFT JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
                INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
                LEFT JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                LEFT JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id
                WHERE b.status_usulan_id = 3 AND q.id IS NOT NULL AND r.id IS NULL AND c.nama = 'Pusat Kesehatan Masyarakat'
                ORDER BY q.created_at ASC
            ";
            $query = $this->sina->query($sql);
            return $query->result();

        } elseif ($faskes === 'Klinik') {

            if ($jenis === null) {
                return []; // Jika jenis tidak disediakan, kembalikan array kosong
            }

            $jenis_escape = $this->sina->escape($jenis);

            $sql = "
                SELECT a.*, b.status_usulan_id, b.keterangan, h.nama AS status_usulan,
                    c.nama AS jenis_fasyankes_nama, d.nama AS jenis_survei, e.nama AS jenis_akreditasi,
                    f.nama AS status_akreditasi, g.nama AS lpa, trans_final.kode_faskes AS kode_faskes,
                    trans_final.id_faskes AS id_faskes, data_klinik.nama_klinik AS nama_fasyankes,
                    data_klinik.id_prov AS provinsi_id, propinsi.id_prop AS id_prop,
                    propinsi.nama_prop AS nama_prop, data_klinik.id_kota AS kabkota_id,
                    kota.id_kota AS id_kota, kota.nama_kota AS nama_kota,
                    i.penerimaan_pengajuan_usulan_survei_id, i.url_surat_permohonan_survei,
                    i.url_profil_fasyankes, i.url_laporan_hasil_penilaian_mandiri, i.url_pps_reakreditasi,
                    i.url_surat_usulan_dinas, i.update_dfo, i.update_aspak, i.update_sisdmk, i.update_inm,
                    i.update_ikp, i.id AS berkas_usulan_survei_id, j.id AS kelengkapan_berkas_id,
                    j.kelengkapan_berkas_usulan, j.kelengkapan_berkas_usulan_catatan, j.kelengkapan_dfo,
                    j.kelengkapan_dfo_catatan, j.kelengkapan_sarpras_alkes, j.kelengkapan_sarpras_alkes_catatan,
                    j.kelengkapan_nakes, j.kelengkapan_nakes_catatan, j.kelengkapan_laporan_inm,
                    j.kelengkapan_laporan_inm_catatan, j.kelengkapan_laporan_ikp, j.kelengkapan_laporan_ikp_catatan,
                    k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2, k.id AS penetapan_tanggal_survei_id,
                    k.url_dokumen_kontrak, k.url_surat_tugas, k.tanggal_survei, k.metode_survei_id,
                    k.url_dokumen_pendukung_ep, k.surveior_satu, k.status_surveior_satu, k.surveior_dua,
                    k.status_surveior_dua, l.id AS trans_final_ep_surveior_id, l.final AS status_final_ep,
                    m.id AS pengiriman_laporan_survei_id, m.tanggal_survei_satu, m.tanggal_survei_dua,
                    m.tanggal_survei_tiga, m.url_bukti_satu, m.url_bukti_dua, m.url_bukti_tiga,
                    n.id AS penetapan_verifikator_id, n.users_id AS users_verifikator,
                    o.id AS trans_final_ep_verifikator_id, o.final AS status_final_ep_verifikator,
                    p.id AS pengiriman_rekomendasi_id, p.url_surat_rekomendasi_status, q.id AS pengajuan_id,
                    q.status_rekomendasi_id AS pengajuan_rekomendasi, q.catatan_ketua, q.status_persetujuan,
                    q.catatan_terima, q.created_at, r.id AS direktur_id, r.status_direktur AS direktur,
                    r.persetujuan_ketua_id, r.catatan_direktur
                FROM pengajuan_usulan_survei a
                LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
                LEFT JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
                LEFT JOIN jenis_survei d ON a.jenis_survei_id = d.id
                LEFT JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
                LEFT JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
                LEFT JOIN lpa g ON a.lpa_id = g.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
                LEFT JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
                LEFT JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
                LEFT JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
                LEFT JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
                LEFT JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
                LEFT JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
                LEFT JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
                INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
                LEFT JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                LEFT JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id
                WHERE c.nama = 'Klinik' AND data_klinik.jenis_klinik = $jenis_escape
                AND r.id IS NULL AND q.id IS NOT NULL
                ORDER BY q.created_at ASC
            ";
            $query = $this->sina->query($sql);
            return $query->result();

        } elseif ($faskes === 'Laboratorium Kesehatan') {

            if ($jenis === null) {
                return []; // Bila jenis tidak ada kembalikan kosong
            }
            // Escape input jenis
            $jenis_escape = $this->sina->escape($jenis);

            // Kondisi tambahan untuk Laboratorium Kesehatan berdasarkan $jenis
                $whereJenis = '';
            if (strtolower($jenis) === 'laboratorium medis') {
                $whereJenis = " AND LEFT(data_labkes.jenis_pelayanan, 18) = 'Laboratorium Medis' ";
            } elseif (strtolower($jenis) === 'laboratorium kesmas') {
                $whereJenis = " AND LEFT(data_labkes.jenis_pelayanan, 18) != 'Laboratorium Medis' ";
            }

            $sql = "
                SELECT a.*, b.status_usulan_id, b.keterangan, h.nama AS status_usulan,
                    c.nama AS jenis_fasyankes_nama, d.nama AS jenis_survei, e.nama AS jenis_akreditasi,
                    f.nama AS status_akreditasi, g.nama AS lpa, trans_final.kode_faskes AS kode_faskes,
                    trans_final.id_faskes AS id_faskes, data_labkes.nama_lab AS nama_fasyankes,
                    data_labkes.id_prov AS provinsi_id, propinsi.id_prop AS id_prop,
                    propinsi.nama_prop AS nama_prop, data_labkes.id_kota AS kabkota_id,
                    kota.id_kota AS id_kota, kota.nama_kota AS nama_kota,
                    i.penerimaan_pengajuan_usulan_survei_id, i.url_surat_permohonan_survei,
                    i.url_profil_fasyankes, i.url_laporan_hasil_penilaian_mandiri, i.url_pps_reakreditasi,
                    i.url_surat_usulan_dinas, i.update_dfo, i.update_aspak, i.update_sisdmk, i.update_inm,
                    i.update_ikp, i.id AS berkas_usulan_survei_id, j.id AS kelengkapan_berkas_id,
                    j.kelengkapan_berkas_usulan, j.kelengkapan_berkas_usulan_catatan, j.kelengkapan_dfo,
                    j.kelengkapan_dfo_catatan, j.kelengkapan_sarpras_alkes, j.kelengkapan_sarpras_alkes_catatan,
                    j.kelengkapan_nakes, j.kelengkapan_nakes_catatan, j.kelengkapan_laporan_inm,
                    j.kelengkapan_laporan_inm_catatan, j.kelengkapan_laporan_ikp, j.kelengkapan_laporan_ikp_catatan,
                    k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2, k.id AS penetapan_tanggal_survei_id,
                    k.url_dokumen_kontrak, k.url_surat_tugas, k.tanggal_survei, k.metode_survei_id,
                    k.url_dokumen_pendukung_ep, k.surveior_satu, k.status_surveior_satu, k.surveior_dua,
                    k.status_surveior_dua, l.id AS trans_final_ep_surveior_id, l.final AS status_final_ep,
                    m.id AS pengiriman_laporan_survei_id, m.tanggal_survei_satu, m.tanggal_survei_dua,
                    m.tanggal_survei_tiga, m.url_bukti_satu, m.url_bukti_dua, m.url_bukti_tiga,
                    n.id AS penetapan_verifikator_id, n.users_id AS users_verifikator,
                    o.id AS trans_final_ep_verifikator_id, o.final AS status_final_ep_verifikator,
                    p.id AS pengiriman_rekomendasi_id, p.url_surat_rekomendasi_status, q.id AS pengajuan_id,
                    q.status_rekomendasi_id AS pengajuan_rekomendasi, q.catatan_ketua, q.status_persetujuan,
                    q.catatan_terima, q.created_at, r.id AS direktur_id, r.status_direktur AS direktur,
                    r.persetujuan_ketua_id, r.catatan_direktur
                FROM pengajuan_usulan_survei a
                LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
                LEFT JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
                LEFT JOIN jenis_survei d ON a.jenis_survei_id = d.id
                LEFT JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
                LEFT JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
                LEFT JOIN lpa g ON a.lpa_id = g.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_labkes.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_labkes.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
                LEFT JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
                LEFT JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
                LEFT JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
                LEFT JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
                LEFT JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
                LEFT JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
                LEFT JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
                INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
                LEFT JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                LEFT JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id
                WHERE c.nama = 'Laboratorium' $whereJenis AND r.id IS NULL AND q.id IS NOT NULL
                ORDER BY q.created_at ASC
            ";
            $query = $this->sina->query($sql);
            return $query->result();

        } elseif ($faskes === 'Unit Transfusi Darah') {

            $sql = "
                SELECT a.*, b.status_usulan_id, b.keterangan, h.nama AS status_usulan,
                c.nama AS jenis_fasyankes_nama, d.nama AS jenis_survei, e.nama AS jenis_akreditasi,
                f.nama AS status_akreditasi, g.nama AS lpa, trans_final.kode_faskes AS kode_faskes,
                trans_final.id_faskes AS id_faskes, data_utd.nama_utd AS nama_fasyankes,
                data_utd.id_prov AS provinsi_id, propinsi.id_prop AS id_prop,
                propinsi.nama_prop AS nama_prop, data_utd.id_kota AS kabkota_id,
                kota.id_kota AS id_kota, kota.nama_kota AS nama_kota,
                i.penerimaan_pengajuan_usulan_survei_id, i.url_surat_permohonan_survei,
                i.url_profil_fasyankes, i.url_laporan_hasil_penilaian_mandiri, i.url_pps_reakreditasi,
                i.url_surat_usulan_dinas, i.update_dfo, i.update_aspak, i.update_sisdmk, i.update_inm,
                i.update_ikp, i.id AS berkas_usulan_survei_id, j.id AS kelengkapan_berkas_id,
                j.kelengkapan_berkas_usulan, j.kelengkapan_berkas_usulan_catatan, j.kelengkapan_dfo,
                j.kelengkapan_dfo_catatan, j.kelengkapan_sarpras_alkes, j.kelengkapan_sarpras_alkes_catatan,
                j.kelengkapan_nakes, j.kelengkapan_nakes_catatan, j.kelengkapan_laporan_inm,
                j.kelengkapan_laporan_inm_catatan, j.kelengkapan_laporan_ikp, j.kelengkapan_laporan_ikp_catatan,
                k.kelengkapan_berkas_id AS kelengkapan_berkas_id_2, k.id AS penetapan_tanggal_survei_id,
                k.url_dokumen_kontrak, k.url_surat_tugas, k.tanggal_survei, k.metode_survei_id,
                k.url_dokumen_pendukung_ep, k.surveior_satu, k.status_surveior_satu, k.surveior_dua,
                k.status_surveior_dua, l.id AS trans_final_ep_surveior_id, l.final AS status_final_ep,
                m.id AS pengiriman_laporan_survei_id, m.tanggal_survei_satu, m.tanggal_survei_dua,
                m.tanggal_survei_tiga, m.url_bukti_satu, m.url_bukti_dua, m.url_bukti_tiga,
                n.id AS penetapan_verifikator_id, n.users_id AS users_verifikator,
                o.id AS trans_final_ep_verifikator_id, o.final AS status_final_ep_verifikator,
                p.id AS pengiriman_rekomendasi_id, p.url_surat_rekomendasi_status, q.id AS pengajuan_id,
                q.status_rekomendasi_id AS pengajuan_rekomendasi, q.catatan_ketua, q.status_persetujuan,
                q.catatan_terima, q.created_at, r.id AS direktur_id, r.status_direktur AS direktur,
                r.persetujuan_ketua_id, r.catatan_direktur
                FROM pengajuan_usulan_survei a
                LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
                LEFT JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
                LEFT JOIN jenis_survei d ON a.jenis_survei_id = d.id
                LEFT JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
                LEFT JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
                LEFT JOIN lpa g ON a.lpa_id = g.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
                LEFT JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
                LEFT JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
                LEFT JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
                LEFT JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
                LEFT JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
                LEFT JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
                LEFT JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
                INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
                LEFT JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                LEFT JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id
                WHERE c.nama = 'Unit Transfusi Darah' AND r.id IS NULL AND q.id IS NOT NULL
                ORDER BY q.created_at ASC
            ";
            $query = $this->sina->query($sql);
            return $query->result();

        } else {
            // Jika faskes tidak dikenal, kembalikan array kosong
            return [];
        }
    }




public function sudahverifikasi($faskes)
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
                puskesmas_pusdatin.provinsi_code AS provinsi_id,
                puskesmas_pusdatin.provinsi_nama AS nama_prop,
                puskesmas_pusdatin.kabkot_code AS kabkota_id,
                puskesmas_pusdatin.kabkot_nama AS nama_kota,
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
                ORDER BY
                a.created_at asc
                LIMIT 200");

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
        data_klinik.id_prov AS provinsi_id,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_klinik.id_kota AS kabkota_id,
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
        LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
        LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
        LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
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
        ORDER BY
        a.created_at DESC
        LIMIT 200");


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
        ORDER BY
        a.created_at DESC
        LIMIT 200");

$utd=$this->sina->query("SELECT
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
        data_utd.nama_utd AS nama_fasyankes,
        data_utd.id_prov AS provinsi_id,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_utd.id_kota AS kabkota_id,
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
        LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
        LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
        LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota
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
        AND c.nama = 'Unit Transfusi Darah'
        AND r.id IS NOT NULL
        AND q.id IS NOT NULL
        ORDER BY
        q.created_at ASC
        LIMIT 200");


if ($faskes == null) {
        return [];
}elseif ($faskes == 'Puskesmas') {
        return $puskesmas->result();
}elseif($faskes == 'Klinik'){
        return $klinik->result();
}elseif($faskes == 'Labkes'){
        return $labkes->result();
}elseif($faskes == 'utd'){
        return $utd->result();
}

}


public function tryagain($faskes,$id)
{
        $puskesmas=$this->sina->query("SELECT
                a.*,
                g.logo,
                g.inisial,
                pusd.tanggal_survei AS tgl_surveior,
                b.status_usulan_id,
                b.keterangan,
                h.nama AS status_usulan,
                c.nama AS jenis_fasyankes_nama,
                d.nama AS jenis_survei,
                e.nama AS jenis_akreditasi,
                sr.nama AS status_akreditasi,
                g.nama AS lpa,
                puskesmas_pusdatin.name AS nama_fasyankes,
                puskesmas_pusdatin.provinsi_nama AS nama_prop,
                puskesmas_pusdatin.kabkot_nama AS nama_kota,
                IF(puskesmas_pusdatin.alamat_sertifikat IS NULL, LEFT(puskesmas_pusdatin.alamat,72), puskesmas_pusdatin.alamat_sertifikat) AS alamat,
                puskesmas_pusdatin.kecamatan_nama AS nama_camat,
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
                r.catatan_direktur 
                FROM
                pengajuan_usulan_survei a
                LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
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
                LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
                LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
                WHERE
                1 = 1 
                AND c.nama = 'Pusat Kesehatan Masyarakat'
                AND a.fasyankes_id = '$id'
                ORDER BY
                pusd.tanggal_survei DESC
                LIMIT 1");

$klinik=$this->sina->query("SELECT
        a.*,
        g.logo,
        g.inisial,
        MAX(pusd.tanggal_survei) AS tgl_surveior,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        sr.nama AS status_akreditasi,
        g.nama AS lpa,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        data_klinik.nama_klinik AS nama_fasyankes,
        data_klinik.id_prov AS provinsi_id,
        #LEFT(data_klinik.alamat_faskes,72) AS alamat,
        IF(data_klinik.alamat_cleaning IS NULL, LEFT(data_klinik.alamat_faskes,72), data_klinik.alamat_cleaning) AS alamat,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_klinik.id_kota AS kabkota_id,
        kota.id_kota AS id_kota,
        kota.nama_kota AS nama_kota,
        yyy.nama_camat,
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
        r.catatan_direktur 
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
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
        LEFT OUTER JOIN dbfaskes.kecamatan yyy ON dbfaskes.data_klinik.id_camat = yyy.id_camat
        LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
        LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
        LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
        LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
        LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
        LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
        INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
        LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        WHERE
        1 = 1
        AND c.nama = 'Klinik'
        AND a.fasyankes_id = '$id'
        ORDER BY
        a.created_at DESC");


$labkes=$this->sina->query("SELECT
        a.*,
        g.logo,
        g.inisial,
        MAX(pusd.tanggal_survei) AS tgl_surveior,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        sr.nama AS status_akreditasi,
        g.nama AS lpa,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        data_labkes.nama_lab AS nama_fasyankes,
        data_labkes.id_prov AS provinsi_id,
        LEFT(data_labkes.alamat_faskes,72) AS alamat,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_labkes.id_kota AS kabkota_id,
        kota.id_kota AS id_kota,
        kota.nama_kota AS nama_kota,
        yyy.nama_camat,
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
        r.catatan_direktur 
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
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
        LEFT OUTER JOIN dbfaskes.kecamatan yyy ON dbfaskes.data_labkes.id_camat = yyy.id_camat
        LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
        LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
        LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
        LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
        LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
        LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
        INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
        LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        WHERE
        1 = 1
        AND c.nama = 'Laboratorium Kesehatan'
        AND r.id IS NULL
        AND q.id IS NOT NULL
        AND a.fasyankes_id = '$id'
        ORDER BY
        a.created_at DESC");

if ($faskes == null) {
        return [];
}elseif ($faskes == 'Pusat Kesehatan Masyarakat') {
        return $puskesmas->result();
}elseif($faskes == 'Klinik'){
        return $klinik->result();
}elseif($faskes == 'Laboratorium Kesehatan'){
        return $labkes->result();
}

}


public function bahansertifikat($faskes,$id,$id_p)
{
        $puskesmas=$this->sina->query("SELECT
                a.*,
                a.id as idp,
                g.logo,
                g.inisial,
                pusd.tanggal_survei AS tgl_surveior,
                b.status_usulan_id,
                b.keterangan,
                h.nama AS status_usulan,
                c.nama AS jenis_fasyankes_nama,
                d.nama AS jenis_survei,
                e.nama AS jenis_akreditasi,
                sr.nama AS status_akreditasi,
                g.nama AS lpa,
                puskesmas_pusdatin.name AS nama_fasyankes,
                puskesmas_pusdatin.provinsi_nama AS nama_prop,
                puskesmas_pusdatin.kabkot_nama AS nama_kota,
                puskesmas_pusdatin.alamat_sertifikat AS alamat,
                puskesmas_pusdatin.kecamatan_nama AS nama_camat,
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
                r.catatan_direktur 
                FROM
                pengajuan_usulan_survei a
                LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
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
                LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
                LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
                LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
                WHERE
                1 = 1 
                                                                                                                -- AND q.id IS NOT NULL
                                                                                                                AND c.nama = 'Pusat Kesehatan Masyarakat'
                                                                                                                AND a.id = '$id_p'
                                                                                                                ORDER BY
                                                                                                                pusd.tanggal_survei DESC
                                                                                                                LIMIT 1");

$puskesmaskmk=$this->sina->query("SELECT
        a.*,
        a.id as idp,
        g.logo,
        g.inisial,
        pusd.tanggal_survei AS tgl_surveior,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        sr.nama AS status_akreditasi,
        g.nama AS lpa,
        puskesmas_pusdatin.name AS nama_fasyankes,
        puskesmas_pusdatin.provinsi_nama AS nama_prop,
        puskesmas_pusdatin.kabkot_nama AS nama_kota,
        puskesmas_pusdatin.alamat_sertifikat AS alamat,
        puskesmas_pusdatin.kecamatan_nama AS nama_camat,
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
        NULL AS kategori_faskes
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
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
        LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        WHERE
        1 = 1 
        AND c.nama = 'Pusat Kesehatan Masyarakat'
        AND a.id = '$id_p'
        ORDER BY
        pusd.tanggal_survei DESC
        LIMIT 1");

$klinik=$this->sina->query("SELECT
        a.*,
        a.id as idp,
        g.logo,
        g.inisial,
        MAX(pusd.tanggal_survei) AS tgl_surveior,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        sr.nama AS status_akreditasi_awal,
        g.nama AS lpa,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        data_klinik.nama_klinik AS nama_fasyankes,
        data_klinik.id_prov AS provinsi_id,
        #LEFT(data_klinik.alamat_faskes,72) AS alamat,
        data_klinik.alamat_faskes AS alamat,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_klinik.id_kota AS kabkota_id,
        kota.id_kota AS id_kota,
        kota.nama_kota AS nama_kota,
        yyy.nama_camat,
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
        s.nama AS status_akreditasi,
        data_klinik.jenis_klinik AS kategori_faskes
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
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
        LEFT OUTER JOIN dbfaskes.kecamatan yyy ON dbfaskes.data_klinik.id_camat = yyy.id_camat
        LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
        LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
        LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
        LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
        LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
        LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
        INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
        LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        LEFT OUTER JOIN status_rekomendasi s ON s.id = p.status_rekomendasi_id
        WHERE
        1 = 1
        AND c.nama = 'Klinik'
        AND q.id IS NOT NULL
        AND a.id = '$id_p'
        ORDER BY
        a.created_at DESC");


$labkes=$this->sina->query("SELECT
        a.*,
        a.id AS idp,
        g.logo,
        g.inisial,
        MAX(pusd.tanggal_survei) AS tgl_surveior,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        sr.nama AS status_akreditasi,
        g.nama AS lpa,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        data_labkes.nama_lab AS nama_fasyankes,
        data_labkes.id_prov AS provinsi_id,
        LEFT(data_labkes.alamat_faskes,72) AS alamat,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_labkes.id_kota AS kabkota_id,
        kota.id_kota AS id_kota,
        kota.nama_kota AS nama_kota,
        yyy.nama_camat,
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
        data_labkes.jenis_pelayanan AS kategori_faskes
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
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
        LEFT OUTER JOIN dbfaskes.kecamatan yyy ON dbfaskes.data_labkes.id_camat = yyy.id_camat
        LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
        LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
        LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
        LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
        LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
        LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
        INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
        LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        WHERE
        1 = 1
        AND c.nama = 'Laboratorium'
        AND q.id IS NOT NULL
        AND a.id = '$id_p'
        ORDER BY
        a.created_at DESC");

$utd=$this->sina->query("SELECT
        a.*,
        a.id as idp,
        g.logo,
        g.inisial,
        MAX(pusd.tanggal_survei) AS tgl_surveior,
        b.status_usulan_id,
        b.keterangan,
        h.nama AS status_usulan,
        c.nama AS jenis_fasyankes_nama,
        d.nama AS jenis_survei,
        e.nama AS jenis_akreditasi,
        sr.nama AS status_akreditasi,
        g.nama AS lpa,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        trans_final.kode_faskes AS kode_faskes,
        trans_final.id_faskes AS id_faskes,
        data_utd.nama_utd AS nama_fasyankes,
        data_utd.id_prov AS provinsi_id,
        LEFT(data_utd.alamat_faskes,72) AS alamat,
        propinsi.id_prop AS id_prop,
        propinsi.nama_prop AS nama_prop,
        data_utd.id_kota AS kabkota_id,
        kota.id_kota AS id_kota,
        kota.nama_kota AS nama_kota,
        yyy.nama_camat,
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
        NULL AS kategori_faskes
        FROM
        pengajuan_usulan_survei a
        LEFT OUTER JOIN pengajuan_usulan_survei_detail pusd ON a.id = pusd.pengajuan_usulan_survei_id
        LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
        LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
        LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
        LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
        LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
        LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
        LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
        LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
        LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
        LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota
        LEFT OUTER JOIN dbfaskes.kecamatan yyy ON dbfaskes.data_utd.id_camat = yyy.id_camat
        LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id
        LEFT OUTER JOIN berkas_usulan_survei i ON i.penerimaan_pengajuan_usulan_survei_id = b.id
        LEFT OUTER JOIN kelengkapan_berkas j ON j.berkas_usulan_survei_id = i.id
        LEFT OUTER JOIN penetapan_tanggal_survei k ON k.kelengkapan_berkas_id = j.id
        LEFT OUTER JOIN trans_final_ep_surveior l ON l.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN pengiriman_laporan_survei m ON m.penetapan_tanggal_survei_id = k.id
        LEFT OUTER JOIN penetapan_verifikator n ON n.pengiriman_laporan_survei_id = m.id
        LEFT OUTER JOIN trans_final_ep_verifikator o ON o.penetapan_verifikator_id = n.id
        INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
        LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
        LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
        LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id 
        WHERE
        1 = 1
        AND c.nama = 'Unit Transfusi Darah'
        AND q.id IS NOT NULL
        AND a.id = '$id_p'
        ORDER BY
        a.created_at DESC");

if ($faskes == null) {
        return [];
}elseif ($faskes == 'Pusat Kesehatan Masyarakat') {
        return $puskesmas->result();
}elseif ($faskes == 'PusKeskmk') {
        return $puskesmaskmk->result();
}elseif($faskes == 'Klinik'){
        return $klinik->result();
}elseif($faskes == 'Laboratorium'){
        return $labkes->result();
}elseif($faskes == 'Unit Transfusi Darah'){
        return $utd->result();
}

}




public function daftar_faskes($lem_id)
{
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.tgl_surat,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes 
                FROM
                sertifikat_nomor AS bb
                LEFT JOIN tte_lembaga AS cc ON bb.kode_faskes = cc.id_faskes
                WHERE
                cc.id_faskes IS NULL AND
                kdlembaga = '$lem_id'");
        return $hsl->result();
}
public function daftar_faskes_puskesmas($lem_id)
{
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.tgl_surat,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes 
                FROM
                sertifikat_nomor_puskesmas AS bb
                LEFT JOIN tte_lembaga_puskesmas AS cc ON bb.kode_faskes = cc.id_faskes
                WHERE
                cc.id_faskes IS NULL AND
                kdlembaga = '$lem_id'");
        return $hsl->result();
}

public function daftar_faskessudah($lem_id)
{
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.tgl_surat,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes 
                FROM
                sertifikat_nomor AS bb
                LEFT JOIN tte_lembaga AS cc ON bb.kode_faskes = cc.id_faskes
                WHERE
                cc.id_faskes IS NOT NULL AND
                kdlembaga = '$lem_id'");
        return $hsl->result();
}

public function daftar_faskessudahpuskes($lem_id)
{
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.tgl_surat,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes 
                FROM
                sertifikat_nomor_puskesmas AS bb
                LEFT JOIN tte_lembaga_puskesmas AS cc ON bb.kode_faskes = cc.id_faskes
                WHERE
                cc.id_faskes IS NOT NULL AND
                kdlembaga = '$lem_id'");
        return $hsl->result();
}

public function monitoring($lem_id)
{
        $hsl=$this->sina->query("SELECT
                data_sertifikat.kode_faskes, 
                data_sertifikat.nama_faskes, 
                data_sertifikat.alamat, 
                tte_dirjen.url_sertifikat, 
                data_sertifikat.lpa,
                data_sertifikat.jenis_faskes
                FROM
                data_sertifikat
                LEFT JOIN tte_lpa ON data_sertifikat.id = tte_lpa.data_sertifikat_id
                LEFT JOIN tte_dirjen ON tte_lpa.id = tte_dirjen.tte_lpa_id
                WHERE
                data_sertifikat.lpa = '$lem_id'");
        return $hsl->result();
}

public function faskes_detail($id)
{
        $hsl=$this->sina->query("SELECT
                aa.id, 
                aa.nama_faskes, 
                aa.alamat, 
                aa.kode_faskes, 
                aa.jenis_faskes, 
                aa.nomor_surat, 
                aa.kecamatan, 
                aa.kabkot, 
                aa.provinsi, 
                aa.capayan, 
                aa.tgl_surveior, 
                aa.tgl_surat,
                aa.kdlembaga, 
                aa.logo_ttd
                FROM
                sertifikat_nomor AS aa
                WHERE
                aa.kode_faskes = '$id'");
        return $hsl->result();
}

public function faskes_detail_puskesmas($id)
{
        $hsl=$this->sina->query("SELECT
                aa.id,
                aa.nama_faskes,
                aa.alamat,
                aa.kode_faskes,
                aa.jenis_faskes,
                aa.nomor_surat,
                aa.kecamatan,
                aa.kabkot,
                aa.provinsi,
                aa.capayan,
                aa.tgl_surveior,
                aa.tgl_surat,
                aa.kdlembaga,
                aa.logo_ttd,
                cc.id AS idl 
                FROM
                sertifikat_nomor_puskesmas AS aa
                LEFT JOIN tte_lembaga_puskesmas AS cc ON aa.id = cc.sertifikat_nomor_puskesmas_id 
                WHERE
                aa.kode_faskes = '$id'");
        return $hsl->result();
}

public function faskes_detail_direktur($id)
{
        $hsl=$this->sina->query("SELECT
                aa.id, 
                aa.nama_faskes, 
                aa.alamat, 
                aa.kode_faskes, 
                aa.jenis_faskes, 
                aa.nomor_surat, 
                aa.kecamatan, 
                aa.kabkot, 
                aa.provinsi, 
                aa.capayan, 
                aa.tgl_surveior, 
                aa.tgl_surat, 
                aa.kdlembaga, 
                aa.logo_ttd, 
                tte_lembaga.id AS tte_lembaga_id
                FROM
                sertifikat_nomor AS aa
                LEFT JOIN tte_lembaga ON aa.id = tte_lembaga.sertifikat_nomor_id
                WHERE
                aa.kode_faskes = '$id'");
        return $hsl->result();
}


function list_belumtteKlinik($lem_id){
      $hsl=$this->sina->query("SELECT
              a.fasyankes_id,
              jf.nama AS jenis_fasyankes,
              l.nama AS nama_lembaga,
              l.inisial AS kdLembaga,
              l.logo,
              dbfaskes.data_klinik.nama_klinik,
              dbfaskes.data_klinik.alamat_faskes,
              dbfaskes.kecamatan.nama_camat,
              dbfaskes.propinsi.nama_prop,
              dbfaskes.kota.nama_kota,
              db_akreditasi_non_rs.status_rekomendasi.id,
              db_akreditasi_non_rs.status_rekomendasi.nama AS capayan
              FROM
              db_akreditasi_non_rs.pengajuan_usulan_survei AS a
              LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
              LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
              LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
              LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
              LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
              LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
              LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
              LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
              LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
              LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
              LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
              LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
              LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
              LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
              LEFT JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
              LEFT JOIN dbfaskes.kecamatan ON dbfaskes.data_klinik.id_camat = dbfaskes.kecamatan.id_camat
              LEFT JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
              LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
              LEFT JOIN db_akreditasi_non_rs.tte_lembaga ON a.fasyankes_id = db_akreditasi_non_rs.tte_lembaga.id_faskes
              LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
              INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
              WHERE
              pk.status_persetujuan = 1 AND
              dd.status_direktur = 1 AND
              db_akreditasi_non_rs.tte_lembaga.id_faskes IS NULL AND
              ddd.id_faskes IS NULL AND
              jf.nama = 'klinik' AND
              l.inisial = '$lem_id'");
      return $hsl->result();
}
function list_sudahtteKlinik($lem_id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                dbfaskes.data_klinik.nama_klinik,
                dbfaskes.data_klinik.alamat_faskes,
                dbfaskes.kecamatan.nama_camat,
                dbfaskes.propinsi.nama_prop,
                dbfaskes.kota.nama_kota,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
                LEFT JOIN dbfaskes.kecamatan ON dbfaskes.data_klinik.id_camat = dbfaskes.kecamatan.id_camat
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga AS ccc ON a.fasyankes_id = ccc.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                pk.status_persetujuan = 1 AND
                dd.status_direktur = 1 AND
                ccc.status_tte = 1 AND
                jf.nama = 'klinik' AND
                l.inisial = '$lem_id'");
        return $hsl->result();
}





function list_belumttePuskesmas($lem_id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan,
                pskms.`name` AS nama_klinik,
                pskms.alamat AS alamat_faskes,
                pskms.kecamatan_nama AS nama_camat,
                pskms.provinsi_nama AS nama_prop,
                pskms.kabkot_nama AS nama_kota,
                nono.id AS idno
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.puskesmas_pusdatin AS pskms ON a.fasyankes_id = pskms.kode_sarana
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga ON a.fasyankes_id = db_akreditasi_non_rs.tte_lembaga.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                LEFT JOIN db_akreditasi_non_rs.sertifikat_nomor AS nono ON a.fasyankes_id = nono.kode_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id
                WHERE
                pk.status_persetujuan = 1 
                AND dd.status_direktur = 1 
                AND db_akreditasi_non_rs.tte_lembaga.id_faskes IS NULL 
                AND ddd.id_faskes IS NULL AND
                jf.nama = 'Pusat Kesehatan Masyarakat' AND
                l.inisial = '$lem_id'");
        return $hsl->result();
}

function list_sudahttePuskesmas($lem_id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan,
                pskms.name AS nama_klinik,
                pskms.alamat AS alamat_faskes,
                pskms.kecamatan_nama AS nama_camat,
                pskms.provinsi_nama AS nama_prop,
                pskms.kabkot_nama AS nama_kota
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.puskesmas_pusdatin AS pskms ON a.fasyankes_id = pskms.kode_sarana
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga AS cccc ON a.fasyankes_id = cccc.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                pk.status_persetujuan = 1 
                AND dd.status_direktur = 1 
                AND cccc.status_tte = 1 
                AND jf.nama = 'Pusat Kesehatan Masyarakat' AND
                l.inisial = '$lem_id'");
        return $hsl->result();
}


function list_belumttePuskesmasdir(){
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes,
                cc.status_tte,
                lpa.nama
                FROM
                sertifikat_nomor_puskesmas AS bb
                LEFT JOIN tte_lembaga_puskesmas AS cc ON bb.id = cc.sertifikat_nomor_puskesmas_id
                LEFT JOIN lpa ON bb.kdlembaga = lpa.inisial
                LEFT JOIN tte_dirjen ON cc.id = tte_dirjen.tte_lembaga_puskesmas_id 
                WHERE
                bb.jenis_faskes = 'Pusat Kesehatan Masyarakat' 
                AND cc.status_tte = '1'
                AND tte_dirjen.status_tte IS NULL");
        return $hsl->result();
}
function list_sudahttePuskesmasdir($faskes,$status){
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes,
                cc.status_tte,
                lpa.nama
                FROM
                sertifikat_nomor_puskesmas AS bb
                LEFT JOIN tte_lembaga_puskesmas AS cc ON bb.kode_faskes = cc.id_faskes
                LEFT JOIN lpa ON bb.kdlembaga = lpa.inisial
                LEFT JOIN tte_dirjen ON cc.id_faskes = tte_dirjen.id_faskes 
                WHERE
                bb.jenis_faskes = '$faskes' 
                AND cc.status_tte = '$status'
                AND tte_dirjen.status_tte = 1");
        return $hsl->result();
}


function list_belumttedir($faskes,$status){
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes,
                cc.status_tte,
                lpa.nama,
                cc.status_tte
                FROM
                sertifikat_nomor AS bb
                LEFT JOIN tte_lembaga AS cc ON bb.kode_faskes = cc.id_faskes
                LEFT JOIN tte_direktur ON cc.id_faskes = tte_direktur.id_faskes
                LEFT JOIN lpa ON bb.kdlembaga = lpa.inisial 
                WHERE
                bb.jenis_faskes = '$faskes' 
                AND cc.status_tte = '$status'
                AND tte_direktur.status_tte IS NULL
                GROUP BY
                cc.id_faskes");
        return $hsl->result();
}
function list_sudahttedire($faskes,$status){
        $hsl=$this->sina->query("SELECT
                bb.id,
                bb.nama_faskes,
                bb.alamat,
                bb.kode_faskes,
                bb.jenis_faskes,
                bb.nomor_surat,
                bb.capayan,
                cc.id_faskes,
                cc.status_tte,
                lpa.nama 
                FROM
                sertifikat_nomor AS bb
                LEFT JOIN tte_lembaga AS cc ON bb.id = cc.sertifikat_nomor_id
                LEFT JOIN tte_direktur ON cc.id = tte_direktur.tte_lembaga_id
                INNER JOIN lpa ON bb.kdlembaga = lpa.inisial
                WHERE
                bb.jenis_faskes = '$faskes' 
                AND cc.status_tte = '$status'
                AND tte_direktur.status_tte = 1");
        return $hsl->result();
}

function Detail_mutu($id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                dbfaskes.data_klinik.nama_klinik,
                dbfaskes.data_klinik.alamat_faskes,
                dbfaskes.kecamatan.nama_camat,
                dbfaskes.propinsi.nama_prop,
                dbfaskes.kota.nama_kota,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan 
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
                LEFT JOIN dbfaskes.kecamatan ON dbfaskes.data_klinik.id_camat = dbfaskes.kecamatan.id_camat
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga ON a.fasyankes_id = db_akreditasi_non_rs.tte_lembaga.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_direktur AS ddd ON a.fasyankes_id = ddd.id_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                a.fasyankes_id = $id");
        return $hsl->result();
}


function list_sudahttedir(){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                dbfaskes.data_klinik.nama_klinik,
                dbfaskes.data_klinik.alamat_faskes,
                dbfaskes.kecamatan.nama_camat,
                dbfaskes.propinsi.nama_prop,
                dbfaskes.kota.nama_kota,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
                LEFT JOIN dbfaskes.kecamatan ON dbfaskes.data_klinik.id_camat = dbfaskes.kecamatan.id_camat
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga FFF ON a.fasyankes_id = FFF.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                pk.status_persetujuan = 1 AND
                dd.status_direktur = 1 AND
                FFF.status_tte = 1 AND
                ddd.id_faskes IS NOT NULL AND
                jf.nama = 'klinik'");
        return $hsl->result();
}

function detailttedir($id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                dbfaskes.data_klinik.nama_klinik,
                dbfaskes.data_klinik.alamat_faskes,
                dbfaskes.kecamatan.nama_camat,
                dbfaskes.propinsi.nama_prop,
                dbfaskes.kota.nama_kota,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
                LEFT JOIN dbfaskes.kecamatan ON dbfaskes.data_klinik.id_camat = dbfaskes.kecamatan.id_camat
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga AS ccc ON a.fasyankes_id = ccc.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                pk.status_persetujuan = 1 AND
                dd.status_direktur = 1 AND
                ccc.status_tte = 1 AND
                jf.nama = 'klinik'
                AND a.fasyankes_id = '$id'");
        return $hsl->result();
}



function detailttedirpus($id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan,
                pskms.NAME AS nama_klinik,
                pskms.alamat AS alamat_faskes,
                pskms.kecamatan_nama AS nama_camat,
                pskms.provinsi_nama AS nama_prop,
                pskms.kabkot_nama AS nama_kota 
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.puskesmas_pusdatin AS pskms ON a.fasyankes_id = pskms.kode_sarana
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga AS cccc ON a.fasyankes_id = cccc.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                pk.status_persetujuan = 1 
                AND dd.status_direktur = 1 
                AND jf.nama = 'Pusat Kesehatan Masyarakat'
                AND a.fasyankes_id = '$id'");
        return $hsl->result();
}



function Sertifikat_detail($idp){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                dbfaskes.data_klinik.nama_klinik,
                dbfaskes.data_klinik.alamat_faskes,
                dbfaskes.kecamatan.nama_camat,
                dbfaskes.propinsi.nama_prop,
                dbfaskes.kota.nama_kota,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
                LEFT JOIN dbfaskes.kecamatan ON dbfaskes.data_klinik.id_camat = dbfaskes.kecamatan.id_camat
                LEFT JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga ON a.fasyankes_id = db_akreditasi_non_rs.tte_lembaga.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                pk.status_persetujuan = 1
                AND a.id = '$idp'");
        return $hsl->result();
}
function list_belumttePuskesmasDetail($id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan,
                pskms.name AS nama_klinik,
                pskms.alamat AS alamat_faskes,
                pskms.kecamatan_nama AS nama_camat,
                pskms.provinsi_nama AS nama_prop,
                pskms.kabkot_nama AS nama_kota,
                nono.nomor_surat AS idno
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.puskesmas_pusdatin AS pskms ON a.fasyankes_id = pskms.kode_sarana
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga ON a.fasyankes_id = db_akreditasi_non_rs.tte_lembaga.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                LEFT JOIN db_akreditasi_non_rs.sertifikat_nomor AS nono ON a.fasyankes_id = nono.kode_faskes
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                jf.nama = 'Pusat Kesehatan Masyarakat'
                AND a.fasyankes_id = '$id' ");
        return $hsl->result();
}


function data_tte_lembaga($id){
        $hsl=$this->sina->query("SELECT * FROM tte_lembaga WHERE id_faskes = '$id'");
        return $hsl->result();
}

function moni($id){
        $hsl=$this->sina->query("SELECT
                a.fasyankes_id,
                jf.nama AS jenis_fasyankes,
                l.nama AS nama_lembaga,
                l.inisial AS kdLembaga,
                l.logo,
                IFNULL( uuuu.nama_klinik, pskms.NAME ) nama,
                IFNULL( uuuu.alamat_faskes, pskms.alamat ) alamat,
                IFNULL( dbfaskes.kecamatan.nama_camat, pskms.kecamatan_nama ) kecamatan,
                IFNULL( dbfaskes.propinsi.nama_prop, pskms.provinsi_nama ) provinsi,
                IFNULL( dbfaskes.kota.nama_kota, pskms.kabkot_nama ) kabkot,
                db_akreditasi_non_rs.status_rekomendasi.id,
                db_akreditasi_non_rs.status_rekomendasi.nama AS capayan,
                ddd.id AS status_dirjen,
                FFF.status_tte 
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS a
                LEFT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = a.id
                LEFT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                LEFT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
                LEFT JOIN db_akreditasi_non_rs.trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
                LEFT JOIN db_akreditasi_non_rs.pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_ketua AS pk ON pr.id = pk.pengiriman_rekomendasi_id
                LEFT JOIN db_akreditasi_non_rs.persetujuan_direktur AS dd ON pk.id = dd.persetujuan_ketua_id
                LEFT JOIN db_akreditasi_non_rs.lpa AS l ON l.id = a.lpa_id
                LEFT JOIN db_akreditasi_non_rs.jenis_fasyankes AS jf ON a.jenis_fasyankes = jf.id
                LEFT JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT JOIN dbfaskes.data_klinik AS uuuu ON dbfaskes.trans_final.id_faskes = uuuu.id_faskes
                LEFT JOIN dbfaskes.kecamatan ON uuuu.id_camat = dbfaskes.kecamatan.id_camat
                LEFT JOIN dbfaskes.kota ON uuuu.id_kota = dbfaskes.kota.id_kota
                LEFT JOIN dbfaskes.propinsi ON uuuu.id_prov = dbfaskes.propinsi.id_prop
                LEFT JOIN db_akreditasi_non_rs.tte_lembaga AS FFF ON a.fasyankes_id = FFF.id_faskes
                LEFT JOIN db_akreditasi_non_rs.tte_dirjen AS ddd ON a.fasyankes_id = ddd.id_faskes
                LEFT JOIN dbfaskes.puskesmas_pusdatin AS pskms ON a.fasyankes_id = pskms.kode_sarana
                INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id 
                WHERE
                pk.status_persetujuan = 1 
                AND dd.status_direktur = 1 
                AND l.inisial = '$id'");
        return $hsl->result();
}

function book_no(){
        $hsl=$this->sina->query("SELECT aa.tgl_nomor, aa.nomor_awal, aa.nomor_akhir, aa.nomor_terpakai_terakhir FROM db_akreditasi_non_rs.nomor_surat AS aa WHERE aa.tgl_nomor = DATE(now()) ");
        return $hsl->result();
}

function sudah_tersedia($sedia){
        $hsl=$this->sina->query("SELECT
                count(jj.nomor_surat) AS cek
                FROM
                db_akreditasi_non_rs.sertifikat_nomor AS jj
                WHERE
                jj.nomor_surat = '$sedia'");
        return $hsl->row();
}
function ambil_ulang(){
        $hsl=$this->sina->query("SELECT
                MAX(jj.nomor_surat) AS terbesar
                FROM
                db_akreditasi_non_rs.sertifikat_nomor AS jj
                WHERE
                jj.tgl_surat = DATE(now())");
        return $hsl->result();
}

function jumlah_belum_tte(){
        $hsl=$this->sina->query("SELECT 
    (
        (
            SELECT COUNT(a.id) 
            FROM data_sertifikat AS a
            LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id
            LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
            LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
            LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
            WHERE b.id IS NOT NULL
            AND c.id IS NULL
            AND data_klinik.jenis_klinik = 'pratama'
        ) +
        (
            SELECT COUNT(a.id)
            FROM data_sertifikat AS a
            LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id
            LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
            LEFT OUTER JOIN dbfaskes.puskesmas_pusdatin ON a.kode_faskes = puskesmas_pusdatin.kode_sarana
            WHERE b.id IS NOT NULL
            AND c.id IS NULL
            AND a.jenis_faskes = 'Pusat kesehatan Masyarakat'
        ) +
        (
            SELECT COUNT(a.id)
            FROM data_sertifikat AS a
            LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id
            LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
            LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
            LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
            WHERE b.id IS NOT NULL
            AND c.id IS NULL
            AND data_labkes.jenis_lab LIKE '%Laboratorium Kesehatan%'
        )
    ) AS belumTTE
");
        return $hsl->row();
}


function jumlah_belum_tte_dua(){
        $hsl=$this->sina->query("
                SELECT 
    (
        (
            SELECT COUNT(a.id) 
            FROM data_sertifikat AS a
            LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id
            LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
            LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
            LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
            WHERE b.id IS NOT NULL
            AND c.id IS NULL
            AND data_klinik.jenis_klinik = 'Utama'
        ) +
        (
            SELECT
                        COUNT(a.id) utd
                        FROM
                        data_sertifikat AS a
                        LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id 
                        LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
                        LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
                        LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
                        WHERE 
                        b.id IS NOT NULL
                        AND  c.id IS NULL
                        AND a.jenis_faskes = 'Unit transfusi darah'
        ) +
        (
            SELECT COUNT(a.id)
            FROM data_sertifikat AS a
            LEFT JOIN tte_lpa AS b ON a.id = b.data_sertifikat_id
            LEFT JOIN tte_dirjen AS c ON b.id = c.tte_lpa_id
            LEFT OUTER JOIN dbfaskes.trans_final ON a.kode_faskes = dbfaskes.trans_final.kode_faskes
            LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
            WHERE b.id IS NOT NULL
            AND c.id IS NULL
            AND data_labkes.jenis_lab LIKE '%Laboratorium Medis%'
        )
    ) AS belumTTE
");
        return $hsl->row();
}


function jumlah_sudah_tte(){
        $hsl=$this->sina->query("SELECT
                COUNT(tte_lpa.id) sudahTTE
                FROM
                tte_lpa
                LEFT JOIN tte_dirjen ON tte_lpa.id = tte_dirjen.tte_lpa_id 
                WHERE
                tte_dirjen.id IS NOT NULL");
        return $hsl->row();
}


function input_data($table, $datas)
{
        return $this->sina->insert($table, $datas);
}
}