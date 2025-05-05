<div class="right_col" role="main">
  <div class="">

    <div class="clearfix">
      <div class="row">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
          <div class="tile-stats">
            <div class="icon">
            </div>
            <div class="count"><i class="fa fa-folder"></i></div>
            <h3>Puskesmas (Ari babi)</h3>
          </div>
        </div>
      </div>
      <br />
      <br />
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <a class="btn btn-sm btn-success" href="<?php echo base_url('Surat_tugas/general/belum')  ?>"><span data-feather="edit"></span>BELUM TTE</a>
              <a class="btn btn-sm btn-success" href="<?php echo base_url('Surat_tugas/general/sudah')  ?>"><span data-feather="edit"></span>SUDAH TTE</a>
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

            <!-- <table id="datatable" class="table table-striped table-bordered" style="width:100%"> -->
              <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Faskes</th>
                    <th>Nama Faskes</th>
                    <th>LPA</th>

                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                 $i = 1;
                 foreach ($data as $a) { ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?=$a->kode_faskes ?></td>
                    <td><?=$a->nama_fasyankes ?></td>
                    <td><?=$a->inisial ?></td>
                    <td><?php if($a->cek == null):?>
                    <a class="btn btn-sm btn-success" href="<?php echo base_url('Surat_tugas/detail/'.$a->kode_faskes)  ?>"><span data-feather="edit"></span> TTE SURAT TUGAS</a>
                  <?php else:?>
                    <a class="btn btn-sm btn-success" href="<?php echo base_url('Surat_tugas/detail/'.$a->kode_faskes)  ?>"><span data-feather="edit"></span>LIHAT BERKAS</a>
                  <?php endif;?>
                      

                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>