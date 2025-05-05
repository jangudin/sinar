<div class="right_col" role="main">
  <div class>
    <div class="row" style="display: inline-block;">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <!-- <h3>Detail</h3> -->
          </div>
          <div class="title_right">
            <div class="col-md-10 col-sm-10">
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12  ">
           <label>Sertifikat <a href="<?= $attachment ?>" target="_blank">(Layar Penuh)</a></label><br/>
           <iframe src="<?= $attachment?>" frameborder="0" width="100%" height="1300px"></iframe>
        </div>
      </div>

    <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-6">
            <div class="x_content">
              <div class="bs-example" data-example-id="simple-jumbotron">
                <div class="jumbotron">
                 <?php 
                 foreach ($data as $p) { ?>
                  <div class="text-center">
                    <h4>SURAT TUGAS</h4>
                    <p>NOMOR : <input type="text" name="no_surat" placeholder="Input no surat">
                    </p>
                  </div>
                  <p>Dengan ini kami selaku Ketua LPA <?=$p->nama_lpa ?>, menugaskan kepada:</p>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <td>NO</td>
                        <td>NAMA</td>
                        <td>NO HP </td>
                        <td>DOMISILI</td>
                        <td>BIDANG</td>
                        <td>JABATAN</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td><?=$p->surveior_satu ?><input type="hidden" name="surveior_satu"></td>
                        <td><?=$p->no_hp_satu ?><input type="hidden" name="no_hp_satu"></td>
                        <td><?=$p->prov ?><input type="hidden" name="prov"></td>
                        <td><?=$p->bidang_surveior_satu ?><input type="hidden" name="bidang_surveior_satu"></td>
                        <td><?php 
                        if($p->jabatan_surveior_id_satu == 1){
                          echo "Ketua";
                        }elseif($p->jabatan_surveior_id_satu == 2){
                          echo "Anggota";
                        }
                      ?><input type="hidden" name="jabatan_surveior_id_satu"></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td><?=$p->surveior_dua ?><input type="hidden" name="surveior_dua"></td>
                      <td><?=$p->no_hp_dua ?><input type="hidden" name="no_hp_dua"></td>
                      <td><?=$p->prov2 ?><input type="hidden" name="prov2"></td>
                      <td><?=$p->bidang_surveior_dua ?><input type="hidden" name="bidang_surveior_dua"></td>
                      <td><?php 
                      if($p->jabatan_surveior_id_dua == 1){
                        echo "Ketua";
                      }elseif($p->jabatan_surveior_id_dua == 2){
                        echo "Anggota";
                      }
                    ?><input type="hidden" name="jabatan_surveior_id_dua"></td>
                  </tr>
                </tbody>
              </table>
              <p>Untuk melaksanakan survei akreditasi, yang akan dilaksanakan pada:</p>
              <table style="margin-left:20px;">
                <tr>
                  <td>Nama Fasyankes</td>
                  <td style="margin-left:10px;">:</td>
                  <td><input type="hidden" name="nama_fasyankes"><?=$p->nama_fasyankes ?></td>
                </tr>
                <tr>
                  <td>Jenis</td>
                  <td style="margin-left:10px;">:</td>
                  <td><?= $jns ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td style="margin-left:10px;">:</td>
                  <td><?=$p->alamat ?></td>
                </tr>
                <tr>
                  <td>Metode survei</td>
                  <td style="margin-left:10px;">:</td>
                  <td><?php 
                  if($p->msi == 2){
                    echo "Luring";
                  }elseif($p->msi == 3){
                    echo "Hybrid";
                  }
                ?></td>
              </tr>
                    <?php } ?>
              <tr>
                <td>Tanggal survei</td>
                <td style="margin-left:10px;">:</td>
                <td><?php 
                 foreach ($survei as $s) { ?>
                  <?=$s->tanggal_survei?> -<?php } ?></td>
              </tr>
              <?php 
                 foreach ($nar as $n) { ?>
              <tr>
                <td>Narahubung</td>
                <td style="margin-left:10px;">:</td>
                <td><?=$n->nama_narahubung?></td>
              </tr>
              <tr>
                <td>No Hp</td>
                <td style="margin-left:5px;">:</td>
                <td><?=$n->no_telepon_narahubung?></td>
              </tr>
              <?php } ?>
            </table>
          </br>
          <p>Dengan ketentuan sebagai berikut :</p>
          <table style="margin-left:20px;">
            <tr>
              <td style="vertical-align: top;">1. </td>
              <td>Melaksanakan survei dengan mengacu pada Standar dan Instrumen Survei Akreditasi masing-masing fasilitas pelayanan kesehatan serta sesuai dengan Petunjuk Teknik Pelaksanaan Survei Akreditasi yang ditetapkan Kementerian Kesehatan.</td>
            </tr>
            <tr>
              <td>2. </td>
              <td>Wajib mematuhi kode etik surveior.</td>
            </tr>
            <tr>
              <td style="vertical-align: top;">3. </td>
              <td>Mengirimkan laporan survei kepada Ketua LPA melalui aplikasi SINAF paling lambat 2 (dua) hari setelah pelaksanaan survei Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.</td>
            </tr>
          </table>
          <br>
          <br>
          <div class="pull-right">
            TTE
          </div>
        </div>


      <form class="form-horizontal form-label-left" action="<?= base_url('Surat_tugas/ttesurtug') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nik <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 ">
            <input type="text" name="nik" value="<?php $this->session->userdata('nik') ?>" required="required" class="form-control">
            <input type="hidden" value="<?=$p->inisial ?>" name="lembaga" required="required" class="form-control">
            <input type="hidden" value="<?=$p->kode_faskes ?>" name="id" required="required" class="form-control  ">
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
    </div>
  </div>
</div>
</div>
</div>
</div>

</div>
</div>
