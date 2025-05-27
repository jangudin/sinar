<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <br />
    <br />
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Daftar TPMD Belum Verifikasi</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <?php if (!empty($databelum)): ?>
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Faskes</th>
                            <th>Nama Faskes</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($databelum as $row): 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->kode_faskes ?></td>
                            <td><?= $row->nama_pm ?></td>
                            <td>
                                <span class="badge badge-warning">Belum Verifikasi</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('mutu_fasyankes/tpmd_detail/'.$row->id_pengajuan) ?>" 
                                       class="btn btn-primary btn-sm" title="Lihat Detail">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    Tidak ada data TPMD yang belum diverifikasi.
                </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        "pageLength": 10,
        "responsive": true,
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>