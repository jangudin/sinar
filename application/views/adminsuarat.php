<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="">
    <div class="clearfix"></div>
    <br />
<!--     <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="GET" action="<?= base_url('AdminNomorSurat') ?>">
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pilih Data Untuk Ditampilkan <span class="required">*</span>
        </label>
        <div class="col-md-2 col-sm-2 ">
          <select name="page" class="select2_single form-control" tabindex="-1">
            <option value="">Pilih ...</option>
            <option value="belum">Belum Input Nomor</option>
            <option value="sudah">Sudah Input Nomor</option>
          </select>
        </div>
        <div class="col-md-3 col-sm-3 ">
          <select name="faskes" class="select2_single form-control" tabindex="-1">
            <option value="">Pilih ...</option>
            <option value="Klinik">Klinik</option>
            <option value="Pusat Kesehatan Masyarakat">Pusat Kesehatan Masyarakat</option>
            <option value="Laboratorium Kesehatan">Laboratorium Kesehatan</option>
            <option value="Unit Transfusi Darah">UTD</option>
          </select>
        </div>
        <div class="col-md-4 col-sm-4 ">
         <input type="submit" class="btn btn-success" value="Tampilkan">
       </div>
     </div>
   </form> -->
   <?php if ($this->uri->segment(2) == 'nomor'):?>
     <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Pusat Kesehatan Masyarakat') ?>">
        Puskesmas
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Klinik/Utama') ?>">
        Klinik Utama
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Klinik/Pratama') ?>">
        Klinik Pratama
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Laboratorium Kesehatan/Laboratorium Medis') ?>">
        Lab Medis
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Laboratorium Kesehatan/Laboratorium Kesehatan') ?>">
        Lab Kesmas
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Unit Transfusi Darah') ?>">
        UTD
      </a>
    </div>
    <br>
    <br>
  <?php else: ?>
   <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Pusat Kesehatan Masyarakat') ?>">
      Puskesmas
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Klinik/Utama') ?>">
      Klinik Utama
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Klinik/Pratama') ?>">
      Klinik Pratama
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Laboratorium Kesehatan/Laboratorium Medis') ?>">
      Lab Medis
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Laboratorium Kesehatan/Laboratorium Kesehatan') ?>">
      Lab Kesmas
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Unit Transfusi Darah') ?>">
      UTD
    </a>
  </div>
  <br>
  <br>
<?php endif; ?>
<?php echo $this->session->flashdata('msg'); ?>
<div class="row">
  <div class="col-md-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Jumlah belum input nomor : <?php echo $belum->belum; ?> </h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Settings 1</a>
              <a class="dropdown-item" href="#">Settings 2</a>
            </div>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <h6><code>*Jika telah input nomor sertifikat klik simpan</code></h6>
      <div class="x_content">
        <div class="table-responsive">
          <table id="" class="table table-striped jambo_table bulk_action" style="width:100%">
            <thead>
              <tr class="headings">
                <th class="column-title">No</th>
                <th class="column-title">Kode Faskes </th>
                <th class="column-title">Nama Faskes </th>
                <th class="column-title">Jenis Faskes </th>
                <th class="column-title">Tgl Sertifikat</th>
                <th class="column-title">Nomor Sertifikat</th>
                <th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($data as $a): ?>
                <?php $key = $a->kode_faskes; ?>
                <tr class="even pointer">
                  <td style="text-align: center;"><?= $i++ ?></td>
                  <td><?= $a->kode_faskes ?></td>
                  <td><?= $a->nama_faskes ?></td>
                  <td><?= $a->jenis_faskes ?></td>

                  <?php if ($a->nomor_surat == null): ?>
                    <!-- Form untuk input nomor surat -->
                    <form action="<?= base_url('AdminNomorSurat/input_nomor') ?>" method="post">
                      <input type="hidden" name="jenisfaskes" value="<?= $a->jenis_faskes ?>" />
                      <td>
                        <input type="date" name="tgl_nomor_surat[<?= $key; ?>]" required />
                        <input type="hidden" name="kode_faskes" value="<?= $a->kode_faskes ?>" />
                      </td>
                      <td>
                        <input type="number" name="nomor_surat[<?= $key; ?>]" required />
                        <input type="hidden" name="id[]" value="<?= $key ?>" />
                      </td>
                  <?php else: ?>
                    <!-- Tampilkan nomor surat dan tombol hapus -->
                    <td><?= $a->tgl_nomor_surat ?></td>
                    <td><?= $a->nomor_surat ?></td>
                    <td>
                      <h6><span class="badge badge-success">Telah Diberi Nomor</span></h6>

                      <?php if ($a->status_tte == 1): ?>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal<?= $a->id ?>">Hapus Nomor</button>
                      <?php else: ?>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $a->id ?>">Hapus Nomor</button>
                      <?php endif; ?>

                      <!-- Modal untuk peringatan -->
                      <div class="modal fade" id="exampleModal<?= $a->id ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-body">
                              <h2><span class="badge badge-warning">PERHATIAN</span></h2>
                              <h6>Nomor Tidak Bisa Dihapus Sudah Terpakai</h6>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal untuk konfirmasi hapus -->
                      <div class="modal fade" id="hapus<?= $a->id ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-body">
                              <h2><span class="badge badge-warning">Konfirmasi</span></h2>
                              <h6>Anda akan menghapus Nomor</h6>
                              <h6><?= $a->nomor_surat ?></h6>
                              <form action="<?= base_url('AdminNomorSurat/deletedata') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $a->id ?>" />
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>

          </table>
          <button type="submit" name="submit" id="submit" class="btn btn-info">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>