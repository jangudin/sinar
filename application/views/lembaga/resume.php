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
                <?php echo $this->session->flashdata('msg');?>
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
                    <td><?=$s->no_sertifikat ?></td>
                  </tr>
                  <tr>
                    <td>Tikat Kelulusan</td>
                    <td>:</td>
                    <td><?= $s->capayan ?></td>
                  </tr>
                  <tr>
                    <td>Berlaku</td>
                    <td>:</td>
                    <td><?= format_indo($s->tanggal_kadaluarsa_sertifikat);?></td>
                  </tr>
                  <?php } ?>
                  </table>
                </br>
                <hr>
                <?php if($attachment): ?>
                            <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
                            <iframe src="<?= $attachment?>" frameborder="0" width="100%" height="1300px"></iframe>
                <?php else: ?>
                    <label>Sertifikat <a href="<?= $hasiltte ?>" target="_blank">(Layar Penuh)</a></label><br/>
                    <iframe src="<?= $hasiltte ?>" frameborder="0" width="100%" height="1000px"></iframe>
                <?php endif; ?>
                     <br />
                    <br />
                    <hr>
                    <br />
                    <br />   
                    <br>
                    <br> 
                      </div>
                    </div>
                  </div>  
                                   
                  <br />
                  <hr>
                  <br />
                  <br />
            </div>
          </div>
        </div>
