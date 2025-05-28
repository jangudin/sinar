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
                                    <!-- Secure PDF Preview using iframe -->
                                    <div class="mb-3">
                                        <iframe 
                                            src="<?= base_url('mutu_fasyankes/view_pdf/' . encrypt_url($detail->id_pengajuan)) ?>"
                                            width="100%" 
                                            height="600px"
                                            style="border: 1px solid #ccc;"
                                            sandbox="allow-scripts allow-same-origin"
                                            security="restricted"
                                            referrerpolicy="no-referrer"
                                            loading="lazy"
                                            importance="high"
                                            oncontextmenu="return false;">
                                            <p>Your browser does not support iframes.</p>
                                        </iframe>
                                    </div>

                                    <!-- View Only Buttons -->
                                    <div class="btn-group">
                                        <button class="btn btn-primary" disabled>
                                            <i class="fa fa-file-pdf-o"></i> Lihat Sertifikat
                                        </button>
                                        <?php if($valid): ?>
                                        <button class="btn btn-info" disabled>
                                            <i class="fa fa-check-circle"></i> Sertifikat Valid
                                        </button>
                                        <?php endif; ?>
                                        <?php if($hasiltte): ?>
                                        <button class="btn btn-warning" disabled>
                                            <i class="fa fa-file-text"></i> Hasil TTE
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Verifikasi Form -->
                    <?php if($detail->status_verifikasi != 1): ?>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Form Verifikasi TPMD</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('mutu_fasyankes/verify_tpmd/' . encrypt_url($detail->id_pengajuan)) ?>" method="POST">
                                        <div class="form-group">
                                            <label>Status Verifikasi</label>
                                            <select name="status_verifikasi" class="form-control" required>
                                                <option value="">Pilih Status</option>
                                                <option value="1">Setuju</option>
                                                <option value="2">Tolak</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" rows="3" required 
                                                    placeholder="Masukkan keterangan verifikasi"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check"></i> Submit Verifikasi
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                <i class="fa fa-refresh"></i> Reset
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Generate Certificate Button -->
                    <?php if(!$attachment && $detail->status_verifikasi == 1): ?>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="btn-group">
                                    <a href="<?= base_url('tpmd/generate_certificate/' . encrypt_url($detail->id)) ?>" 
                                       class="btn btn-primary">
                                        <i class="fa fa-file-pdf-o"></i> Generate Sertifikat
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prevent keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'p' || e.key === 'c')) {
            e.preventDefault();
        }
    });

    // Prevent right click
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
});
</script>
