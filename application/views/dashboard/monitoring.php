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
            <a href="<?php echo base_url('Mutu_fasyankes/monitoring/pkm') ?>" class="btn btn-success">Puskesmas</a>
            <a href="<?php echo base_url('Mutu_fasyankes/monitoring/klinik') ?>" class="btn btn-success">Klinik</a>
            <a href="<?php echo base_url('Mutu_fasyankes/monitoring/Labkes') ?>" class="btn btn-success">Labkes</a>
          </div>

            <h5>Lebih dari 7 Hari : <a class="btn btn-danger"> _____ </a></h5>

          <div class="x_content">
            <table  id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Faskes</th>
                  <th>Kode Faskes</th>
                  <th>TGL Survei</th>
                  <th>Ketua TIM</th>
                  <th>Direktur</th>
                  <th>TU MPK</th>
                  <th>LPA</th>
                  <th>Dirjen</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $i = 1;
                foreach ($datam as $value) { ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?=$value->NamaFaskes; ?></td>
                    <td style="text-align:center;"><?=$value->kode_faskes; ?></td>
                    <td style="text-align:center;"><?=$value->tanggal_survei; ?></td>

                    <?php if ($value->katim > 7  ) { ?>
                      <td style="background-color:red; color:white; font-weight: bold; text-align:center; font-size:17px;"><?=$value->katim; ?></td>
                    <?php }else{ ?>
                      <td style="text-align:center; font-weight: bold; font-size:17px;"><?=$value->katim; ?></td>
                    <?php }?>

                    <?php if ($value->direktur > 7  ) { ?>
                      <td style="background-color:red; color:white; text-align:center; font-weight: bold; font-size:17px;"><?=$value->katim; ?></td>
                    <?php }else{ ?>
                      <td style="text-align:center; font-weight: bold; font-size:17px;"><?=$value->direktur; ?></td>
                    <?php }?>

                    <?php if ($value->adminNomor > 7  ) { ?>
                      <td style="background-color:red; color:white; text-align:center; font-weight: bold; font-size:17px;"><?=$value->katim; ?></td>
                    <?php }else{ ?>
                      <td style="text-align:center; font-weight: bold; font-size:17px;"><?=$value->adminNomor; ?></td>
                    <?php }?>

                    <?php if ($value->lpa > 7  ) { ?>
                      <td style="background-color:red; text-align:center; color:white; font-weight: bold; font-size:17px;"><?=$value->katim; ?></td>
                    <?php }else{ ?>
                      <td style="text-align:center; font-weight: bold; font-size:17px;"><?=$value->lpa; ?></td>
                    <?php }?>                  

                    <?php if ($value->dirjen > 7  ) { ?>
                      <td style="background-color:red; text-align:center; color:white; font-weight: bold; font-size:17px;"><?=$value->katim; ?></td>
                    <?php }else{ ?>
                      <td style="text-align:center; font-weight: bold; font-size:17px;"><?=$value->dirjen; ?></td>
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