<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <!-- <h3>Detail</h3> -->
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5">
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <?php echo $this->session->flashdata('msg');?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail TPMD</h2>
                    <div class="clearfix"></div>
                  </div>

                  <?php if($this->session->flashdata('error')): ?>
                      <div class="alert alert-danger">
                          <?= $this->session->flashdata('error') ?>
                      </div>
                  <?php endif; ?>
                  
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-6">
                          <table class="table table-bordered">
                              <tr>
                                  <th width="30%">Kode Faskes</th>
                                  <td><?= $detail->kode_faskes ?></td>
                              </tr>
                              <tr>
                                  <th>Nama Faskes</th>
                                  <td><?= $detail->nama_pm ?></td>
                              </tr>
                              <tr>
                                  <th>Alamat</th>
                                  <td><?= $detail->alamat ?></td>
                              </tr>
                              <tr>
                                  <th>Kecamatan</th>
                                  <td><?= $detail->kecamatan ?></td>
                              </tr>
                              <tr>
                                  <th>Kab/Kota</th>
                                  <td><?= $detail->kab_kota ?></td>
                              </tr>
                              <tr>
                                  <th>Provinsi</th>
                                  <td><?= $detail->provinsi ?></td>
                              </tr>
                          </table>
                      </div>
                      <div class="col-md-6">
                          <table class="table table-bordered">
                              <tr>
                                  <th width="30%">Status Verifikasi</th>
                                  <td>
                                      <?php if($detail->status_verifikasi == 1): ?>
                                          <span class="badge badge-success">Terverifikasi</span>
                                      <?php else: ?>
                                          <span class="badge badge-warning">Belum Verifikasi</span>
                                      <?php endif; ?>
                                  </td>
                              </tr>
                              <tr>
                                  <th>Tanggal Usulan</th>
                                  <td><?= format_indo($detail->tanggal_usulan) ?></td>
                              </tr>
                              <tr>
                                  <th>Status Katim</th>
                                  <td><?= $detail->status_setuju_katim ?></td>
                              </tr>
                              <tr>
                                  <th>Keterangan Katim</th>
                                  <td><?= $detail->keterangan_katim ?: '-' ?></td>
                              </tr>
                          </table>
                      </div>
                  </div>

                  <?php if($attachment): ?>
                  <div class="row mt-4">
                      <div class="col-md-12">
                          <h4>Dokumen Sertifikat</h4>
                          <div class="btn-group">
                              <a href="<?= $attachment ?>" class="btn btn-primary" target="_blank">
                                  <i class="fa fa-file-pdf-o"></i> Sertifikat
                              </a>
                              <?php if($valid): ?>
                              <a href="<?= $valid ?>" class="btn btn-success" target="_blank">
                                  <i class="fa fa-check-circle"></i> Sertifikat Valid
                              </a>
                              <?php endif; ?>
                              <?php if($hasiltte): ?>
                              <a href="<?= $hasiltte ?>" class="btn btn-info" target="_blank">
                                  <i class="fa fa-file-text"></i> Hasil TTE
                              </a>
                              <?php endif; ?>
                          </div>
                      </div>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
