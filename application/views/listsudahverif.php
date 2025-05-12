<div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <br />
            <br />
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Rumah Sakit<small> TTE lembaga</small></h2>
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
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>KodeRS</th>
                                    <th>Nama RS</th>
                                    <th>Lembaga</th>
                                    <th>Status Verifikasi</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php 
                    $i = 1;
                    foreach ($data as $a) { ?>
                <tr>
                <td><?= $i ?></td>
                <td><?=$a->kodeRS ?></td>
                <td><?=$a->namaRS ?></td>
                <td><?=$a->lembagaAkreditasiId ?></td>
                <td><?php if ($a->mutu == 1) : ?>
                  <span class="badge badge-success"> Disetujui </span>
                    <?php elseif ($a->mutu == 2) : ?>
                  <span class="badge badge-danger"> Ditolak </span>
                    <?php endif ?>
                </td>
                <td>
                  <a class="btn btn-sm btn-success" href="<?php echo base_url('Mutu_fasyankes/Detail/');?><?php if (!is_null($item->id)): ?><?= encrypt($a->id) ?><?php else: ?><?php endif; ?>"><span data-feather="edit"></span> Review</a>
                  
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