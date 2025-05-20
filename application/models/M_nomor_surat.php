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


public function tampil_faskes($jenis_faskes = null, $kategoriFaskes = null)
    {
        $this->db->where('nomor_surat IS NULL');
        if ($jenis_faskes) {
            $this->db->where('jenis_faskes', $jenis_faskes);
        }
        if ($kategoriFaskes) {
            $this->db->where('kategoriFaskes', $kategoriFaskes);
        }
        return $this->db->get('nama_tabel_anda')->result(); // ganti dengan nama tabel asli
    }

    public function jumlah_belum($jenis_faskes = null, $kategoriFaskes = null)
    {
        $this->db->where('nomor_surat IS NULL');
        if ($jenis_faskes) {
            $this->db->where('jenis_faskes', $jenis_faskes);
        }
        if ($kategoriFaskes) {
            $this->db->where('kategoriFaskes', $kategoriFaskes);
        }
        return $this->db->select('COUNT(*) as belum')->get('nama_tabel_anda')->row();
    }

    public function input_nomor($data)
    {
        foreach ($data as $id => $row) {
            $this->db->where('kode_faskes', $id);
            $this->db->update('nama_tabel_anda', $row);
        }
    }

    public function delete_nomor($id)
    {
        $this->db->where('id', $id);
        $this->db->update('nama_tabel_anda', [
            'nomor_surat' => null,
            'tgl_nomor_surat' => null
        ]);
    }

  public function SudahInput($faskes, $jenis)
{
    if (is_null($faskes)) return [];

    $baseQuery = "SELECT
        ds.id,
        ds.persetujuan_direktur_id,
        ds.kode_faskes,
        ds.nama_faskes,
        ds.jenis_faskes,
        ds.alamat,
        ds.kecamatan,
        ds.kabkot,
        ds.provinsi,
        ds.status_akreditasi,
        ds.tgl_survei,
        ds.logo,
        ds.nomor_surat,
        ds.tgl_nomor_surat,
        ds.lpa,
        ds.created_at,
        tl.status_tte
        FROM data_sertifikat ds
        LEFT JOIN tte_lpa tl ON ds.id = tl.data_sertifikat_id
    ";

    $where = "WHERE ds.nomor_surat IS NOT NULL AND ds.jenis_faskes = " . $this->db->escape($faskes);
    $groupOrder = " GROUP BY ds.kode_faskes ORDER BY ds.tgl_nomor_surat DESC, ds.nomor_surat DESC LIMIT 300";

    // Tambahkan join dan kondisi khusus jika Klinik atau Lab
    if ($faskes == 'Klinik') {
        $baseQuery .= "
            LEFT JOIN dbfaskes.trans_final tf ON ds.kode_faskes = tf.kode_faskes
            LEFT JOIN dbfaskes.data_klinik dk ON tf.id_faskes = dk.id_faskes
        ";
        $where .= " AND dk.jenis_klinik = " . $this->db->escape($jenis);
    } elseif ($faskes == 'Laboratorium Kesehatan') {
        $baseQuery .= "
            LEFT JOIN dbfaskes.trans_final tf ON ds.kode_faskes = tf.kode_faskes
            LEFT JOIN dbfaskes.data_labkes dl ON tf.id_faskes = dl.id_faskes
        ";
        $where .= " AND dl.jenis_lab LIKE " . $this->db->escape("%$jenis%");
    }

    $finalQuery = $baseQuery . ' ' . $where . ' ' . $groupOrder;

    return $this->sina->query($finalQuery)->result();
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