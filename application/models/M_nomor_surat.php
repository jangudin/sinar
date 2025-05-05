<?php
class M_nomor_surat extends CI_Model{

  function select_data($table, $where)
  {
    $this->sina->get_where($table, $where);
    //echo $this->db->last_query();
    return $this->sina->get_where($table, $where);
  }

  public function view(){
    return $this->sina->get('data_sertifikat')->result(); // Tampilkan semua data yang ada di tabel siswa
  }


  function cek_hapus($nomor_surat){
    $hsl=$this->sina->query("SELECT
      bb.id,
      bb.nama_faskes,
      bb.alamat,
      bb.kode_faskes,
      bb.jenis_faskes,
      bb.nomor_surat,
      bb.capayan
      FROM
      sertifikat_nomor AS bb
      INNER JOIN tte_lembaga AS cc ON bb.kode_faskes = cc.id_faskes
      WHERE
      bb.nomor_surat = '$nomor_surat'");
    return $hsl->result();
  }


  function tpmd_belum_input(){
    $hsl=$this->sina->query("SELECT * FROM data_sertifikat_tpmd WHERE nomor_surat IS NULL LIMIT 10");
    return $hsl->result();
  }

  function tpmd_sudah_input(){
    $hsl=$this->sina->query("SELECT * FROM data_sertifikat_tpmd   LEFT JOIN TPMD_tte_dirjen ON data_sertifikat_tpmd.id = TPMD_tte_dirjen.data_sertifikat_tpmd_id  WHERE nomor_surat IS NOT NULL LIMIT 10");
    return $hsl->result();
  }


  function tampil_faskes($faskes,$jenis){

    $pkm=$this->sina->query("SELECT * 
      FROM data_sertifikat 
      WHERE nomor_surat IS NULL 
      AND data_sertifikat.jenis_faskes = '$faskes' LIMIT 10");
    $Klinik=$this->sina->query("SELECT * 
      FROM data_sertifikat 
      LEFT OUTER JOIN dbfaskes.trans_final ON data_sertifikat.kode_faskes = dbfaskes.trans_final.kode_faskes
      LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
      WHERE nomor_surat IS NULL 
      AND data_sertifikat.jenis_faskes = '$faskes'
      AND data_klinik.jenis_klinik = '$jenis'
      LIMIT 10");
    $lab=$this->sina->query("SELECT * 
      FROM data_sertifikat 
      LEFT OUTER JOIN dbfaskes.trans_final ON data_sertifikat.kode_faskes = dbfaskes.trans_final.kode_faskes
      LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
      WHERE nomor_surat IS NULL 
      AND data_sertifikat.jenis_faskes = '$faskes'
      AND data_labkes.jenis_lab LIKE '%$jenis%'
      LIMIT 10");
    $utd=$this->sina->query("SELECT * 
      FROM data_sertifikat 
      WHERE nomor_surat IS NULL 
      AND data_sertifikat.jenis_faskes = '$faskes' LIMIT 10");
    // $sudah=$this->sina->query("SELECT
    //   data_sertifikat.id, 
    //   data_sertifikat.persetujuan_direktur_id, 
    //   data_sertifikat.kode_faskes, 
    //   data_sertifikat.nama_faskes, 
    //   data_sertifikat.jenis_faskes, 
    //   data_sertifikat.alamat, 
    //   data_sertifikat.kecamatan, 
    //   data_sertifikat.kabkot, 
    //   data_sertifikat.provinsi, 
    //   data_sertifikat.status_akreditasi, 
    //   data_sertifikat.tgl_survei, 
    //   data_sertifikat.logo, 
    //   data_sertifikat.nomor_surat, 
    //   data_sertifikat.tgl_nomor_surat, 
    //   data_sertifikat.lpa, 
    //   data_sertifikat.created_at, 
    //   tte_lpa.status_tte
    //   FROM
    //   data_sertifikat
    //   LEFT JOIN tte_lpa ON data_sertifikat.id = tte_lpa.data_sertifikat_id 
    //   WHERE
    //   nomor_surat IS NOT NULL
    //   AND data_sertifikat.jenis_faskes = '$faskes'
    //   GROUP BY
    //   data_sertifikat.kode_faskes
    //   ORDER BY
    //   data_sertifikat.tgl_nomor_surat DESC,
    //   data_sertifikat.nomor_surat DESC
    //   LIMIT 300");

    if ($faskes == null) {
      return [];
    }elseif($faskes == 'Pusat Kesehatan Masyarakat'){
      return $pkm->result();
    }elseif ($faskes == 'Klinik'){
      return $Klinik->result();
    }elseif ($faskes == 'Laboratorium Kesehatan'){
      return $lab->result();
    }elseif ($faskes == 'Unit Transfusi Darah'){
      return $utd->result();
    };
     // return $belum->result();
  }

  function SudahInput($faskes,$jenis){

    $pkm=$this->sina->query("SELECT
      data_sertifikat.id, 
      data_sertifikat.persetujuan_direktur_id, 
      data_sertifikat.kode_faskes, 
      data_sertifikat.nama_faskes, 
      data_sertifikat.jenis_faskes, 
      data_sertifikat.alamat, 
      data_sertifikat.kecamatan, 
      data_sertifikat.kabkot, 
      data_sertifikat.provinsi, 
      data_sertifikat.status_akreditasi, 
      data_sertifikat.tgl_survei, 
      data_sertifikat.logo, 
      data_sertifikat.nomor_surat, 
      data_sertifikat.tgl_nomor_surat, 
      data_sertifikat.lpa, 
      data_sertifikat.created_at, 
      tte_lpa.status_tte
      FROM
      data_sertifikat
      LEFT JOIN tte_lpa ON data_sertifikat.id = tte_lpa.data_sertifikat_id 
      WHERE
      nomor_surat IS NOT NULL
      AND data_sertifikat.jenis_faskes = '$faskes'
      GROUP BY
      data_sertifikat.kode_faskes
      ORDER BY
      data_sertifikat.tgl_nomor_surat DESC,
      data_sertifikat.nomor_surat DESC
      LIMIT 300");
    $Klinik=$this->sina->query("SELECT
      data_sertifikat.id, 
      data_sertifikat.persetujuan_direktur_id, 
      data_sertifikat.kode_faskes, 
      data_sertifikat.nama_faskes, 
      data_sertifikat.jenis_faskes, 
      data_sertifikat.alamat, 
      data_sertifikat.kecamatan, 
      data_sertifikat.kabkot, 
      data_sertifikat.provinsi, 
      data_sertifikat.status_akreditasi, 
      data_sertifikat.tgl_survei, 
      data_sertifikat.logo, 
      data_sertifikat.nomor_surat, 
      data_sertifikat.tgl_nomor_surat, 
      data_sertifikat.lpa, 
      data_sertifikat.created_at, 
      tte_lpa.status_tte
      FROM
      data_sertifikat
      LEFT JOIN tte_lpa ON data_sertifikat.id = tte_lpa.data_sertifikat_id
      LEFT OUTER JOIN dbfaskes.trans_final ON data_sertifikat.kode_faskes = dbfaskes.trans_final.kode_faskes
      LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
      WHERE
      nomor_surat IS NOT NULL
      AND data_sertifikat.jenis_faskes = '$faskes'
      AND data_klinik.jenis_klinik = '$jenis'
      GROUP BY
      data_sertifikat.kode_faskes
      ORDER BY
      data_sertifikat.tgl_nomor_surat DESC,
      data_sertifikat.nomor_surat DESC
      LIMIT 300");
    $lab=$this->sina->query("SELECT
      data_sertifikat.id, 
      data_sertifikat.persetujuan_direktur_id, 
      data_sertifikat.kode_faskes, 
      data_sertifikat.nama_faskes, 
      data_sertifikat.jenis_faskes, 
      data_sertifikat.alamat, 
      data_sertifikat.kecamatan, 
      data_sertifikat.kabkot, 
      data_sertifikat.provinsi, 
      data_sertifikat.status_akreditasi, 
      data_sertifikat.tgl_survei, 
      data_sertifikat.logo, 
      data_sertifikat.nomor_surat, 
      data_sertifikat.tgl_nomor_surat, 
      data_sertifikat.lpa, 
      data_sertifikat.created_at, 
      tte_lpa.status_tte
      FROM
      data_sertifikat
      LEFT JOIN tte_lpa ON data_sertifikat.id = tte_lpa.data_sertifikat_id
      LEFT OUTER JOIN dbfaskes.trans_final ON data_sertifikat.kode_faskes = dbfaskes.trans_final.kode_faskes
      LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
      WHERE
      nomor_surat IS NOT NULL
      AND data_sertifikat.jenis_faskes = '$faskes'
      AND data_labkes.jenis_lab LIKE '%$jenis%'
      GROUP BY
      data_sertifikat.kode_faskes
      ORDER BY
      data_sertifikat.tgl_nomor_surat DESC,
      data_sertifikat.nomor_surat DESC
      LIMIT 300");
    $utd=$this->sina->query("SELECT
      data_sertifikat.id, 
      data_sertifikat.persetujuan_direktur_id, 
      data_sertifikat.kode_faskes, 
      data_sertifikat.nama_faskes, 
      data_sertifikat.jenis_faskes, 
      data_sertifikat.alamat, 
      data_sertifikat.kecamatan, 
      data_sertifikat.kabkot, 
      data_sertifikat.provinsi, 
      data_sertifikat.status_akreditasi, 
      data_sertifikat.tgl_survei, 
      data_sertifikat.logo, 
      data_sertifikat.nomor_surat, 
      data_sertifikat.tgl_nomor_surat, 
      data_sertifikat.lpa, 
      data_sertifikat.created_at, 
      tte_lpa.status_tte
      FROM
      data_sertifikat
      LEFT JOIN tte_lpa ON data_sertifikat.id = tte_lpa.data_sertifikat_id 
      WHERE
      nomor_surat IS NOT NULL
      AND data_sertifikat.jenis_faskes = '$faskes'
      GROUP BY
      data_sertifikat.kode_faskes
      ORDER BY
      data_sertifikat.tgl_nomor_surat DESC,
      data_sertifikat.nomor_surat DESC
      LIMIT 300");
    // $sudah=$this->sina->query("SELECT
    //   data_sertifikat.id, 
    //   data_sertifikat.persetujuan_direktur_id, 
    //   data_sertifikat.kode_faskes, 
    //   data_sertifikat.nama_faskes, 
    //   data_sertifikat.jenis_faskes, 
    //   data_sertifikat.alamat, 
    //   data_sertifikat.kecamatan, 
    //   data_sertifikat.kabkot, 
    //   data_sertifikat.provinsi, 
    //   data_sertifikat.status_akreditasi, 
    //   data_sertifikat.tgl_survei, 
    //   data_sertifikat.logo, 
    //   data_sertifikat.nomor_surat, 
    //   data_sertifikat.tgl_nomor_surat, 
    //   data_sertifikat.lpa, 
    //   data_sertifikat.created_at, 
    //   tte_lpa.status_tte
    //   FROM
    //   data_sertifikat
    //   LEFT JOIN tte_lpa ON data_sertifikat.id = tte_lpa.data_sertifikat_id 
    //   WHERE
    //   nomor_surat IS NOT NULL
    //   AND data_sertifikat.jenis_faskes = '$faskes'
    //   GROUP BY
    //   data_sertifikat.kode_faskes
    //   ORDER BY
    //   data_sertifikat.tgl_nomor_surat DESC,
    //   data_sertifikat.nomor_surat DESC
    //   LIMIT 300");

    if ($faskes == null) {
      return [];
    }elseif($faskes == 'Pusat Kesehatan Masyarakat'){
      return $pkm->result();
    }elseif ($faskes == 'Klinik'){
      return $Klinik->result();
    }elseif ($faskes == 'Laboratorium Kesehatan'){
      return $lab->result();
    }elseif ($faskes == 'Unit Transfusi Darah'){
      return $utd->result();
    };
     // return $belum->result();
  }

  function jumlah_belum($faskes,$jenis){
    $hsl=$this->sina->query("SELECT
      COUNT( db_akreditasi_non_rs.data_sertifikat.id ) AS belum,
      dbfaskes.data_klinik.jenis_klinik 
      FROM
      db_akreditasi_non_rs.data_sertifikat
      LEFT JOIN dbfaskes.trans_final ON db_akreditasi_non_rs.data_sertifikat.kode_faskes = dbfaskes.trans_final.kode_faskes_baru
      INNER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes 
      WHERE
      nomor_surat IS NULL 
      AND data_sertifikat.jenis_faskes = '$faskes' 
      AND dbfaskes.data_klinik.jenis_klinik = '$jenis'");
    return $hsl->row();
  }

  function jumlah_belum_tpmd(){
    $hsl=$this->sina->query("SELECT
      COUNT(data_sertifikat_tpmd.id) belum
      FROM data_sertifikat_tpmd WHERE nomor_surat IS NULL");
    return $hsl->row();
  }

  function tgl_survei($kode){
    $hsl=$this->sina->query("SELECT
      a.fasyankes_id,
      pusd.tanggal_survei
      FROM
      db_akreditasi_non_rs.pengajuan_usulan_survei AS a
      LEFT JOIN db_akreditasi_non_rs.pengajuan_usulan_survei_detail pusd ON pusd.pengajuan_usulan_survei_id = a.id 
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
      LEFT JOIN dbfaskes.puskesmas_pusdatin AS pskms ON a.fasyankes_id = pskms.kode_sarana
      INNER JOIN db_akreditasi_non_rs.status_rekomendasi ON pr.status_rekomendasi_id = db_akreditasi_non_rs.status_rekomendasi.id
      WHERE
      pk.status_persetujuan = 1 AND
      a.fasyankes_id = '$kode'
      ORDER BY
      tanggal_survei DESC
      LIMIT 1");
    return $hsl->result();
  }

  function deleterecords($id)
  {
    $this->sina->where("nomor_surat", $id);
    $this->sina->delete("db_akreditasi_non_rs.sertifikat_nomor");
    return true;
  }

}