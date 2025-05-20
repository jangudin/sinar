<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="">
    <div class="clearfix"></div>
    <br />
   <?php if ($this->uri->segment(2) == 'nomor'):?>
     <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/'. urlencode('Pusat Kesehatan Masyarakat')) ?>">
        Puskesmas
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/' . urlencode('Klinik') . '/' . urlencode('Utama')) ?>
">
        Klinik Utama
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/' . urlencode('Pratama') . '/' . urlencode('Utama')) ?>
">
        Klinik Pratama
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Laboratorium Kesehatan/Laboratorium Medis') ?>">
        Lab Medis
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Laboratorium Kesehatan/Laboratorium Kesehatan') ?>">
        Lab Kesmas
      </a>
    </div>

    <div class="btn-group">
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/Unit Transfusi Darah') ?>">
        UTD
      </a>
    </div>
    <br>
    <br>
  <?php else: ?>
   <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Pusat Kesehatan Masyarakat') ?>">
      Puskesmas
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Klinik/Utama') ?>">
      Klinik Utama
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Klinik/Pratama') ?>">
      Klinik Pratama
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Laboratorium Kesehatan/Laboratorium Medis') ?>">
      Lab Medis
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Laboratorium Kesehatan/Laboratorium Kesehatan') ?>">
      Lab Kesmas
    </a>
  </div>

  <div class="btn-group">
    <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/SudahInput/Unit Transfusi Darah') ?>">
      UTD
    </a>
  </div>
  <br>
  <br>
<?php endif; ?>
<?php echo $this->session->flashdata('msg'); ?>
<div class="row">
  <div class="col-md-12 ">
    <div class="x_panel">
      <div class="x_title">
        <!-- <h2>Jumlah belum input nomor : <?php echo $belum->belum; ?> </h2> -->
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
                <?php $i = 1; foreach ($data as $a): ?>
                <?php $key = $a->kode_faskes; ?>
                <tr class="even pointer">
                  <td style="text-align: center;"><?= $i++ ?></td>
                  <td><?= $a->kode_faskes ?></td>
                  <td><?= $a->nama_faskes ?></td>
                  <td><?= $a->jenis_faskes ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>