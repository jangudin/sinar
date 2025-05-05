<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <!-- <h3>Detail</h3> -->
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5">
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail</h2>
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
                  <table class="table table-striped table-sm">
                  <?php foreach ($rs as $s) { ?>
                  <tr>
                    <td>Nama Rumah Sakit</td>
                    <td>:</td>
                    <td><?=$s->namaRS ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?=$s->ALAMAT ?></td>
                  </tr>
                  <tr>
                    <td>Nomor Sertifikat</td>
                    <td>:</td>
                    <td>1010/IX</td>
                  </tr>
                  <tr>
                    <td>Tikat Kelulusan</td>
                    <td>:</td>
                    <td>PARIPURNA</td>
                  </tr>
                  <tr>
                    <td>Berlaku</td>
                    <td>:</td>
                    <td>10 Desesmber 2023</td>
                  </tr>
                  <tr>
                    <td><input type="text" class="form-control" placeholder="Input Passphrase"></td>
                    <td>:</td>
                    <td><a href="<?php echo base_url('Lembaga/Lars/');?><?=$s->id
                     ?>" type="button" class="btn btn-primary">TTE SERTIFIKAT</a></td>
                  </tr>
                  <?php } ?>
                  </table>
                  <!-- <iframe src="<?php echo base_url('assets/sertifikat38.pdf');?>" frameborder="0" width="100%" height="1000px"></iframe> -->
                    <br />
                    <br />
                    <br />
                    <br />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>