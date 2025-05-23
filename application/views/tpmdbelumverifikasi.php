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

          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Fasyankes</th>
                <th>Nama Fasyankes</th>
                <th>Jenis Fasyankes</th>
                <th>LPA</th>
                <th>Provinsi</th>
                <th>KAB / KOT</th>
                <th>TGL Verifikasi</th>
                <th>Verifikasi KATIM</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <h2>Hasil API Verifikasi</h2>

                <?php if (isset($api_result['error'])): ?>
                    <p>Error: <?php echo htmlspecialchars($api_result['error']); ?></p>
                <?php else: ?>
                    <pre><?php print_r($api_result); ?></pre>
                <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>