<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <br />
    <br />
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Daftar Faskes Belum Verifikasi</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          <?php if ($this->session->userdata('id') == '48') { ?>
            <div class="btn-group">
              <a type="button" class="btn btn-success" href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi/Pusat Kesehatan Masyarakat') ?>">
                Puskesmas
              </a>
            </div>
            <div class="btn-group">
              <a type="button" class="btn btn-success" href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi/Klinik/Pratama') ?>">
                Klinik Pratama
              </a>
            </div>
            <div class="btn-group">
              <a type="button" class="btn btn-success" href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi/Laboratorium Kesehatan/Laboratorium Kesehatan') ?>">
                Lab Kesmas
              </a>
            </div>
            <div class="btn-group">
              <a type="button" class="btn btn-success" href="<?php echo base_url('Mutu_fasyankes/tpmdbelumverifikasi') ?>">
                TPMD (On Progres)
              </a>
            </div>
            <?php }else { ?>
             <div class="btn-group">
              <a type="button" class="btn btn-success" href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi/Klinik/Utama') ?>">
                Klinik Utama
              </a>
            </div>
            <div class="btn-group">
              <a type="button" class="btn btn-success" href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi/Laboratorium Kesehatan/Laboratorium Medis') ?>">
                Lab Medis
              </a>
            </div>
            <div class="btn-group">
              <a type="button" class="btn btn-success" href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi/Unit Transfusi Darah') ?>">
                UTD
              </a>
            </div>
            <?php } ?>
          </div>

          <br>
            
          <h2>Hasil API Verifikasi</h2>

                    <?php if (isset($api_result['error'])): ?>
                        <p>Error: <?php echo htmlspecialchars($api_result['error']); ?></p>
                    <?php else: ?>
                        <?php if (!empty($api_result)): ?>
                            <table border="1" cellpadding="5" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Faskes</th>
                                        <th>Kode Faskes</th>
                                        <th>Tanggal Usulan</th>
                                        <th>Created At</th>
                                        <th>Modified At</th>
                                        <th>ID Kategori PM</th>
                                        <th>Status Verifikasi</th>
                                        <th>Status Sertifikat</th>
                                        <th>Keterangan</th>
                                        <th>Status Setuju Katim</th>
                                        <th>Keterangan Katim</th>
                                        <th>Tanggal Setuju Katim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($api_result as $item): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($item['id']); ?></td>
                                            <td><?php echo htmlspecialchars($item['id_faskes']); ?></td>
                                            <td><?php echo htmlspecialchars($item['kode_faskes']); ?></td>
                                            <td><?php echo htmlspecialchars($item['tanggal_usulan']); ?></td>
                                            <td><?php echo htmlspecialchars($item['created_at']); ?></td>
                                            <td><?php echo htmlspecialchars($item['modified_at']); ?></td>
                                            <td><?php echo htmlspecialchars($item['id_kategori_pm']); ?></td>
                                            <td><?php echo htmlspecialchars($item['status_verifikasi']); ?></td>
                                            <td><?php echo htmlspecialchars($item['status_sertifikat']); ?></td>
                                            <td><?php echo htmlspecialchars($item['keterangan']); ?></td>
                                            <td><?php echo htmlspecialchars($item['status_setuju_katim']); ?></td>
                                            <td><?php echo htmlspecialchars($item['keterangan_katim']); ?></td>
                                            <td><?php echo htmlspecialchars($item['tanggal_setuju_katim']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Tidak ada data untuk ditampilkan.</p>
                        <?php endif; ?>
                    <?php endif; ?>

          
        </div>
      </div>
    </div>
  </div>
</div>