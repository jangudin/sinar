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
      <a type="button" class="btn btn-success" href="<?php echo base_url('AdminNomorSurat/nomor/' . urlencode('Klinik') . '/' . urlencode('Pratama')) ?>
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
                <form action="<?= base_url('AdminNomorSurat/input_nomor') ?>" method="post">
                <table class="table table-striped jambo_table bulk_action" style="width:100%">
                  <thead>
                    <tr class="headings">
                      <th class="column-title" style="width: 5%;">
                        <input type="checkbox" id="checkAll"> Pilih
                      </th>
                      <th class="column-title">Kode Faskes</th>
                      <th class="column-title">Nama Faskes</th>
                      <th class="column-title">Jenis Faskes</th>
                      <th class="column-title">Nomor Surat</th>
                      <th class="column-title">Tanggal Surat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $a): ?>
                      <?php $key = $a->kode_faskes; ?>
                      <tr class="even pointer">
                        <td style="text-align: center;">
                          <?php if ($a->nomor_surat == null): ?>
                            <input type="checkbox" class="toggleInput" data-key="<?= $key ?>" name="id[]" value="<?= $key ?>">
                            <input type="hidden" name="jenisfaskes" value="<?= $a->jenis_faskes ?>">
                          <?php else: ?>
                            <input type="checkbox" disabled checked>
                          <?php endif; ?>
                        </td>

                        <td><?= $a->kode_faskes ?></td>
                        <td><?= $a->nama_faskes ?></td>
                        <td><?= $a->jenis_faskes ?></td>

                        <td>
                          <?php if ($a->nomor_surat == null): ?>
                            <div id="input_nomor_<?= $key ?>" style="display: none;">
                              <input type="number" name="nomor_surat[<?= $key ?>]" class="form-control" placeholder="Nomor Surat">
                            </div>
                          <?php else: ?>
                            <?= $a->nomor_surat ?>
                          <?php endif; ?>
                        </td>

                        <td>
                          <?php if ($a->nomor_surat == null): ?>
                            <div id="input_tgl_<?= $key ?>" style="display: none;">
                              <input type="date" name="tgl_nomor_surat[<?= $key ?>]" class="form-control">
                            </div>
                          <?php else: ?>
                            <?= $a->tgl_nomor_surat ?>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

                <div style="margin-top: 15px;">
                  <button type="submit" class="btn btn-primary">Simpan Semua</button>
                </div>
              </form>

              <script>
                // Per checkbox: toggle input nomor & tanggal
                document.querySelectorAll('.toggleInput').forEach(function(checkbox) {
                  checkbox.addEventListener('change', function() {
                    const key = this.dataset.key;
                    const display = this.checked ? 'block' : 'none';
                    document.getElementById('input_nomor_' + key).style.display = display;
                    document.getElementById('input_tgl_' + key).style.display = display;
                  });
                });

                // Checkbox master (Check All)
                document.getElementById('checkAll').addEventListener('change', function() {
                  const checked = this.checked;
                  document.querySelectorAll('.toggleInput').forEach(function(cb) {
                    cb.checked = checked;
                    const key = cb.dataset.key;
                    const display = checked ? 'block' : 'none';
                    document.getElementById('input_nomor_' + key).style.display = display;
                    document.getElementById('input_tgl_' + key).style.display = display;
                  });
                });
              </script>

        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>