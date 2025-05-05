<div class="right_col" role="main">
  <div class>
    <div class="page-title">
      <div class="title_left">
        <h3>Monitoring <small>Akreditasi Fasilitas Pelayanan Kesehatan</small></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Progres Akreditasi</h2>
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
            <a href="<?php echo base_url('DirjenYankes/monitoring_rs') ?>" class="btn btn-success">Rumah Sakit</a>
            <a href="<?php echo base_url('DirjenYankes/monitoring/pkm') ?>" class="btn btn-success">Puskesmas</a>
            <a href="<?php echo base_url('DirjenYankes/monitoring/klinik') ?>" class="btn btn-success">Klinik</a>
            <a href="<?php echo base_url('DirjenYankes/monitoring/Labkes') ?>" class="btn btn-success">Labkes</a>
            <a href="<?php echo base_url('DirjenYankes/monitoring/Utd') ?>" class="btn btn-success">UTD</a>
            <a href="<?php echo base_url('DirjenYankes/monitoring_tpmd') ?>" class="btn btn-success">TPMD/TPMDG</a>
            
          </div>

            <h5><a class="btn btn-danger"> _____ </a> : Lebih dari 7 Hari</h5>
            <h5>&#x2713; : Sudah Selesai</h5>

          <div class="x_content">
            <table  id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th style="text-align:center;">Kode TPMD/TPMDG</th>
                  <th style="text-align:center;">Nama TPMD/TPMDG</th>
                  <th style="text-align:center;">Registrasi - Print QR Code</th>
                  <th style="text-align:center;">Survei Kepuasan SSM</th>
                  <th style="text-align:center;">RME Integrasi SatuSehat</th>
                  <th style="text-align:center;">Pengajuan Akreditasi</th>
                  <th style="text-align:center;">Timker</th>
                  <th style="text-align:center;">Direktur</th>
                  <th style="text-align:center;">Admin Nomor</th>
                  <th style="text-align:center;">Direktur Jenderal</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $i = 1;
                foreach ($data as $value) { 
                  ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?=$value->faskes_code; ?></td>
                  <td><?=$value->nama_pm; ?></td>
                  <td style="text-align:center;"><h5 style="color:green;">&#x2713;</h5></td>
                  <?php if ($value->survei_kepuasan_ssm == null){ ?>
                    <td></td>
                  <?php }else{ ?>
                     <td style="text-align:center;"><h5 style="color:green;">&#x2713;</h5></td>
                  <?php } ?>
                  <?php if ($value->satset == null){ ?>
                    <td></td>
                  <?php }else{ ?>
                     <td style="text-align:center;"><h5 style="color:green;">&#x2713;</h5></td>
                  <?php } ?>
                  <?php if ($value->tanggal_pengajuan == null){ ?>
                    <td></td>
                  <?php }else{ ?>
                     <td style="text-align:center;"><h5 style="color:green;">&#x2713;</h5></td>
                  <?php } ?>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php }?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>