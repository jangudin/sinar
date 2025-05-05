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
            <!-- <a href="<?php echo base_url('DirjenYankes/monitoring_rs') ?>" class="btn btn-success">Rumah Sakit</a> -->
            <a href="<?php echo base_url('AkreditasiNonRS/monitoring/pkm') ?>" class="btn btn-success">Puskesmas</a>
            <a href="<?php echo base_url('AkreditasiNonRS/monitoring/klinik') ?>" class="btn btn-success">Klinik</a>
            <a href="<?php echo base_url('AkreditasiNonRS/monitoring/Labkes') ?>" class="btn btn-success">Labkes</a>
            <a href="<?php echo base_url('AkreditasiNonRS/monitoring/Utd') ?>" class="btn btn-success">UTD</a>
            <!-- <a href="<?php echo base_url('AkreditasiNonRS/monitoring_tpmd') ?>" class="btn btn-success">TPMD/TPMDG</a> -->
          </div>

            <h5><a class="btn btn-danger"> _____ </a> : Lebih dari 7 Hari</h5>
            <h5>&#x2713; : Sudah Selesai</h5>

          <div class="x_content">
            <table  id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Faskes</th>
                  <th style="text-align:center;">Kode Faskes</th>
                  <th style="text-align:center;">Nama LPA</th>
                  <th style="text-align:center;">TGL Akhir Survei</th>
                  <th style="text-align:center;">LPA</th>
                  <th style="text-align:center;">Ketua Timker</th>
                  <th style="text-align:center;">Direktur</th>
                  <th style="text-align:center;">Admin Penomoran Timker</th>
                  <th style="text-align:center;">Ketua LPA</th>
                  <th style="text-align:center;">Direktur Jenderal</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $i = 1;
                foreach ($datam as $value) { 
                  ?>

                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?=$value->NamaFaskes; ?></td>
                    <td style="text-align:center;"><?=$value->kode_faskes; ?></td>
                    <td style="text-align:center;"><?=$value->nmLPA; ?></td>
                    <td style="text-align:center;"><?=$value->tanggal_survei; ?></td>

                    <?php if ($value->idk == null) { ?>
                      <?php if ($value->rekom > 7 ) {?>
                      <td style=" color:red; font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->rekom; ?></h5></td>
                     <?php }else{?>
                      <td style="font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->rekom; ?></h5></td>
                      <?php }?>
                    <?php }else{ ?>
                    <td style="font-weight: bold; text-align:center; font-size:17px;"> <h5 style="color:green;">&#x2713;</h5>
                      <?php if ($value->rekom > 7 ) {?>
                      <h5 style="color:red;"><?=$value->rekom;?></h5>
                    <?php }else{?>
                      <h5 style="color:green;"><?=$value->rekom;?></h5>
                      <?php }?>
                      </td>
                    <?php }?>

                    <?php if ($value->idk == null) { ?>
                      <?php if ($value->katim > 7 ) {?>
                      <td style=" color:red; font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><?=$value->katim; ?></h5></td>
                     <?php }else{?>
                      <td style="font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->katim; ?></h5></td>
                      <?php }?>
                    <?php }else{ ?>
                    <td style="font-weight: bold; text-align:center; font-size:17px;"> <h5 style="color:green;">&#x2713;</h5>
                      <?php if ($value->katim > 7 ) {?>
                      <h5 style="color:red;"><?=$value->katim;?></h5>
                    <?php }else{?>
                      <h5 style="color:green;"><?=$value->katim;?></h5>
                      <?php }?>
                      </td>
                    <?php }?>

                    <?php if ($value->idd == null) { ?>
                      <?php if ($value->direktur > 7 ) {?>
                      <td style="color:red; font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->direktur; ?></h5></td>
                     <?php }else{?>
                      <td style="font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->direktur; ?></h5></td>
                      <?php }?>
                    <?php }else{ ?>
                    <td style="color:green; font-weight: bold; text-align:center; font-size:17px;"> <h5>&#x2713;</h5>
                      <?php if ($value->direktur > 7 ) {?>
                      <h5 style="color:red;"><?=$value->direktur; ?></h5>
                    <?php }else{?>
                      <h5 style="color:green;"><?=$value->direktur; ?></h5>
                      <?php }?></td>
                    <?php }?>

                    <?php if ($value->tgl_nomor_surat == null) { ?>
                      <?php if ($value->adminNomor > 7) { ?>
                      <td style="color:red; font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->adminNomor; ?></h5></td>
                    <?php }else{ ?>
                    <td style="font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->adminNomor; ?></h5></td>
                    <?php }?>
                    <?php }else{ ?>
                    <td style="color:green; font-weight: bold; text-align:center; font-size:17px;"> <h5>&#x2713;</h5>
                       <?php if ($value->adminNomor > 7 ) {?>
                      <h5 style="color:red;"><?=$value->adminNomor; ?></h5>
                    <?php }else{?>
                      <h5 style="color:green;"><?=$value->adminNomor; ?></h5>
                      <?php }?>
                    </td>
                    <?php }?>

                    <?php if ($value->nmLPA == "KEMENKES") { ?>
                      <td></td>
                    <?php }else{ ?>
                    <?php if ($value->idl == null) { ?>
                      <?php if ($value->lpa > 7) { ?>
                      <td style="color:red; font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->lpa; ?></h5></td>
                    <?php }else{ ?>
                    <td style="font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->lpa; ?></h5></td>
                    <?php }?>
                    <?php }else{ ?>
                    <td style="color:green; font-weight: bold; text-align:center; font-size:17px;"> <h5>&#x2713;</h5>
                      <?php if ($value->lpa > 7 ) {?>
                      <h5 style="color:red;"><?=$value->lpa; ?></h5>
                    <?php }else{?>
                      <h5 style="color:green;"><?=$value->lpa; ?></h5>
                      <?php }?></td>
                    <?php }?>
                    <?php }?>

                    <?php if ($value->iddir == null) { ?>
                      <?php if ($value->dirjen > 7) { ?>
                      <td style="color:red; font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->dirjen; ?></h5></td>
                    <?php }else{ ?>
                    <td style="font-weight: bold; text-align:center; vertical-align: middle; font-size:17px;"><h5><?=$value->dirjen; ?></h5></td>
                    <?php }?>
                    <?php }else{ ?>
                    <td style="color:green; font-weight: bold; text-align:center; font-size:17px;"> <h3>&#x2713;</h3>
                      <?php if ($value->dirjen > 7 ) {?>
                      <h5 style="color:red;"><?=$value->dirjen; ?></h5>
                    <?php }else{?>
                      <h5 style="color:green;"><?=$value->dirjen; ?></h5>
                      <?php }?></td>
                    <?php }?>
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