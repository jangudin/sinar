<div class="right_col" role="main">
      <div class="clearfix"></div>
  <div class="">
    <div class="clearfix"></div>
    <br />
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="GET" action="<?= base_url('AdminNomorSurat') ?>">

   </form>
   <?php echo $this->session->flashdata('msg'); ?>
   <div class="row">
    <div class="col-md-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Jumlah belum input nomor : <?php 
        echo (isset($belum) && !is_null($belum) && isset($belum->belum)) ? $belum->belum : 0; 
    ?> </h2>
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
        <h6><code>*Jika telah input nomor sertifikat klik simpan</code></h6>
        <div class="x_content">
          <div class="table-responsive">
            <table id="" class="table table-striped jambo_table bulk_action" style="width:100%">
              <thead>
                <tr class="headings">
                  <th class="column-title">No</th>
                  <th class="column-title">Kode Faskes </th>
                  <th class="column-title">Nama Faskes </th>
                  <th class="column-title">Jenis Faskes </th>
                  <th class="column-title">Tgl Sertifikat</th>
                  <th class="column-title">Nomor Sertifikat</th>
                  <th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($data as $a) { 
                    $key = $a->kode_faskes;

                    ?>
                    <tr class="even pointer">
                      <td style="text-align: center;"><?= $i++ ?></td>
                      <td><?=$a->kode_faskes ?></td>
                      <td><?=$a->nama_faskes ?></td>
                      <td><?=$a->jenis_faskes ?></td>
                      <?php if ($a->nomor_surat == null ): ?>
                        <form action="<?php echo base_url('AdminNomorSurat/input_nomor_tpmd')?>" method="post">
                          <input type="hidden" id="fullname" class="form-control" name="jenisfaskes" value="<?=$a->jenis_faskes ?>" />
                          <td><input type="date" id="fullname" class="form-control" name="tgl_nomor_surat[<?= $key;?>]"  required />
                            <input type="hidden" id="fullname" class="form-control" name="kode_faskes"  value="<?=$a->kode_faskes ?>" /></td>
                            <td><input type="number" id="fullname" class="form-control" name="nomor_surat[<?= $key;?>]" required />
                              <input type="hidden" id="fullname" class="form-control" name="id[]"  value="<?=$key ?>" /></td>

                            <?php else: ?>
                              <td><?=$a->tgl_nomor_surat ?></td>
                              <td><?=$a->nomor_surat ?></td>
                              <td><h6><span class="badge badge-success" style="font-size: ;">Telah Diberi Nomor</span></h6>
                                <?php if ($a->data_sertifikat_tpmd_id == null ) :?> 
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?=$a->id ?>">Hapus Nomor</button>
                                <?php else:?>
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal<?=$a->id ?>">Hapus Nomor</button>
                                <?php endif; ?>
                                <div class="modal fade bs-example-modal-sm" id="exampleModal<?=$a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                      <div class="modal-body centre">
                                        <h2><span class="badge badge-warning" style="font-size: ;">PERHATIAN</span></h2>
                                        <h6>Nomor Tidak Bisa Dihapus Sudah Terpakai</h6>
                                      </div>
                                      <div class="modal-footer">
                                        <a type="button" class="btn btn-info btn-sm text-white" data-dismiss="modal">Close</a>

                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal fade bs-example-modal-sm" id="hapus<?=$a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                      <div class="modal-body centre">
                                        <h2><span class="badge badge-warning" style="font-size: ;">Konfirmas</span></h2>
                                        <h6>Anda akan menghapus Nomor</h6><br>
                                        <h6><?=$a->nomor_surat ?></h6>
                                        <form action="<?php echo base_url('AdminNomorSurat/deletedata')?>" method="post">
                                          <input type="hidden" id="fullname" class="form-control" name="id"  value="<?=$a->id_pengajuan ?>" />
                                        </div>
                                        <div class="modal-footer">
                                         <button type="submit" name="submit" id="submit" class="btn btn-danger">Hapus</button>
                                         <a type="button" class="btn btn-info btn-sm text-white" data-dismiss="modal">Close</a>
                                       </form>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                             </td>

                           <?php endif; ?>
                         </tr>
                       <?php } ?>
                     </tbody>
                   </table>
                   <button type="submit" name="submit" id="submit" class="btn btn-info">Simpan</button>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>