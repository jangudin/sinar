<?php
class Dashboard_tte extends CI_Model
{

    function tampil_rekomendasi($lem_id)
    {
        $hsl = $this->db->query("SELECT
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
            lembaga_akreditasi_id = '$lem_id' 
            AND rekomendasi.tanggal_surat_pengajuan_sertifikat > '2022-12-08'
            AND db_akreditasi.Sertifikat_progres1.lembaga IS NULL
            AND rekomendasi.tanggal_terbit_sertifikat IS NOT NULL 
            AND rekomendasi.tanggal_kadaluarsa_sertifikat IS NOT NULL
            -- AND db_akreditasi.sertifikasi.rekomendasi_id IS NULL
            ");
        return $hsl;
    }


    function Monitoring($faskes)
    {
        $pkm = $this->sina->query("
            SELECT
            ppd.`name` AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            pusd.tanggal_survei,
            DATEDIFF(pk.created_at, pusd.tanggal_survei) katim,
            DATEDIFF(pd.created_at, pk.created_at) direktur,
            DATEDIFF(ds.updated_at, ds.created_at) adminNomor,
            DATEDIFF(tl.created_at, ds.updated_at) lpa,
            DATEDIFF(td.created_at, tl.created_at) dirjen
            FROM
            pengajuan_usulan_survei AS pus
            INNER JOIN  dbfaskes.puskesmas_pusdatin AS ppd ON pus.fasyankes_id = ppd.kode_sarana
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
            WHERE pus.fasyankes_id IS NOT NULL
            GROUP BY
            pus.id
            ORDER BY
            pusd.tanggal_survei DESC");
        $klinik = $this->sina->query("SELECT
            dk.nama_klinik AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            pusd.tanggal_survei,
            DATEDIFF(pk.created_at, pusd.tanggal_survei) katim,
            DATEDIFF(pd.created_at, pk.created_at) direktur,
            DATEDIFF(ds.updated_at, ds.created_at) adminNomor,
            DATEDIFF(tl.created_at, ds.updated_at) lpa,
            DATEDIFF(td.created_at, tl.created_at) dirjen
            FROM
            pengajuan_usulan_survei AS pus
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_klinik AS dk ON tf.id_faskes = dk.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
            WHERE pus.fasyankes_id IS NOT NULL AND
            dk.nama_klinik IS NOT NULL
            GROUP BY
            pus.id
            ORDER BY
            pusd.tanggal_survei DESC
            ");

        $labkes = $this->sina->query("SELECT
            dl.nama_lab AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            pusd.tanggal_survei,
            DATEDIFF(pk.created_at, pusd.tanggal_survei) katim,
            DATEDIFF(pd.created_at, pk.created_at) direktur,
            DATEDIFF(ds.updated_at, ds.created_at) adminNomor,
            DATEDIFF(tl.created_at, ds.updated_at) lpa,
            DATEDIFF(td.created_at, tl.created_at) dirjen
            FROM
            pengajuan_usulan_survei AS pus
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_labkes AS dl ON tf.id_faskes = dl.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
            WHERE pus.fasyankes_id IS NOT NULL AND
            dl.nama_lab IS NOT NULL
            GROUP BY
            pus.id
            ORDER BY
            pusd.tanggal_survei DESC
            ");

        if ($faskes == null) {
            return [];
        } elseif ($faskes == "pkm") {
            return $pkm->result();
        } elseif ($faskes == "klinik") {
            return $klinik->result();
        } elseif ($faskes == "Labkes") {
            return $labkes->result();
        }
    }

function MonitoringDirjen($faskes, $jenis)
{
     if ($faskes === null) {
            return [];
        }
    if ($faskes === 'Pusat Kesehatan Masyarakat') {
    // Query untuk Pusat Kesehatan Masyarakat
    $sql = "
        SELECT
            ppd.`name` AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
            ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
            DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) AS rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) AS katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) AS direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) AS adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) AS lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) AS dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
            tl.created_at AS ttelpa,
            td.created_at AS TTD
        FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN dbfaskes.puskesmas_pusdatin AS ppd ON pus.fasyankes_id = ppd.kode_sarana
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
        WHERE
            pus.fasyankes_id IS NOT NULL
            AND td.id IS NULL
        GROUP BY
            pus.id
        ORDER BY
            pusd.tanggal_survei DESC
    ";
     $query = $this->sina->query($sql);
     return $query->result();
     } elseif ($faskes === 'Klinik') {
        if ($jenis === null) {
                return []; // Jika jenis tidak disediakan, kembalikan array kosong
            }

    $jenis_escape = $this->sina->escape($jenis);
    $sql = "
        SELECT
            dk.nama_klinik AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
            ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
            DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) AS rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) AS katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) AS direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) AS adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) AS lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) AS dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
            tl.created_at AS ttelpa,
            td.created_at AS TTD
        FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_klinik AS dk ON tf.id_faskes = dk.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
        WHERE
            pus.fasyankes_id IS NOT NULL
            AND dk.nama_klinik IS NOT NULL
            AND td.id IS NULL
            AND dk.jenis_klinik = '$jenis'
        GROUP BY
            pus.id
        ORDER BY
            pusd.tanggal_survei DESC";
            $query = $this->sina->query($sql);
            return $query->result();

        } elseif ($faskes === 'Labkes') {

    // Query untuk Laboratorium Kesehatan
        if ($jenis === null) {
                return []; // Bila jenis tidak ada kembalikan kosong
            }
            // Escape input jenis
            $jenis_escape = $this->sina->escape($jenis);

            // Kondisi tambahan untuk Laboratorium Kesehatan berdasarkan $jenis
                $whereJenis = '';
            if (strtolower($jenis) === 'laboratorium medis') {
                $whereJenis = " AND LEFT(dl.jenis_pelayanan, 18) = 'Laboratorium Medis' ";
            } elseif (strtolower($jenis) === 'laboratorium kesmas') {
                $whereJenis = " AND LEFT(dl.jenis_pelayanan, 18) != 'Laboratorium Medis' ";
            }


    $sql ="
         SELECT
            dl.nama_lab AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
            tl.created_at AS ttelpa,
            ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
            DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) AS rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) AS katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) AS direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) AS adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) AS lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) AS dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
            tl.created_at AS ttelpa,
            td.created_at AS TTD
        FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_labkes AS dl ON tf.id_faskes = dl.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
        WHERE
            pus.fasyankes_id IS NOT NULL
            AND dl.nama_lab IS NOT NULL
            AND td.id IS NULL
            $whereJenis
        GROUP BY
            pus.id
        ORDER BY
            pusd.tanggal_survei DESC
    ";
    $last_query = $this->sina->last_query();

    // Tampilkan query untuk debugging
    echo "<pre>Query terakhir: " . $last_query . "</pre>";

    // $query = $this->sina->query($sql);
    // return $query->result();
     } elseif ($faskes === 'Unit Transfusi Darah') {
    // Query untuk Unit Transfusi Darah
    $sql = "
        SELECT
            du.nama_utd AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
            tl.created_at AS ttelpa,
            ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
            DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) AS rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) AS katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) AS direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) AS adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) AS lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) AS dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
            tl.created_at AS ttelpa,
            td.created_at AS TTD
        FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_utd AS du ON tf.id_faskes = du.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
        WHERE
            pus.fasyankes_id IS NOT NULL
            AND du.nama_utd IS NOT NULL
            AND td.id IS NULL
        GROUP BY
            pus.id
        ORDER BY
            pusd.tanggal_survei DESC
    ";

    // Mengembalikan hasil berdasarkan jenis faskes
    $query = $this->sina->query($sql);
            return $query->result();

        } else {
            // Jika faskes tidak dikenal, kembalikan array kosong
            return [];
        }
    }





    function Monitoringfaskes($faskes, $lpaid)
    {
        $pkm = $this->sina->query("
            SELECT
            ppd.`name` AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            #pls.created_at AS tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
            pk.created_at,
            ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
            DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
            tl.created_at AS ttelpa,
            td.created_at AS TTD
            FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN  dbfaskes.puskesmas_pusdatin AS ppd ON pus.fasyankes_id = ppd.kode_sarana
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id

            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
            WHERE pus.fasyankes_id IS NOT NULL
            AND td.id IS NULL
            AND ds.lpa = '$lpaid'
            GROUP BY
            pus.id
            ORDER BY
            pusd.tanggal_survei DESC");
        $klinik = $this->sina->query("SELECT
            dk.nama_klinik AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            -- pusd.tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
             ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
             DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
             tl.created_at AS ttelpa,
            td.created_at AS TTD
            FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_klinik AS dk ON tf.id_faskes = dk.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
            WHERE pus.fasyankes_id IS NOT NULL AND
            dk.nama_klinik IS NOT NULL
            AND td.id IS NULL
            AND ds.lpa = '$lpaid'
            GROUP BY
            pus.id
            ORDER BY
            pusd.tanggal_survei DESC
            ");
        $labkes = $this->sina->query("SELECT
            dl.nama_lab AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            -- pusd.tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
            tl.created_at AS ttelpa,
             ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
             DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
            tl.created_at AS ttelpa,
            td.created_at AS TTD
            FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_labkes AS dl ON tf.id_faskes = dl.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
            WHERE pus.fasyankes_id IS NOT NULL AND
            dl.nama_lab IS NOT NULL
            AND td.id IS NULL
            AND ds.lpa = '$lpaid'
            GROUP BY
            pus.id
            ORDER BY
            pusd.tanggal_survei DESC
            ");

        $utd = $this->sina->query("
                    SELECT
            du.nama_utd AS NamaFaskes,
            pus.fasyankes_id AS kode_faskes,
            pus.fasyankes_id_baru AS kode_faskes_baru,
            (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id) AS tanggal_survei,
            -- pusd.tanggal_survei,
            pr.created_at AS surv,
            pk.created_at AS peka,
            pd.created_at AS dir,
            tl.created_at AS ttelpa,
             ds.tgl_nomor_surat,
            lpaa.inisial AS nmLPA,
             DATEDIFF(IFNULL(pr.created_at, date(NOW())), (SELECT MAX(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail AS pusd2 WHERE pusd2.pengajuan_usulan_survei_id = pus.id)) rekom,
            DATEDIFF(IFNULL(pk.created_at, date(NOW())), pr.created_at) katim,
            DATEDIFF(IFNULL(pd.created_at, date(NOW())), pk.created_at) direktur,
            DATEDIFF(IFNULL(ds.tgl_nomor_surat, date(NOW())), ds.created_at) adminNomor,
            DATEDIFF(IFNULL(tl.created_at, date(NOW())), ds.tgl_nomor_surat) lpa,
            DATEDIFF(IFNULL(td.created_at, date(NOW())), tl.created_at) dirjen,
            pk.id AS idk,
            pd.id AS idd,
            tl.id AS idl,
            td.id AS iddir,
            tl.created_at AS ttelpa,
            td.created_at AS TTD
            FROM
            pengajuan_usulan_survei AS pus
            JOIN lpa AS lpaa ON pus.lpa_id = lpaa.id
            INNER JOIN dbfaskes.trans_final AS tf ON pus.fasyankes_id = tf.kode_faskes
            INNER JOIN dbfaskes.data_utd AS du ON tf.id_faskes = du.id_faskes
            RIGHT JOIN pengajuan_usulan_survei_detail AS pusd ON pus.id = pusd.pengajuan_usulan_survei_id
            RIGHT JOIN penerimaan_pengajuan_usulan_survei AS ppus ON ppus.pengajuan_usulan_survei_id = pus.id
            RIGHT JOIN berkas_usulan_survei AS bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
            RIGHT JOIN kelengkapan_berkas AS kb ON kb.berkas_usulan_survei_id = bus.id
            RIGHT JOIN penetapan_tanggal_survei AS pts ON pts.kelengkapan_berkas_id = kb.id
            RIGHT JOIN trans_final_ep_surveior AS tfes ON tfes.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN pengiriman_laporan_survei AS pls ON pls.penetapan_tanggal_survei_id = pts.id
            RIGHT JOIN penetapan_verifikator AS pv ON pv.pengiriman_laporan_survei_id = pls.id
            RIGHT JOIN trans_final_ep_verifikator AS tfev ON tfev.penetapan_verifikator_id = pv.id
            RIGHT JOIN pengiriman_rekomendasi AS pr ON pr.trans_final_ep_verifikator_id = tfev.id
            LEFT JOIN persetujuan_ketua AS pk ON pk.pengiriman_rekomendasi_id = pr.id
            LEFT JOIN persetujuan_direktur AS pd ON pd.persetujuan_ketua_id = pk.id
            LEFT JOIN data_sertifikat AS ds ON ds.persetujuan_direktur_id = pd.id
            LEFT JOIN tte_lpa AS tl ON tl.data_sertifikat_id = ds.id
            LEFT JOIN tte_dirjen AS td ON td.tte_lpa_id = tl.id 
            WHERE pus.fasyankes_id IS NOT NULL AND
            du.nama_utd IS NOT NULL
            AND td.id IS NULL
            AND ds.lpa = '$lpaid'
            GROUP BY
            pus.id
            ORDER BY
            pusd.tanggal_survei DESC
            ");



        if ($faskes == null) {
            return [];
        } elseif ($faskes == "pkm") {
            return $pkm->result();
        } elseif ($faskes == "klinik") {
            return $klinik->result();
        } elseif ($faskes == "Labkes") {
            return $labkes->result();
        } elseif ($faskes == "Utd") {
            return $utd->result();
        }
    }



    function getByidrekomendasi($id)
    {
        $hasil = $this->db->query("SELECT db_akreditasi.Sertifikat_progres1.id_rekomendasi , db_akreditasi.Sertifikat_progres1.mutu FROM db_akreditasi.Sertifikat_progres1 WHERE db_akreditasi.Sertifikat_progres1.mutu = '$id'");
        return $hasil;
    }

    function sudahtte($lem_id)
    {
        $hsl = $this->db->query("SELECT
            db_akreditasi.rekomendasi.id,
            db_akreditasi.rekomendasi.no_sertifikat,
            db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
            db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
            db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
                                    -- db_akreditasi.Sertifikat_progres1.id,
                                    db_akreditasi.Sertifikat_progres1.id as IdProgres,
                                    db_akreditasi.Sertifikat_progres1.id_rekomendasi,
                                    db_akreditasi.Sertifikat_progres1.lembaga,
                                    db_akreditasi.Sertifikat_progres1.mutu,
                                    db_akreditasi.Sertifikat_progres1.keterangan,
                                    db_akreditasi.Sertifikat_progres1.dirjen,
                                    db_akreditasi.Sertifikat_progres1.tgl_dibuat_lembaga,
                                    db_akreditasi.Sertifikat_progres1.tgl_dibuat_mutu,
                                    db_akreditasi.Sertifikat_progres1.tgl_dibuat_dirjen,
                                    db_akreditasi.Sertifikat_progres1.sertifikat_1,
                                    db_akreditasi.Sertifikat_progres1.sertifikat_2 
                                    FROM
                                    db_akreditasi.rekomendasi
                                    INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
                                    INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
                                    INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
                                    LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.rekomendasi.id = db_akreditasi.Sertifikat_progres1.id_rekomendasi 
                                    WHERE
                                    lembaga_akreditasi_id = '$lem_id' 
                                    AND db_akreditasi.Sertifikat_progres1.lembaga='1'");
        return $hsl;
    }


    public function Dash_rs()
    {
        $hsl = $this->db->query("SELECT
            db_fasyankes.`data`.Propinsi AS kode_rs,
            db_fasyankes.`data`.RUMAH_SAKIT,
            db_akreditasi.lembaga_akreditasi.id AS nama_lembaga_akreditasi,
            db_akreditasi.survei.tanggal_mulai AS tanggal_mulai_survei,
            db_akreditasi.rekomendasi.tanggal_surat_pengajuan_sertifikat,
            db_akreditasi.Sertifikat_progres1.lembaga,
            db_akreditasi.Sertifikat_progres1.mutu,
            db_akreditasi.Sertifikat_progres1.dirjen,
            db_akreditasi.Sertifikat_progres1.id_rekomendasi,
            DATEDIFF(IFNULL(db_akreditasi.rekomendasi.tanggal_surat_pengajuan_sertifikat, date(NOW())), db_akreditasi.survei.tanggal_mulai) lpa,
            DATEDIFF(IFNULL(db_akreditasi.Sertifikat_progres1.tgl_dibuat_lembaga, date(NOW())), db_akreditasi.rekomendasi.tanggal_surat_pengajuan_sertifikat) ttel,
            DATEDIFF(IFNULL(db_akreditasi.Sertifikat_progres1.tgl_dibuat_mutu, date(NOW())), db_akreditasi.Sertifikat_progres1.tgl_dibuat_lembaga) ttedirmutu,
            DATEDIFF(IFNULL(db_akreditasi.Sertifikat_progres1.tgl_dibuat_dirjen, date(NOW())), db_akreditasi.Sertifikat_progres1.tgl_dibuat_mutu) ttedirjen 
            FROM
            db_fasyankes.`data`
            INNER JOIN db_akreditasi.pengajuan_survei ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
            INNER JOIN db_akreditasi.lembaga_akreditasi ON db_akreditasi.lembaga_akreditasi.id = db_akreditasi.pengajuan_survei.lembaga_akreditasi_id
            LEFT OUTER JOIN db_akreditasi.survei ON db_akreditasi.survei.pengajuan_survei_id = db_akreditasi.pengajuan_survei.id
            LEFT OUTER JOIN db_akreditasi.rekomendasi ON db_akreditasi.rekomendasi.survei_id = db_akreditasi.survei.id
            LEFT JOIN db_akreditasi.Sertifikat_progres1 ON db_akreditasi.Sertifikat_progres1.id_rekomendasi = db_akreditasi.rekomendasi.id 
            WHERE
            rekomendasi.tanggal_surat_pengajuan_sertifikat > '2022-12-08'
            AND db_akreditasi.Sertifikat_progres1.dirjen IS NULL
            OR db_akreditasi.Sertifikat_progres1.dirjen = 0
            GROUP BY
            db_fasyankes.`data`.Propinsi");
        return $hsl->result();
    }

    public function Dash_tpmd()
    {
        $hsl = $this->dbfaskes->query("SELECT 
            a.faskes_code,
            b.nama_pm,
            (SELECT COUNT(*) FROM review re WHERE re.fasyankes_code = a.faskes_code GROUP BY re.fasyankes_code) survei_kepuasan_ssm,
            c.id satset,
            (SELECT MAX(uap.created_at) FROM usulan_akreditasi_pm uap WHERE uap.id_faskes = a.id_faskes) tanggal_pengajuan
            FROM
            qrapi a
            LEFT JOIN data_pm b ON a.id_faskes = b.id_faskes
            LEFT JOIN tpmd_sudah_satusehat c ON a.faskes_code=c.kode_faskes");
        return $hsl->result();
    }

    public function Detail($id)
    {
        $hsl = $this->db->query("SELECT
            db_akreditasi.rekomendasi.tanggal_terbit_sertifikat,
            db_akreditasi.rekomendasi.tanggal_kadaluarsa_sertifikat,
            db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
            db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
            db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
            db_akreditasi.lembaga_akreditasi.nama AS LEmbaga,
            db_akreditasi.pejabat_sertifikat.nama,
            db_fasyankes.`data`.ALAMAT,
            db_akreditasi.rekomendasi.capaian_akreditasi_id,
            db_akreditasi.capaian_akreditasi.nama AS capayan,
            db_akreditasi.rekomendasi.no_sertifikat,
            db_fasyankes.`data`.usrpwd2,
            db_fasyankes.propinsi.propinsi_name 
            FROM
            db_akreditasi.rekomendasi
            INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
            INNER JOIN db_akreditasi.lembaga_akreditasi ON db_akreditasi.pengajuan_survei.lembaga_akreditasi_id = db_akreditasi.lembaga_akreditasi.id
            INNER JOIN db_akreditasi.pejabat_sertifikat ON db_akreditasi.lembaga_akreditasi.id = db_akreditasi.pejabat_sertifikat.lembaga_akreditasi_id
            INNER JOIN db_akreditasi.capaian_akreditasi ON db_akreditasi.rekomendasi.capaian_akreditasi_id = db_akreditasi.capaian_akreditasi.id
            INNER JOIN db_fasyankes.propinsi ON db_fasyankes.`data`.usrpwd2 = db_fasyankes.propinsi.propinsi_kode 
            WHERE
            db_akreditasi.rekomendasi.id = '$id'");
        return $hsl->result();
    }

    function list_mutu($id)
    {
        $hsl = $this->db->query("SELECT 
            db_akreditasi.Sertifikat_progres1.mutu,
            db_akreditasi.rekomendasi.id,
            db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
            db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
            db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId 
            FROM db_akreditasi.Sertifikat_progres1 
            INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
            INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
            WHERE  db_akreditasi.Sertifikat_progres1.mutu = '$id'");
        return $hsl->result();
    }

    function sudahverif($id)
    {
        $hsl = $this->db->query("SELECT 
            db_akreditasi.Sertifikat_progres1.mutu,
            db_akreditasi.rekomendasi.id,
            db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
            db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
            db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId 
            FROM db_akreditasi.Sertifikat_progres1 
            INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
            INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
            WHERE  db_akreditasi.Sertifikat_progres1.mutu > '$id'");
        return $hsl->result();
    }

    function detail_mutu($id)
    {

        $hsl = $this->db->query("SELECT 
            db_akreditasi.Sertifikat_progres1.mutu,
            db_akreditasi.rekomendasi.id,
            db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
            db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
            db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
            db_fasyankes.`data`.ALAMAT 
            FROM db_akreditasi.Sertifikat_progres1 
            INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
            INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs 
            WHERE  db_akreditasi.rekomendasi.id ='$id'");
        return $hsl->result();
    }

    function cek_skorsing_surveor($id)
    {

        $hsl = $this->db->query("SELECT
            db_akreditasi.Sertifikat_progres1.mutu,
            db_akreditasi.rekomendasi.id,
            db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
            db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
            db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
            db_fasyankes.`data`.ALAMAT,
            db_akreditasi.survei_detail.nama_surveior,
            db_akreditasi.survei.tanggal_mulai,
            db_akreditasi.survior_skorsing.tanggal_mulai AS star,
            db_akreditasi.survior_skorsing.tanggal_selesai AS Endd,
            db_akreditasi.survei_detail.nik_surveior 
            FROM
            db_akreditasi.Sertifikat_progres1
            INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
            INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
            INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
            INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
            INNER JOIN db_akreditasi.survei_detail ON db_akreditasi.survei.id = db_akreditasi.survei_detail.survei_id
            LEFT JOIN db_akreditasi.survior_skorsing ON db_akreditasi.survei_detail.nik_surveior = db_akreditasi.survior_skorsing.nik 
            WHERE  db_akreditasi.rekomendasi.id ='$id'");
        return $hsl->result();
    }

    function penilaian_bab($id)
    {

        $hsl = $this->db->query("SELECT
            a.rekomendasi_id,
            a.nilai,
            a.bab_id,
            b.nama 
            FROM
            penilaian_bab AS a
            INNER JOIN bab AS b ON a.bab_id = b.id 
            AND a.bab_id = b.id 
            WHERE
            bab_id IN ( 15, 16 ) 
            AND a.rekomendasi_id = '$id'");
        return $hsl->result();
    }

    function verifikasi_mutu($mutu, $keterangan, $id, $timemutu)
    {
        $hsl = $this->db->query("UPDATE db_akreditasi.Sertifikat_progres1
          SET Sertifikat_progres1.mutu = '$mutu', 
          Sertifikat_progres1.keterangan = '$keterangan',
          Sertifikat_progres1.tgl_dibuat_mutu = '$timemutu'
          WHERE Sertifikat_progres1.id_rekomendasi = '$id'");
        return $hsl;
    }

    function List_dirjen($dir, $mutu)
    {
        $hsl = $this->db->query("SELECT
        db_akreditasi.Sertifikat_progres1.mutu,
        db_akreditasi.rekomendasi.id,
        db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
        db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
        db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
        db_fasyankes.`data`.ALAMAT 
        FROM db_akreditasi.Sertifikat_progres1 
        INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
        INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
        INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
        INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs 
        WHERE  db_akreditasi.Sertifikat_progres1.mutu ='$mutu' 
        AND    db_akreditasi.Sertifikat_progres1.dirjen = '$dir' ");
        return $hsl->result();
    }

    function jumlah_belum_tte()
    {
        $hsl = $this->db->query("SELECT
    COUNT( db_akreditasi.Sertifikat_progres1.id ) AS belumTTE
    FROM db_akreditasi.Sertifikat_progres1 
    INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
    INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
    INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
    INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs 
    WHERE  db_akreditasi.Sertifikat_progres1.mutu ='1' 
    AND    db_akreditasi.Sertifikat_progres1.dirjen = '0' ");
        return $hsl->row();
    }

    function jumlah_sudah_tte()
    {
        $hsl = $this->db->query("SELECT
            COUNT( db_akreditasi.Sertifikat_progres1.id ) AS sudahTTE 
        FROM db_akreditasi.Sertifikat_progres1 
        INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
        INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
        INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
        INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs 
        WHERE  db_akreditasi.Sertifikat_progres1.mutu ='1' 
        AND    db_akreditasi.Sertifikat_progres1.dirjen = '1'
        ");
        return $hsl->row();
    }

    function sudahttedirjen($dir, $mutu)
    {
        $hsl = $this->db->query("SELECT
        db_akreditasi.Sertifikat_progres1.mutu,
        db_akreditasi.rekomendasi.id,
        db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
        db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
        db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
        db_fasyankes.`data`.ALAMAT 
        FROM db_akreditasi.Sertifikat_progres1 
        INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
        INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
        INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
        INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs 
        WHERE  db_akreditasi.Sertifikat_progres1.mutu ='$mutu' 
        AND    db_akreditasi.Sertifikat_progres1.dirjen = '$dir' ");
        return $hsl->result();
    }

    function ttedirjen($dirjen, $id, $timedirjen)
    {
        $hsl = $this->db->query("UPDATE db_akreditasi.Sertifikat_progres1
      SET Sertifikat_progres1.dirjen = '$dirjen', 
      Sertifikat_progres1.tgl_dibuat_dirjen = '$timedirjen'
      WHERE Sertifikat_progres1.id_rekomendasi = '$id'");
        return $hsl;
    }

    function detail_dirjenu($id)
    {

        $hsl = $this->db->query("SELECT
        db_akreditasi.rekomendasi.id,
        db_akreditasi.pengajuan_survei.kode_rs AS kodeRS,
        db_fasyankes.`data`.RUMAH_SAKIT AS namaRS,
        db_akreditasi.pengajuan_survei.lembaga_akreditasi_id AS lembagaAkreditasiId,
        db_fasyankes.`data`.ALAMAT,
                                    -- db_akreditasi.survei_detail.nama_surveior,
                                    db_akreditasi.rekomendasi.tanggal_kadaluarsa_sertifikat,
                                    db_akreditasi.rekomendasi.no_sertifikat,
                                    db_akreditasi.rekomendasi.capaian_akreditasi_id,
                                    db_akreditasi.capaian_akreditasi.nama,
                                    db_akreditasi.capaian_akreditasi.nama AS capayan
                                    FROM
                                    db_akreditasi.Sertifikat_progres1
                                    INNER JOIN db_akreditasi.rekomendasi ON Sertifikat_progres1.id_rekomendasi = rekomendasi.id
                                    INNER JOIN db_akreditasi.survei ON db_akreditasi.survei.id = db_akreditasi.rekomendasi.survei_id
                                    INNER JOIN db_akreditasi.pengajuan_survei ON db_akreditasi.pengajuan_survei.id = db_akreditasi.survei.pengajuan_survei_id
                                    INNER JOIN db_fasyankes.`data` ON db_fasyankes.`data`.Propinsi = db_akreditasi.pengajuan_survei.kode_rs
                                    -- LEFT JOIN db_akreditasi.survei_detail ON db_akreditasi.survei.id = db_akreditasi.survei_detail.survei_id
                                    INNER JOIN db_akreditasi.capaian_akreditasi ON db_akreditasi.rekomendasi.capaian_akreditasi_id = db_akreditasi.capaian_akreditasi.id 
                                    WHERE  db_akreditasi.rekomendasi.id ='$id'");
        return $hsl->result();
    }

    function cekdata($id)
    {
        $hasil = $this->db->query("SELECT * FROM db_akreditasi.Sertifikat_progres1 WHERE Sertifikat_progres1.id_rekomendasi = '$id'");
        return $hasil;
    }

    function chart_faskes()
    {
        $hsl = $this->sina->query("SELECT
        y.provinsi,
        COUNT(x.kode_faskes) AS KLINIK,
        COUNT(x1.kode_faskes) AS PUSKESMAS,
        COUNT(x2.kode_faskes) AS LABKES
        FROM
        (
            SELECT
            data_sertifikat.provinsi,
            data_sertifikat.kode_faskes 
            FROM
            data_sertifikat
            LEFT JOIN tte_dirjen ON data_sertifikat.kode_faskes = tte_dirjen.id_faskes 
            WHERE
            tte_dirjen.id_faskes IS NOT NULL 
            ) AS y
        LEFT JOIN ( SELECT data_sertifikat.id, data_sertifikat.kode_faskes, data_sertifikat.jenis_faskes FROM data_sertifikat WHERE data_sertifikat.jenis_faskes = 'Klinik' ) AS x ON y.kode_faskes = x.kode_faskes
        LEFT JOIN ( SELECT data_sertifikat.id, data_sertifikat.kode_faskes, data_sertifikat.jenis_faskes FROM data_sertifikat WHERE data_sertifikat.jenis_faskes = 'Pusat Kesehatan Masyarakat' ) AS x1 ON y.kode_faskes = x1.kode_faskes
        LEFT JOIN ( SELECT data_sertifikat.id, data_sertifikat.kode_faskes, data_sertifikat.jenis_faskes FROM data_sertifikat WHERE data_sertifikat.jenis_faskes = 'Laboratorium Kesehatan' ) AS x2 ON y.kode_faskes = x2.kode_faskes
        GROUP BY y.provinsi
        ");
        return $hsl->result();
    }


    function chart_faskes_klinik()
    {
        $hsl = $this->sina->query("SELECT
        COUNT( dbfaskes.data_klinik.id ) AS total_klinik,
        COUNT( db_akreditasi_non_rs.data_sertifikat.id ) AS sudah_akreditasi,
        dbfaskes.propinsi.nama_prop,
        dbfaskes.data_klinik.id_prov
        FROM
        dbfaskes.data_klinik
        INNER JOIN dbfaskes.trans_final ON dbfaskes.data_klinik.id_faskes = dbfaskes.trans_final.id_faskes
        LEFT JOIN db_akreditasi_non_rs.data_sertifikat ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.data_sertifikat.kode_faskes
        INNER JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop 
        GROUP BY
        dbfaskes.data_klinik.id_prov
        ORDER BY
        dbfaskes.propinsi.id_prop desc");
        return $hsl->result();
    }

    function chart_faskes_rs()
    {
        $hsl = $this->db->query("SELECT
        COUNT( db_fasyankes.`data`.Propinsi ) AS jumlah,
        COUNT( db_akreditasi.tb_data_akreditasi.Propinsi ) AS SudahAkre,
        db_fasyankes.`data`.RUMAH_SAKIT,
        db_fasyankes.propinsi_dagri.nama_prop,
        db_fasyankes.`data`.provinsi_id 
        FROM
        db_fasyankes.`data`
        LEFT JOIN db_fasyankes.propinsi_dagri ON db_fasyankes.`data`.provinsi_id = db_fasyankes.propinsi_dagri.id_prop
        LEFT JOIN db_akreditasi.tb_data_akreditasi ON db_fasyankes.`data`.Propinsi = db_akreditasi.tb_data_akreditasi.Propinsi 
        WHERE
        db_fasyankes.`data`.provinsi_id IS NOT NULL 
        GROUP BY
        db_fasyankes.`data`.provinsi_id
        ORDER BY
        db_fasyankes.`data`.provinsi_id desc");
        return $hsl->result();
    }

    function chart_faskes_puskes()
    {
        $hsl = $this->sina->query("SELECT
        COUNT( dbfaskes.puskesmas_pusdatin.id ) AS jumlah,
        COUNT( db_akreditasi_non_rs.data_sertifikat.id ) AS telah_akreditasi,
        dbfaskes.propinsi.nama_prop 
        FROM
        dbfaskes.puskesmas_pusdatin
        LEFT JOIN dbfaskes.propinsi ON dbfaskes.puskesmas_pusdatin.provinsi_code = dbfaskes.propinsi.id_prop
        LEFT JOIN db_akreditasi_non_rs.data_sertifikat ON dbfaskes.puskesmas_pusdatin.kode_sarana = db_akreditasi_non_rs.data_sertifikat.kode_faskes 
        GROUP BY
        dbfaskes.propinsi.id_prop
        ORDER BY
        dbfaskes.propinsi.id_prop desc
        ");
        return $hsl->result();
    }

    function chart_faskes_lab()
    {
        $hsl = $this->sina->query("SELECT
        COUNT( dbfaskes.data_labkes.id ) AS total_lab,
        COUNT( db_akreditasi_non_rs.data_sertifikat.id ) AS sudah_akreditasi,
        dbfaskes.propinsi.nama_prop,
        dbfaskes.data_labkes.id_prov
        FROM
        dbfaskes.data_labkes
        INNER JOIN dbfaskes.trans_final ON dbfaskes.data_labkes.id_faskes = dbfaskes.trans_final.id_faskes
        LEFT JOIN db_akreditasi_non_rs.data_sertifikat ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.data_sertifikat.kode_faskes
        INNER JOIN dbfaskes.propinsi ON dbfaskes.data_labkes.id_prov = dbfaskes.propinsi.id_prop 
        GROUP BY
        dbfaskes.data_labkes.id_prov
        ORDER BY
        dbfaskes.propinsi.id_prop desc
        ");
        return $hsl->result();
    }

    function chart_faskes_utd()
    {
        $hsl = $this->sina->query("SELECT
        COUNT( dbfaskes.data_utd.id ) AS total_utd,
        COUNT( db_akreditasi_non_rs.data_sertifikat.id ) AS sudah_akreditasi,
        dbfaskes.propinsi.nama_prop,
        dbfaskes.data_utd.id_prov 
        FROM
        dbfaskes.data_utd
        INNER JOIN dbfaskes.trans_final ON dbfaskes.data_utd.id_faskes = dbfaskes.trans_final.id_faskes
        LEFT JOIN db_akreditasi_non_rs.data_sertifikat ON dbfaskes.trans_final.kode_faskes = db_akreditasi_non_rs.data_sertifikat.kode_faskes
        INNER JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop 
        GROUP BY
        dbfaskes.data_utd.id_prov 
        ORDER BY
        dbfaskes.propinsi.id_prop DESC
        ");
        return $hsl->result();
    }


    function chart_status($faskes)
    {
        $hsl = $this->sina->query("SELECT
        COUNT(data_sertifikat.kode_faskes) AS JUM, 
        data_sertifikat.status_akreditasi
        FROM
        data_sertifikat
        LEFT JOIN
        tte_dirjen
        ON 
        data_sertifikat.kode_faskes = tte_dirjen.id_faskes
        WHERE
        data_sertifikat.jenis_faskes = '$faskes' AND
        tte_dirjen.id_faskes IS NOT NULL
        GROUP BY
        data_sertifikat.status_akreditasi
        ORDER BY
        JUM DESC");
        return $hsl->result();
    }

    function chart_status_RS()
    {
        $hsl = $this->db->query("SELECT
        COUNT(tb_data_akreditasi.Propinsi) AS JUM, 
        tb_data_akreditasi.`status` AS status_akreditasi
        FROM
        tb_data_akreditasi
        WHERE
        tb_data_akreditasi.`status` IS NOT NULL
        GROUP BY
        tb_data_akreditasi.`status`
        ORDER BY
        JUM DESC");
        return $hsl->result();
    }

    function lpa()
    {
        $hsl = $this->db->query("SELECT * FROM template_surat_tugas");
        return $hsl->result();
    }
}
