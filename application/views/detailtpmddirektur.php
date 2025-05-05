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
                  <td><?=$s->nama_pm ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td><?=$s->alamat_faskes ?></td>
                </tr>
              </table>
            </br>
            <hr>
            <?php if($valid == NULL): ?>
              <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
              <iframe src="<?= $attachment ?>" frameborder="0" width="100%" height="1000px"></iframe>
              <br />
              <br />
              <hr>
              <br />
              <br />
              <form class="form-horizontal form-label-left" action="<?= base_url('Mutu_fasyankes/simpanverifikasitpmd') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Verifikasi <span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-6 ">
                    <select name="status_direktur" class="form-control" required>
                      <option value="">Pilih Verifikasi</option>
                      <option value="1">Setuju</option>
                      <option value="2">Tidak Setuju</option>
                    </select>
                    <input name="kode_faskes" class="form-control" type="hidden" value="<?= $s->kode_faskes_baru ?>">
                    <input name="idp" class="form-control" type="hidden" value="<?=$idp?>">
                    <input name="nama_faskes" class="form-control" type="hidden" value="<?=$s->nama_pm ?>">
                    <input name="jenis_faskes" class="form-control" type="hidden" value="TPMD">
                    <input name="lpa" class="form-control" type="hidden" value="KEMKES">
                    <input name="alamat" class="form-control" type="hidden" value="<?= $s->alamat_faskes ?>">
                    <input name="kecamatan" class="form-control" type="hidden" value="<?= $s->nama_camat ?>">
                    <input name="kabkot" class="form-control" type="hidden" value="<?= $s->nama_kota_temp1 ?>">
                    <input name="provinsi" class="form-control" type="hidden" value="<?= $s->nama_prop ?>">
                    <input name="tgl_surveior" class="form-control" type="hidden" value="<?= $tgls?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Keterangan <span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-6 ">
                    <hiddenarea name="catatan_direktur" class="form-control"></hiddenarea> 
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
            <?php else: ?>
              <?php if($hasiltte): ?>
                <label>Sertifikat <a href="<?= $hasiltte ?>" target="_blank">(Layar Penuh)</a></label><br/>
                <iframe src="<?= $hasiltte?>" frameborder="0" width="100%" height="1300px"></iframe>
              <?php else: ?>
               <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
               <iframe src="<?= $attachment?>" frameborder="0" width="100%" height="1300px"></iframe>
             <?php endif; ?>
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
