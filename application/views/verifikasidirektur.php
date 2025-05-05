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
                        <th>Kode Fasyankes</th>
                        <th>Nama Fasyankes</th>
                        <th>Jenis Fasyankes</th>
                        <th>LPA</th>
                        <th>Provinsi</th>
                        <th>KAB / KOT</th>
                        <th>TGL Verifikasi</th>
                        <th>Verifikasi KATIM</th>
                        <th>Verifikasi Direktur</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <?php 
                    $i = 1;
                    foreach ($data as $a) { ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?=$a->fasyankes_id ?></td>
                        <td><?=$a->nama_fasyankes ?></td>
                        <td><?=$a->jenis_fasyankes_nama ?></td>
                        <td><?=$a->lpa ?></td>
                        <td><?=$a->nama_prop ?></td>
                        <td><?=$a->nama_kota ?></td>
                        <td><?php echo date('Y-m-d'); ?></td>
                        <td>
                          <button type="button" class="btn btn-success btn-sm" onclick="">Diterima</button>
                          <button type="button" class="btn btn-primary btn-sm" onclick="">Catatan</button>
                        </td>
                        <td><span class="badge bg-warning">Belum Verifikasi</span></td>
                        <td><button type="button" class="btn btn-success btn-sm" onclick="">Verifikasi</button></td>
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