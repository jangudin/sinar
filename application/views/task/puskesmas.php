<div class="right_col" role="main">
  <div class>
    <div class="page-title">
      <div class="title_left">
        <h3>Task <small>Wahyudin</small></h3>
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
        <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Design <small>different form elements</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a class="dropdown-item" href="#">Settings 1</a>
                  </li>
                  <li><a class="dropdown-item" href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br/>
            <form action="<?php echo base_url('Task/integrasi_puskesmas') ?>" method="Post" enctype="multipart/form-data" name="kode" class="form-horizontal form-label-left">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Input Kode Faskes <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="first-name" required="required" name="code" class="form-control ">
                  <br>
                  <input type="submit" value="simpan">
                </div>
              </div>
            </form>


            <div class="ln_solid"></div>



          </div>
        </div>
      </div>
    </div>
    
    <!-- <div class="clearfix"></div>
    <div class="row" style="display: block;">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>DB <small>Puskesmas</small></h2>
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
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>code</th>
                  <th>Kode Sarana</th>
                  <th>Kode Baru</th>
                  <th>Alamat Sertifikat</th>
                  <th>Alamat</th>
                  <th>Provinsi</th>
                  <th>Kab / Kota</th>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                </tr>
              </thead>
              <tbody>
               <?php  
               foreach ($puskesmas as $value) { ?>
                <tr>
                  <td><?= $value->id; ?></td>
                  <td><?= $value->name; ?></td>
                  <td><?= $value->code; ?></td>
                  <td><?= $value->kode_sarana; ?></td>
                  <td><?= $value->kode_baru; ?></td>
                  <td><?= $value->alamat_sertifikat; ?></td>
                  <td><?= $value->alamat; ?></td>
                  <td><?= $value->provinsi_nama; ?></td>
                  <td><?= $value->kabkot_nama; ?></td>
                  <td><?= $value->kecamatan_nama; ?></td>
                  <td><?= $value->kelurahan_nama; ?></td>
                </tr>
              <?php }?> 
            </tbody>
          </table>
        </div>
      </div>
    </div> -->
  <div class="clearfix"></div>
</div>
</div>
</div>