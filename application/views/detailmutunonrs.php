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
                  <tr>
                    <td>Lembaga Penyelenggara Akreditasi</td>
                    <td>:</td>
                    <td> <?=$s->lpa ?></td>
                  </tr>
                  </table>
                </br>
                <hr>
                            <!-- <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
                            <iframe src="<?= $attachment?>" frameborder="0" width="100%" height="900px"></iframe> -->
               
                    <br />
                    <hr>
                    <br />
                    <br />   
                    <br>
                    <br> 
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Verifikasi</button>
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
                <form class="form-horizontal form-label-left" action="<?= base_url('Mutu_fasyankes/simpanverifikasi') ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Verifikasi <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-6 ">
                      <select name="status_direktur" class="form-control" required>
                        <option value="">Pilih Verifikasi</option>
                        <option value="1">Setuju</option>
                        <option value="2">Tidak Setuju</option>
                      </select>
                      <input name="persetujuan_ketua_id" class="form-control" type="hidden" value="<?= $s->pengajuan_id ?>">
                      <input name="kode_faskes" class="form-control" type="hidden" value="<?= $s->fasyankes_id ?>">
                      <input name="idp" class="form-control" type="hidden" value="<?= $s->idp ?>">
                      <input name="nama_faskes" class="form-control" type="hidden" value="<?=$s->nama_fasyankes ?>">
                      <input name="jenis_faskes" class="form-control" type="hidden" value="<?=$s->jenis_fasyankes_nama ?>">
                      <input name="lpa" class="form-control" type="hidden" value="<?=$s->inisial ?>">
                      <input name="alamat" class="form-control" type="hidden" value="<?= $s->alamat ?>">
                      <input name="kecamatan" class="form-control" type="hidden" value="<?= $s->nama_camat ?>">
                      <input name="kabkot" class="form-control" type="hidden" value="<?= $s->nama_kota ?>">
                      <input name="provinsi" class="form-control" type="hidden" value="<?= $s->nama_prop ?>">
                      <input name="capayan" class="form-control" type="hidden" value="<?= $s->status_akreditasi ?>">
                      <input name="tgl_surveior" class="form-control" type="hidden" value="<?= $s->tgl_surveior ?>">
                      <input name="logo" class="form-control" type="hidden" value="<?= $s->logo ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Keterangan <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-6 ">
                      <textarea name="catatan_direktur" class="form-control"></textarea> 
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
                                    
                  <br />
                  <hr>
                  <br />
                  <br />
            </div>
          </div>
        </div>
