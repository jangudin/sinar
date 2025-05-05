<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <br />
    <br />
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>List Rumah Sakit<small>Rekomendasi</small></h2>
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

          <a href="<?php echo base_url('Lembaga/surat_tugas/' .encrypt_url(0));?>" class="btn btn-success btn-xs" >BELUM TTE</a>
          <a href="<?php echo base_url('Lembaga/surat_tugas/'  .encrypt_url(1));?>" class="btn btn-success btn-xs" >SUDAH TTE</a>
          <br>
          <br>
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>KodeRS</th>
                <th>Nama RS</th>
                <th>Nomor Sertifikat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <?php if (!empty($survei)): ?>
              <?php $no = 1; foreach ($survei as $row): ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->kode_rs; ?></td>
                <td><?php echo $row->RUMAH_SAKIT; ?></td>
                <td><?php echo $row->no_surat_tugas; ?></td>
                <td><a href="<?php echo base_url('Lembaga/surat_tugas_detail/'.encrypt_url($row->id));?>" class="btn btn-success btn-xs" >Print Surat Tugas</a></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8">Data tidak ditemukan</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>