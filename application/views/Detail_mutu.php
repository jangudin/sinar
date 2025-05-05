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
                  <?php foreach ($nilai as $e) { ?>
                  <h4><?=$e->nama ?>&nbsp;&nbsp;&nbsp; : &nbsp;<?=$e->nilai ?></h4>
                  <?php }?>
                    <!-- <table class="table table-striped table-sm">
                  
                  <tr>
                    <td><?=$e->nama ?></td>
                    <td>:</td>
                    <td><?=$e->nilai ?></td>
                  </tr>
                  
                  </table> -->
                
                <br>


                <table  class="table table-striped table-sm">
                  <tr>
                    <td>Surveior</td>
                    <td>Status</td>
                  </tr>
                  <?php foreach ($skorsing as $x) { ?>
                  <tr>
                    <td><?=$x->nama_surveior ?></td>
                    <?php if (($x->tanggal_mulai >= $x->star) && ($x->tanggal_mulai <= $x->Endd)){ ?>
                    <td><span class="badge badge-danger">Survei Pada Waktu skosing</span></td>
                    <?php }else{ ?>
                       <td><span class="badge badge-success">Surveiour Aktif</span></td>
                    <?php } ?>
                  </tr>
                  <?php }?>
                </table>

                <br>

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
<!--                   <tr>
                    <td><input type="text" class="form-control" placeholder="Input Passphrase"></td>
                    <td>:</td>
                    <td><a href="<?php echo base_url('Lembaga/Lars/');?><?=$s->id
                     ?>" type="button" class="btn btn-primary">TTE SERTIFIKAT</a></td>
                  </tr> -->
                  
                  </table>
                </br>
                </br>
                <hr>
                <?php if($attachment): ?>
                            <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
                            <iframe src="<?= $attachment?>" frameborder="0" width="100%" height="1000px"></iframe>
                <?php else: ?>
                     <h1>Data tidak di temukan</h1>
                <?php endif; ?>
                    <br />
                    <br />
                    <hr>
                    <br />
                   <?php if($s->mutu == 0): ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Verifikasi</button>
                   <?php else: ?>
                   <?php endif;?>

                    <?php } ?>

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal form-label-left" action="<?= base_url('Mutu_fasyankes/Verifikasi_mutu') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Verifikasi <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-6 ">
                              <select name="status" class="form-control" required>
                                <option value="">Pilih Verifikasi</option>
                                <option value="1">Setuju</option>
                                <option value="2">Tidak Setuju</option>
                              </select>
                              <input name="id" class="form-control" type="hidden" value="<?= $id ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Keterangan <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-6 ">
                              <textarea name="keterangan" class="form-control"></textarea> 
                            </div>
                          </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                  <br>
                                                    <button type='submit' class="btn btn-primary">Simpan </button>
                                                </div>
                                            </div>
                                        </div>
                        </form>
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