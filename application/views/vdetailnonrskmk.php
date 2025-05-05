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
                  <?php foreach ($detail as $s) { ?>
                  <tr>
                    <td>Nama Faskes</td>
                    <td>:</td>
                    <td><?=$s->nama_fasyankes ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?=$s->alamat ?></td>
                  </tr>
                  <tr>
                    <td>Tingkat Kelulusan</td>
                    <td>:</td>
                    <td><?=$s->status_akreditasi ?></td>
                  </tr>
                  </table>
                </br>
                <hr>
                <?php if($attachment): ?>
                            <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
                            <iframe src="<?= $attachment?>" frameborder="0" width="100%" height="1300px"></iframe>
                <?php else: ?>
                    <label>Sertifikat <a href="<?= $hasiltte ?>" target="_blank">(Layar Penuh)</a></label><br/>
                    <iframe src="<?= $hasiltte ?>" frameborder="0" width="100%" height="1000px"></iframe>
                    <br />
                    <br />
                    <hr>
                    <br />
                    <br />   
                    <br>
                    <br> 
                    
                    <form class="form-horizontal form-label-left" action="<?= base_url('DirjenYankes/ttedirjenonrs') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nik <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" name="nik" value="<?php $this->session->userdata('nik') ?>" required="required" class="form-control">
                              <input type="hidden" value="<?=$s->idp ?>" name="idp" required="required" class="form-control  ">
                              <input type="hidden" value="KEMENKES" name="lembaga" required="required" class="form-control">
                              <!-- <input type="hidden" value="<?=$s->id_lpa ?>" name="tte_lpa_id" required="required" class="form-control"> -->
                              <input type="hidden" value="<?=$s->fasyankes_id ?>" name="id" required="required" class="form-control  ">
                              <input type="hidden" value="<?=$s->jenis_faskes ?>" name="jenis" required="required" class="form-control  ">
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
                       <?php } ?>
                          
                  </div>
                </div>
              </div>
                                    
                  <br />
                  <hr>
                  <br />
                  <br />

                  
                    
              <!-- <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Progres Sertifikat <small>Sessions</small></h2>
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
                  <ul class="list-unstyled timeline">
                    <li>
                      <div class="block">
                        <div class="tags">
                          <a href="" class="tag">
                            <span>Lembaga</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title">
                                          <a>Dikirim Ke Direktorat Mutu</a>
                                      </h2>
                          <div class="byline">
                            <span>18 Oktober 2022</span> by <a>Jane Smith</a>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="tags">
                          <a href="" class="tag">
                            <span>Mutu</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title">
                                          <a>Dikirim Ke Dirjen Yankes</a>
                                      </h2>
                          <div class="byline">
                            <span>18 Oktober 2022</span> by <a>Jane Smith</a>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="tags">
                          <a href="" class="tag">
                            <span>Dirgen Yankes</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <h2 class="title">
                                          <a>Selesai Ditandatangani</a>
                                      </h2>
                          <div class="byline">
                            <span>18 Oktober 2022</span> by <a>Jane Smith</a>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>

                </div>
              </div>
            </div> -->
            </div>
          </div>
        </div>
