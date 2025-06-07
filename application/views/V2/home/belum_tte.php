<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3><i class="fas fa-file-signature"></i> Data Belum TTE</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table table-striped table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode RS</th>
                                <th>Nama RS</th>
                                <th>Tgl Pengajuan</th>
                                <th>Status Verifikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($items as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item->kode_rs ?></td>
                                <td><?= $item->nama_rs ?></td>
                                <td><?= date('d/m/Y', strtotime($item->created_at)) ?></td>
                                <td>
                                    <?php if($item->status_verifikasi): ?>
                                        <span class="badge bg-success">Sudah Verifikasi</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Belum Verifikasi</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('V2/Data/view/'.$item->id) ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>