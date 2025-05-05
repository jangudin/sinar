<?php
class M_surat_tugas extends CI_Model{

        public function nol()
        {
                return [];
        }

        public function puskesmas($ket,$lpa)
        {
                $pkmbelum=$this->sina->query("SELECT
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id AS pengajuan_id,
                        dbfaskes.puskesmas_pusdatin.kode_sarana AS kode_faskes,
                        dbfaskes.puskesmas_pusdatin.kode_baru,
                        dbfaskes.puskesmas_pusdatin.`name` AS nama_fasyankes,
                        db_akreditasi_non_rs.lpa.inisial,
                        db_akreditasi_non_rs.surtug.id_pengajuan AS cek 
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei
                        INNER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        INNER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        INNER JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id
                        INNER JOIN dbfaskes.puskesmas_pusdatin ON dbfaskes.puskesmas_pusdatin.kode_sarana = db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id
                        LEFT JOIN db_akreditasi_non_rs.surtug ON db_akreditasi_non_rs.surtug.id_fasyankes = dbfaskes.puskesmas_pusdatin.kode_sarana
                        WHERE
                        db_akreditasi_non_rs.lpa.inisial = '$lpa' 
                        AND db_akreditasi_non_rs.surtug.id_fasyankes IS NULL 
                        AND db_akreditasi_non_rs.surveior_lapangan.no_surattugas IS NOT NULL
                        AND db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.status_usulan_id = 3
                        AND db_akreditasi_non_rs.surveior_lapangan.status_tte = 0");

                $pkmsudah=$this->sina->query("SELECT
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id AS pengajuan_id,
                        dbfaskes.puskesmas_pusdatin.kode_sarana AS kode_faskes  ,
                        dbfaskes.puskesmas_pusdatin.kode_baru,
                        dbfaskes.puskesmas_pusdatin.`name` AS nama_fasyankes,
                        db_akreditasi_non_rs.lpa.inisial,
                        db_akreditasi_non_rs.surtug.id_pengajuan AS cek 
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei
                        INNER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        INNER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        INNER JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id
                        INNER JOIN dbfaskes.puskesmas_pusdatin ON dbfaskes.puskesmas_pusdatin.kode_sarana = db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id
                        LEFT JOIN db_akreditasi_non_rs.surtug ON db_akreditasi_non_rs.surtug.id_fasyankes = dbfaskes.puskesmas_pusdatin.kode_sarana
                        WHERE
                        db_akreditasi_non_rs.lpa.inisial = '$lpa' 
                        AND db_akreditasi_non_rs.surtug.id_fasyankes IS NOT NULL 
                        AND db_akreditasi_non_rs.surveior_lapangan.no_surattugas IS NOT NULL");



                if ($ket == 'sudah'){
                        return $pkmsudah->result();
                }elseif ($ket == 'belum'){
                        return $pkmbelum->result();    
                }


        }

        public function klinik($lpa,$ket)
        {
                $belum=$this->sina->query("SELECT       
        *
                        FROM 
                        (SELECT 
                                pus.id as pengajuan_id,
                                pus.jenis_fasyankes,
                                tf.kode_faskes,
                                tf.kode_faskes_baru,
                                dk.nama_klinik as nama_fasyankes,
                                l.inisial,
                                s.id as cek
                                FROM 
                                pengajuan_usulan_survei pus 
                                LEFT JOIN 
                                penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id
                                LEFT JOIN 
                                berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                                LEFT JOIN 
                                kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
                                LEFT JOIN 
                                penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
                                LEFT JOIN 
                                surveior_lapangan sl ON sl.penetapan_tanggal_survei_id = pts.id 
                                LEFT JOIN 
                                dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
                                LEFT JOIN 
                                dbfaskes.data_klinik dk ON dk.id_faskes = tf.id_faskes 
                                LEFT JOIN 
                                surtug s ON s.id_pengajuan = pus.id
                                LEFT JOIN 
                                lpa l ON l.id = pus.lpa_id 
                                WHERE 
                                l.inisial = '$lpa' 
                                AND 
                                ppus.status_usulan_id = '3'
                                AND 
                                pus.jenis_fasyankes = '3'
                                AND 
                                sl.status_tte = '0' ) AS table_pertama
                        WHERE
                        table_pertama.cek IS NULL
                        ");
                $sudah=$this->sina->query("SELECT
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id as pengajuan_id,
                        dbfaskes.trans_final.kode_faskes,
                        dbfaskes.trans_final.kode_faskes_baru,
                        dbfaskes.data_klinik.nama_klinik as nama_fasyankes,
                        db_akreditasi_non_rs.lpa.inisial,
                        db_akreditasi_non_rs.surtug.id_pengajuan as cek 
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei
                        INNER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        INNER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        INNER JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id
                        INNER JOIN dbfaskes.trans_final ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id
                        INNER JOIN dbfaskes.data_klinik ON dbfaskes.data_klinik.id_faskes = dbfaskes.trans_final.id_faskes
                        LEFT JOIN db_akreditasi_non_rs.surtug ON db_akreditasi_non_rs.surtug.id_fasyankes = dbfaskes.trans_final.kode_faskes
                        WHERE
                        db_akreditasi_non_rs.lpa.inisial = '$lpa'
                        AND db_akreditasi_non_rs.surtug.id_fasyankes IS NOT NULL
                        ");

                // $sudah=$this->sina->query("");

                if ($ket == 'sudah'){
                        return $sudah->result();
                }elseif ($ket == 'belum'){
                        return $belum->result();    
                }   

              //  return $belum->result();    
        }

        public function labkes($lpa,$ket)
        {
                $belum=$this->sina->query("SELECT
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id AS pengajuan_id,
                        dbfaskes.trans_final.kode_faskes,
                        dbfaskes.trans_final.kode_faskes_baru,
                        dbfaskes.data_labkes.nama_lab AS nama_fasyankes,
                        db_akreditasi_non_rs.lpa.inisial,
                        db_akreditasi_non_rs.surtug.id_pengajuan AS cek 
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei
                        INNER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        INNER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        INNER JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id
                        INNER JOIN dbfaskes.trans_final ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id
                        INNER JOIN dbfaskes.data_labkes ON dbfaskes.data_labkes.id_faskes = dbfaskes.trans_final.id_faskes
                        LEFT JOIN db_akreditasi_non_rs.surtug ON db_akreditasi_non_rs.surtug.id_fasyankes = dbfaskes.trans_final.kode_faskes 
                        WHERE
                        db_akreditasi_non_rs.lpa.inisial = '$lpa' 
                        AND db_akreditasi_non_rs.surtug.id_fasyankes IS NULL
                        AND db_akreditasi_non_rs.surveior_lapangan.no_surattugas IS NOT NULL
                        AND db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.status_usulan_id = 3
                        AND db_akreditasi_non_rs.surveior_lapangan.status_tte = 0
                        ");
                $sudah=$this->sina->query("SELECT
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id AS pengajuan_id,
                        dbfaskes.trans_final.kode_faskes,
                        dbfaskes.trans_final.kode_faskes_baru,
                        dbfaskes.data_labkes.nama_lab AS nama_fasyankes,
                        db_akreditasi_non_rs.lpa.inisial,
                        db_akreditasi_non_rs.surtug.id_pengajuan AS cek 
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei
                        INNER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        INNER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        INNER JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id
                        INNER JOIN dbfaskes.trans_final ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id
                        INNER JOIN dbfaskes.data_labkes ON dbfaskes.data_labkes.id_faskes = dbfaskes.trans_final.id_faskes
                        LEFT JOIN db_akreditasi_non_rs.surtug ON db_akreditasi_non_rs.surtug.id_fasyankes = dbfaskes.trans_final.kode_faskes 
                        WHERE
                        db_akreditasi_non_rs.lpa.inisial = '$lpa' 
                        AND db_akreditasi_non_rs.surtug.id_fasyankes IS NOT NULL
                        ");

                // $sudah=$this->sina->query("");

                if ($ket == 'sudah'){
                        return $sudah->result();
                }elseif ($ket == 'belum'){
                        return $belum->result();    
                }   

              //  return $belum->result();    
        }

        public function utd($lpa,$ket)
        {
                $belum=$this->sina->query("SELECT
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id as pengajuan_id,
                        dbfaskes.trans_final.kode_faskes,
                        dbfaskes.trans_final.kode_faskes_baru,
                        dbfaskes.data_utd.nama_utd as nama_fasyankes,
                        db_akreditasi_non_rs.lpa.inisial,
                        db_akreditasi_non_rs.surtug.id_pengajuan as cek 
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei
                        INNER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        INNER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        INNER JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id
                        INNER JOIN dbfaskes.trans_final ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id
                        INNER JOIN dbfaskes.data_utd ON dbfaskes.data_utd.id_faskes = dbfaskes.trans_final.id_faskes
                        LEFT JOIN db_akreditasi_non_rs.surtug ON db_akreditasi_non_rs.surtug.id_fasyankes = dbfaskes.trans_final.kode_faskes
                        WHERE
                        db_akreditasi_non_rs.lpa.inisial = '$lpa'
                        AND db_akreditasi_non_rs.surtug.id_fasyankes IS NULL
                        AND db_akreditasi_non_rs.surveior_lapangan.no_surattugas IS NOT NULL
                        AND db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.status_usulan_id = 3
                        AND db_akreditasi_non_rs.surveior_lapangan.status_tte = 0
                        ");
                $sudah=$this->sina->query("SELECT
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id as pengajuan_id,
                        dbfaskes.trans_final.kode_faskes,
                        dbfaskes.trans_final.kode_faskes_baru,
                        dbfaskes.data_utd.nama_utd as nama_fasyankes,
                        db_akreditasi_non_rs.lpa.inisial,
                        db_akreditasi_non_rs.surtug.id_pengajuan as cek 
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei
                        INNER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        INNER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        INNER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        INNER JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id
                        INNER JOIN dbfaskes.trans_final ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id
                        INNER JOIN dbfaskes.data_utd ON dbfaskes.data_utd.id_faskes = dbfaskes.trans_final.id_faskes
                        LEFT JOIN db_akreditasi_non_rs.surtug ON db_akreditasi_non_rs.surtug.id_fasyankes = dbfaskes.trans_final.kode_faskes
                        WHERE
                        db_akreditasi_non_rs.lpa.inisial = '$lpa'
                        AND db_akreditasi_non_rs.surtug.id_fasyankes IS NOT NULL
                        ");

                // $sudah=$this->sina->query("");

                if ($ket == 'sudah'){
                        return $sudah->result();
                }elseif ($ket == 'belum'){
                        return $belum->result();    
                }   

              //  return $belum->result();    
        }


        public function printsurat($id)
        {
                $hsl=$this->sina->query("
                        SELECT
                        sl.id,
                        sl.no_surattugas,
                        pus.id as pengajuan_id,
                        us.nama AS surveior_satu,
                        us.no_hp AS no_hp_satu,
                        sl.jabatan_surveior_id_satu,
                        us2.nama AS surveior_dua,
                        us2.no_hp AS no_hp_dua,
                        sl.jabatan_surveior_id_dua,
                        usbd.nama_bidang AS bidang_surveior_satu,
                        usbd2.nama_bidang AS bidang_surveior_dua,
                        pus.fasyankes_id AS kode_faskes,
                        dbfaskes.puskesmas_pusdatin.`name` AS nama_fasyankes,
                        dbfaskes.puskesmas_pusdatin.alamat_sertifikat AS alamat,
                        dbfaskes.puskesmas_pusdatin.provinsi_nama AS prov_faskes,
                        prov.nama_prop AS prov,
                        prov2.nama_prop AS prov2,
                        pus.metode_survei_id AS msi,
                        lpa.nama AS nama_lpa,
                        lpa.kop AS kop,
                        lpa.logo,
                        lpa.inisial
                        FROM
                        db_akreditasi_non_rs.pengajuan_usulan_survei AS pus
                        RIGHT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
                        RIGHT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                        RIGHT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                        RIGHT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                        RIGHT JOIN db_akreditasi_non_rs.surveior_lapangan AS sl ON sl.penetapan_tanggal_survei_id = pts.id
                        LEFT JOIN db_akreditasi_non_rs.user_surveior AS us ON us.id = sl.id_surveior_satu_baru
                        LEFT JOIN db_akreditasi_non_rs.user_surveior AS us2 ON us2.id = sl.id_surveior_dua_baru
                        LEFT JOIN db_akreditasi_non_rs.user_surveior_bidang_detail AS usbd ON usbd.id_user_surveior = us.id
                        LEFT JOIN db_akreditasi_non_rs.user_surveior_bidang_detail AS usbd2 ON usbd2.id_user_surveior = us2.id
                        JOIN dbfaskes.puskesmas_pusdatin ON pus.fasyankes_id = dbfaskes.puskesmas_pusdatin.kode_sarana 
                        JOIN dbfaskes.propinsi AS prov ON us.provinsi_id = prov.id_prop
                        JOIN dbfaskes.propinsi AS prov2 ON us2.provinsi_id = prov2.id_prop 
                        JOIN db_akreditasi_non_rs.lpa ON pus.lpa_id = lpa.id 
                        WHERE
                        usbd.id_fasyankes_surveior = pus.jenis_fasyankes 
                        AND usbd.is_checked = '1' 
                        AND usbd2.is_checked = '1' 
                        AND usbd2.id_fasyankes_surveior = pus.jenis_fasyankes
                        AND pus.id ='$id'
                        LIMIT 1");
                return $hsl->result();
        }


        public function printsuratlab($id_rek)
        {
                $hsl=$this->sina->query("
                        SELECT
                        dbfaskes.trans_final.kode_faskes,
                        db_akreditasi_non_rs.surveior_lapangan.no_surattugas,
                        db_akreditasi_non_rs.pengajuan_usulan_survei.id as pengajuan_id,
                        db_akreditasi_non_rs.pengajuan_usulan_survei.metode_survei_id AS msi,
                        db_akreditasi_non_rs.pengajuan_usulan_survei.jenis_fasyankes,
                        db_akreditasi_non_rs.surveior_lapangan.jabatan_surveior_id_satu,
                        db_akreditasi_non_rs.surveior_lapangan.jabatan_surveior_id_dua,
                        dbfaskes.data_labkes.nama_lab as nama_fasyankes,
                        dbfaskes.data_labkes.alamat_faskes as alamat,
                        us1.nama AS surveior_satu,
                        usbd1.nama_bidang AS bidang_surveior_satu,
                        p1.nama_prop AS prov,
                        us1.no_hp AS no_hp_satu,
                        us2.nama AS surveior_dua,
                        usbd2.nama_bidang AS bidang_surveior_dua,
                        p2.nama_prop AS prov2,
                        us2.no_hp AS no_hp_dua,
                        lpa.nama AS nama_lpa,
                        lpa.kop AS kop,
                        lpa.logo,
                        lpa.inisial 
                        FROM
                        dbfaskes.trans_final
                        LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.data_labkes.id_faskes = dbfaskes.trans_final.id_faskes
                        LEFT OUTER JOIN db_akreditasi_non_rs.pengajuan_usulan_survei ON db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id = dbfaskes.trans_final.kode_faskes
                        LEFT OUTER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                        LEFT OUTER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                        LEFT OUTER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                        LEFT OUTER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                        LEFT OUTER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                        LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior us1 ON us1.id = db_akreditasi_non_rs.surveior_lapangan.id_surveior_satu_baru
                        LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior us2 ON us2.id = db_akreditasi_non_rs.surveior_lapangan.id_surveior_dua_baru
                        LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior_bidang_detail usbd1 ON us1.id = usbd1.id_user_surveior
                        LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior_bidang_detail usbd2 ON us2.id = usbd2.id_user_surveior
                        LEFT OUTER JOIN dbfaskes.propinsi p1 ON p1.id_prop = us1.provinsi_id
                        LEFT OUTER JOIN dbfaskes.propinsi p2 ON p2.id_prop = us2.provinsi_id
                        LEFT JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id 
                        WHERE
                        dbfaskes.trans_final.kode_faskes_baru != '' 
                        AND usbd1.is_checked = 1 
                        AND usbd2.is_checked = 1 
                        AND db_akreditasi_non_rs.pengajuan_usulan_survei.id = '$id_rek'
                        -- AND usbd1.id_fasyankes_surveior = 3 
                        -- AND usbd2.id_fasyankes_surveior = 3
                        LIMIT 1
                        ");
return $hsl->result();
}


public function printsuratklinik($id_rek)
{
        $hsl=$this->sina->query("
                SELECT
                dbfaskes.trans_final.kode_faskes,
                db_akreditasi_non_rs.surveior_lapangan.no_surattugas,
                db_akreditasi_non_rs.pengajuan_usulan_survei.id as pengajuan_id,
                db_akreditasi_non_rs.pengajuan_usulan_survei.metode_survei_id AS msi,
                db_akreditasi_non_rs.pengajuan_usulan_survei.jenis_fasyankes,
                db_akreditasi_non_rs.surveior_lapangan.jabatan_surveior_id_satu,
                db_akreditasi_non_rs.surveior_lapangan.jabatan_surveior_id_dua,
                dbfaskes.data_klinik.nama_klinik as nama_fasyankes,
                dbfaskes.data_klinik.alamat_faskes_versi_akreditasi as alamat,
                us1.nama AS surveior_satu,
                usbd1.nama_bidang AS bidang_surveior_satu,
                p1.nama_prop AS prov,
                us1.no_hp AS no_hp_satu,
                us2.nama AS surveior_dua,
                usbd2.nama_bidang AS bidang_surveior_dua,
                p2.nama_prop AS prov2,
                us2.no_hp AS no_hp_dua,
                lpa.nama AS nama_lpa,
                lpa.kop AS kop,
                lpa.logo,
                lpa.inisial 
                FROM
                dbfaskes.trans_final
                LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.data_klinik.id_faskes = dbfaskes.trans_final.id_faskes
                LEFT OUTER JOIN db_akreditasi_non_rs.pengajuan_usulan_survei ON db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT OUTER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                LEFT OUTER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior us1 ON us1.id = db_akreditasi_non_rs.surveior_lapangan.id_surveior_satu_baru
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior us2 ON us2.id = db_akreditasi_non_rs.surveior_lapangan.id_surveior_dua_baru
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior_bidang_detail usbd1 ON us1.id = usbd1.id_user_surveior
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior_bidang_detail usbd2 ON us2.id = usbd2.id_user_surveior
                LEFT OUTER JOIN dbfaskes.propinsi p1 ON p1.id_prop = us1.provinsi_id
                LEFT OUTER JOIN dbfaskes.propinsi p2 ON p2.id_prop = us2.provinsi_id
                LEFT JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id 
                WHERE
                dbfaskes.trans_final.kode_faskes_baru != '' 
                AND usbd1.is_checked = 1 
                AND usbd2.is_checked = 1 
                AND db_akreditasi_non_rs.pengajuan_usulan_survei.id = '$id_rek'
                AND usbd1.id_fasyankes_surveior = 3 
                AND usbd2.id_fasyankes_surveior = 3
                LIMIT 1
                ");
        return $hsl->result();
}

public function printsuratutd($id_rek)
{
        $hsl=$this->sina->query("
                SELECT
                dbfaskes.trans_final.kode_faskes,
                db_akreditasi_non_rs.surveior_lapangan.no_surattugas,
                db_akreditasi_non_rs.pengajuan_usulan_survei.id as pengajuan_id,
                db_akreditasi_non_rs.pengajuan_usulan_survei.metode_survei_id AS msi,
                db_akreditasi_non_rs.pengajuan_usulan_survei.jenis_fasyankes,
                db_akreditasi_non_rs.surveior_lapangan.jabatan_surveior_id_satu,
                db_akreditasi_non_rs.surveior_lapangan.jabatan_surveior_id_dua,
                dbfaskes.data_utd.nama_utd as nama_fasyankes,
                dbfaskes.data_utd.alamat_faskes as alamat,
                us1.nama AS surveior_satu,
                usbd1.nama_bidang AS bidang_surveior_satu,
                p1.nama_prop AS prov,
                us1.no_hp AS no_hp_satu,
                us2.nama AS surveior_dua,
                usbd2.nama_bidang AS bidang_surveior_dua,
                p2.nama_prop AS prov2,
                us2.no_hp AS no_hp_dua,
                lpa.nama AS nama_lpa,
                lpa.kop AS kop,
                lpa.logo,
                lpa.inisial 
                FROM
                dbfaskes.trans_final
                LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.data_utd.id_faskes = dbfaskes.trans_final.id_faskes
                LEFT OUTER JOIN db_akreditasi_non_rs.pengajuan_usulan_survei ON db_akreditasi_non_rs.pengajuan_usulan_survei.fasyankes_id = dbfaskes.trans_final.kode_faskes
                LEFT OUTER JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei ON db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id = db_akreditasi_non_rs.pengajuan_usulan_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.berkas_usulan_survei ON db_akreditasi_non_rs.berkas_usulan_survei.penerimaan_pengajuan_usulan_survei_id = db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.kelengkapan_berkas ON db_akreditasi_non_rs.kelengkapan_berkas.berkas_usulan_survei_id = db_akreditasi_non_rs.berkas_usulan_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.penetapan_tanggal_survei ON db_akreditasi_non_rs.penetapan_tanggal_survei.kelengkapan_berkas_id = db_akreditasi_non_rs.kelengkapan_berkas.id
                LEFT OUTER JOIN db_akreditasi_non_rs.surveior_lapangan ON db_akreditasi_non_rs.surveior_lapangan.penetapan_tanggal_survei_id = db_akreditasi_non_rs.penetapan_tanggal_survei.id
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior us1 ON us1.id = db_akreditasi_non_rs.surveior_lapangan.id_surveior_satu_baru
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior us2 ON us2.id = db_akreditasi_non_rs.surveior_lapangan.id_surveior_dua_baru
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior_bidang_detail usbd1 ON us1.id = usbd1.id_user_surveior
                LEFT OUTER JOIN db_akreditasi_non_rs.user_surveior_bidang_detail usbd2 ON us2.id = usbd2.id_user_surveior
                LEFT OUTER JOIN dbfaskes.propinsi p1 ON p1.id_prop = us1.provinsi_id
                LEFT OUTER JOIN dbfaskes.propinsi p2 ON p2.id_prop = us2.provinsi_id
                LEFT JOIN db_akreditasi_non_rs.lpa ON db_akreditasi_non_rs.pengajuan_usulan_survei.lpa_id = db_akreditasi_non_rs.lpa.id 
                WHERE
                dbfaskes.trans_final.kode_faskes_baru != '' 
                AND usbd1.is_checked = 1 
                AND usbd2.is_checked = 1 
                AND db_akreditasi_non_rs.pengajuan_usulan_survei.id = '$id_rek'
                AND usbd1.id_fasyankes_surveior = 6
                AND usbd2.id_fasyankes_surveior = 6
                LIMIT 1
                ");
        return $hsl->result();
}

public function tgl_survei($id)
{
        $hsl=$this->sina->query("SELECT
                sl.id,
                pusd.tanggal_survei,
                pus.fasyankes_id AS kode_faskes
                FROM
                db_akreditasi_non_rs.pengajuan_usulan_survei AS pus
                LEFT JOIN db_akreditasi_non_rs.pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
                RIGHT JOIN db_akreditasi_non_rs.penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
                RIGHT JOIN db_akreditasi_non_rs.berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
                RIGHT JOIN db_akreditasi_non_rs.kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
                RIGHT JOIN db_akreditasi_non_rs.penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
                RIGHT JOIN db_akreditasi_non_rs.surveior_lapangan AS sl ON sl.penetapan_tanggal_survei_id = pts.id
                LEFT JOIN db_akreditasi_non_rs.user_surveior AS us ON us.id = sl.id_surveior_satu_baru
                LEFT JOIN db_akreditasi_non_rs.user_surveior AS us2 ON us2.id = sl.id_surveior_dua_baru
                LEFT JOIN db_akreditasi_non_rs.user_surveior_bidang_detail AS usbd ON usbd.id_user_surveior = us.id
                LEFT JOIN db_akreditasi_non_rs.user_surveior_bidang_detail AS usbd2 ON usbd2.id_user_surveior = us2.id
                WHERE
                usbd.id_fasyankes_surveior = pus.jenis_fasyankes 
                AND usbd.is_checked = '1' 
                AND usbd2.is_checked = '1' 
                AND usbd2.id_fasyankes_surveior = pus.jenis_fasyankes 
                AND db_akreditasi_non_rs.pus.id = '$id'");
        return $hsl->result();
}
public function narahubung($kd)
{
        $hsl=$this->sina->query("SELECT
                narahubung.fasyankes_id, 
                narahubung.nama_narahubung, 
                narahubung.no_telepon_narahubung
                FROM
                narahubung
                WHERE
                narahubung.fasyankes_id = '$kd'");
        return $hsl->result();
}


}