<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <br />
    <br />
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Faskes</h2>
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
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Faskes <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="first-name" required="required" class="form-control ">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">LPA <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="last-name" name="last-name" required="required" class="form-control">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nama Faskes / Kode faskes</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input id="middle-name" class="form-control" type="text" name="middle-name">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                      <div class="col-md-6 col-sm-6 offset-md-3">
                        <button class="btn btn-primary" type="button">Cancel</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>
                  <hr>
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Faskes</th>
                        <th>Nama Faskes</th>
                        <th>Jenis Faskes</th>
                        <th>LPA</th>
                        <th>Lihat</th>
                      </tr>
                    </thead>
                    <?php 
                    $i = 1;
                    foreach ($data_all as $a) { ?>


                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?=$a->kode_faskes ?></td>
                        <td><?=$a->nama_faskes ?></td>
                        <td><?=$a->jenis_faskes ?></td>
                        <td><?=$a->lpa ?></td>
                        <td>
                          <a class="btn btn-sm btn-success" href="<?php echo base_url('Mutu_fasyankes/Detail/'.$a->id);?>"><span data-feather="edit"></span> Lihat Data</a>

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
<script type="text/javascript">
  $(document).ready(function(){
    $( "#name" ).autocomplete({
      source: "<?php echo site_url('Home/get_autocomplete/?');?>"
    });
  });
</script>