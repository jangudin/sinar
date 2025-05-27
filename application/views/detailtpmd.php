<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <?php if($this->session->flashdata('msg')): ?>
                <div class="alert alert-info alert-dismissible fade show">
                    <?= $this->session->flashdata('msg') ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Detail TPMD</h2>
                    <div class="clearfix"></div>
                </div>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <div class="x_content">
                    <!-- Facility Details -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Informasi Fasilitas Kesehatan</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Kode Faskes</th>
                                            <td><?= $detail->kode_faskes ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Faskes</th>
                                            <td><?= $detail->nama_pm ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td><?= $detail->alamat_faskes ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <td><?= $detail->nama_camat ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kab/Kota</th>
                                            <td><?= $detail->nama_kota ?></td>
                                        </tr>
                                        <tr>
                                            <th>Provinsi</th>
                                            <td><?= $detail->nama_prop ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Status Verifikasi</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Status</th>
                                            <td>
                                                <?php if($detail->status_verifikasi == 1): ?>
                                                    <span class="badge badge-success">Terverifikasi</span>
                                                <?php else: ?>
                                                    <span class="badge badge-warning">Belum Verifikasi</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Usulan</th>
                                            <td><?= format_indo($detail->tanggal_usulan) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status Katim</th>
                                            <td><?= $detail->status_setuju_katim ?></td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td><?= $detail->keterangan_katim ?: '-' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Section -->
                    <?php if($attachment): ?>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Dokumen Sertifikat</h4>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group">
                                        <a href="<?= $attachment ?>" class="btn btn-primary" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i> Sertifikat
                                        </a>
                                        <?php if($valid): ?>
                                        <a href="<?= $valid ?>" class="btn btn-success" target="_blank">
                                            <i class="fa fa-check-circle"></i> Sertifikat Valid
                                        </a>
                                        <?php endif; ?>
                                        <?php if($hasiltte): ?>
                                        <a href="<?= $hasiltte ?>" class="btn btn-info" target="_blank">
                                            <i class="fa fa-file-text"></i> Hasil TTE
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
