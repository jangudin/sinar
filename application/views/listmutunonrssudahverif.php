<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <br />
    <br />
    <?php echo $this->session->flashdata('msg');?>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Daftar Faskes Sudah Verifikasi</h2>
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

          <br>

          <!-- <div class="border">
            <form>
              <div class="item form-group">
                <label class=""><b>Pilih Jenis Faskes</b> <span class="required">*</span>
                </label>
                <select class="select2_single" tabindex="-1" name="faskes">
                  <option value="">Pilih ...</option>
                  <option value="Puskesmas">Puskesmas</option>
                  <option value="Klinik">Klinik</option>
                </select>

                 <div class="col-md-4 col-sm-4 ">
                  <input type="submit" class="btn btn-success" value="Tampilkan">
                 </div>
            </form>
          </div> -->
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="GET" action="<?= base_url('Mutu_fasyankes/nonrssudahverifikasi') ?>">
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"><b>Pilih Jenis Faskes</b> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select class="select2_single form-control" tabindex="-1" name="faskes">
                  <option value="">Pilih ...</option>
                  <option value="Puskesmas">Puskesmas</option>
                  <option value="Klinik">Klinik</option>
                  <option value="Labkes">Labkes</option>
                  <option value="utd">UTD</option>
                </select>

              </div>
              <div class="col-md-4 col-sm-4 ">
               <input type="submit" class="btn btn-success" value="Tampilkan">
             </div>
           </div>
         </form>

         <br>


         <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Fasyankes</th>
              <th>Nama Fasyankes</th>
              <th>Jenis Fasyankes</th>
              <th>LPA</th>
              <th>Provinsi</th>
              <th>Kab/Kota</th>
              <th>TGL Verifikasi Direktur </th>
              <th style="width: 6%">Hasil Verifikasi Direktur</th>
            </tr>
          </thead>
          <?php 
          $i = 1;
          foreach ($databelum as $a) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?=$a->fasyankes_id ?></td>
              <td><?=$a->nama_fasyankes ?></td>
              <td><?=$a->jenis_fasyankes_nama ?></td>
              <td><?=$a->lpa ?></td>
              <td><?=$a->nama_prop ?></td>
              <td><?=$a->nama_kota ?></td>
              <td><?=$a->tgldir ?></td>
              <td>
                <?php if ($a->direktur == 2): ?>
                <span class="badge badge-danger">Perbaikan</span>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".direktur<?=$a->fasyankes_id ?>">Catatan</button>
                <?php elseif($a->direktur == 1) : ?>
                <span class="badge badge-success">Diterima</span>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".direktur<?=$a->fasyankes_id ?>">Catatan</button>
                <?php endif ?></td>
              </tr>
              <div class="modal fade katim<?=$a->fasyankes_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel2" style="color: black;"> Catatan Direktur</h4>
                    </div>
                    <div class="modal-body">
                      <p style="color: black;"><?=$a->catatan_ketua ?></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade direktur<?=$a->fasyankes_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel2" style="color: black;"> Catatan Direktur</h4>
                    </div>
                    <div class="modal-body">
                      <?php if ($a->catatan_direktur == null) : ?>
                        <p style="color: black;">Tidak ada catatan</p>
                      <?php else: ?>
                        <p style="color: black;"><?=$a->catatan_direktur ?></p>
                      <?php endif ?>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>

  </div>
</div>
</div>
</div>