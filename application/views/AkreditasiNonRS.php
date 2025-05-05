<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Daftar Faskes</h3>
      </div>
    </div>
  </div>
  <br>
  <div class="col-md-12 col-sm-12 ">
    <div class="alert alert-warning alert-dismissible " role="alert">
      </button>
      <strong>Perhatian !!<br>1. Sebelum melakukan proses TTE dipastikan koneksi internet Stabil diatas 10 MBPS<br>2. Tunggu proses tte selesai tidak boleh menutup halaman atau refresh halaman<br>3. Apabila faskes telah proses TTE muncul kembali Silahkan TTE ulang</strong>
    </div>
    <?php echo $this->session->flashdata('msg');?>
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Faskes</h2>
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
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                Data dibawah ini merupakan data faskes yang sudah bisa dilakukan Tanda Tangan Elektronik, Sebelum Melakukan TTE dicek terlebih dahulu datanya karna data yang sudah di TTE tidak bisa di revisi
              </p>
              <table id="datatable-keytable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Faskes</th>
                    <th>Alamat</th>
                    <th>Jenis</th>
                    <th>Capaian</th>
                    <th>TGL Nomor</th>
                    <th>Nomor Sertifikat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                 <?php $i = 1; foreach ($data as $a) { ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?=$a->nama_faskes ?></td>
                    <td><?=$a->alamat ?></td>
                    <td><?=$a->jenis_faskes ?></td>
                    <td><?=$a->status_akreditasi ?></td>
                    <td><?= $a->tgl_nomor_surat ?></td>
                    <td><?=$a->nomor_surat ?></td>
                    <td>
                      <?php if ($a->status_tte == null): ?>
                        <?php if ($a->lpa_id == "KEMENKES"): ?>
                        <a class="btn btn-sm btn-success" href="<?php echo base_url('AkreditasiNonRS/ttesertifikatkemkes/'.$a->kode_faskes.'/'.$a->jenis_faskes.'/'.$a->id_pengajuan);?>"><span data-feather="edit"></span> Generate File Sertifikat</a>
                        <?php else: ?> 
                        <a class="btn btn-sm btn-success" href="<?php echo base_url('AkreditasiNonRS/ttesertifikat/'.$a->kode_faskes.'/'.$a->jenis_faskes.'/'.$a->id_pengajuan);?>"><span data-feather="edit"></span> TTE Sertifikat</a>
                        <?php endif ; ?>
                      <?php else: ?> 
                        <a class="btn btn-sm btn-warning" href="<?php echo base_url('AkreditasiNonRS/review/'.$a->kode_faskes);?>"><span data-feather="edit"></span> Tinjau Hasil TTE Sertifikat</a>
                      <?php endif ; ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>