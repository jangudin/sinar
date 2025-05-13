<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <br />
    <br />
    <div class="row">
      <div class="col-md-12 col-sm-12 ">

        <div class="x_panel">
          <div class="x_title">
            <h2>List Rumah Sakit<small> TTE dirjen</small></h2>
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
          <div class="x_content">
            <div class="row">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-copy"></i>
                  </div>
                  <div class="count"><?php echo $belumtte->belumTTE; ?></div>
                  <h3>Belum TTE</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-copy"></i>
                  </div>
                  <div class="count"><?php echo $sudahtte->sudahTTE; ?></div>
                  <h3>Sudah TTE</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>KodeRS</th>
                        <th>Nama RS</th>
                        <th>Lembaga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <?php
                    $i = 1;
                    foreach ($data as $a) { ?>


                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $a->kodeRS ?></td>
                        <td><?= $a->namaRS ?></td>
                        <td><?= $a->lembagaAkreditasiId ?></td>
                        <td></td>
                        <td>

                          <a class="btn btn-sm btn-success" href="<?php echo base_url('DirjenYankes/Detail/' . custom_encrypt($a->id)); ?>"><span data-feather="edit"></span> Detail</a>


                        </td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>