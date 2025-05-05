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
                  <?php foreach ($data as $s) { ?>
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
                    <td><?=$s->capayan ?></td>
                  </tr>
                  <tr>
                    <td>Berlaku</td>
                    <td>:</td>
                    <td><?=$s->tanggal_kadaluarsa_sertifikat ?></td>
                  </tr>
                  <tr>
                    <td>Nama Surveior</td>
                    <td>:</td>
                  </tr>
<!--                   <tr>
                    <td><input type="text" class="form-control" placeholder="Input Passphrase"></td>
                    <td>:</td>
                    <td><a href="<?php echo base_url('Lembaga/Lars/');?><?=$s->id
                     ?>" type="button" class="btn btn-primary">TTE SERTIFIKAT</a></td>
                  </tr> -->
                  <?php } ?>
                  </table>
                </br>
                <hr>
                <?php if($dirjen): ?>
                            <label>Sertifikat <a href="<?= $dirjen ?>" target="_blank">(Layar Penuh)</a></label><br/>
                            <iframe src="<?= $dirjen?>" frameborder="0" width="100%" height="1000px"></iframe>
                <?php else: ?>
                    <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
                    <iframe src="<?= $attachment ?>" frameborder="0" width="100%" height="1000px"></iframe>
                    <br />
                    <hr>
                    <br />
                    <br />   
                    <br>
                    <br> 
                    <form class="form-horizontal form-label-left" action="<?= base_url('DirjenYankes/Dirjentte') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nik <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" name="nik" value="<?= $nik ?>" required="required" class="form-control">
                              <input type="hidden" value="<?=$s->lembagaAkreditasiId ?>" name="lembaga" required="required" class="form-control" readonly>
                              <input type="hidden" value="<?= $id ?>" name="id" required="required" class="form-control  ">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Passprase <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="password" id="last-name" name="passphrase" required="required" class="form-control ">
                            </div>
                          </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                  <br>
                                                    <button type='submit' class="btn btn-primary" onclick="spinner()">TTE SERTIFIKAT</button>
                                                </div>
                                            </div>
                                        </div>
                        </form>

                <?php endif; ?> 
                    
                  </div>
                </div>
              </div>  
                
            </div>
          </div>
        </div>