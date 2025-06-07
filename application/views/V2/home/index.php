<?php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    
    <!-- CSS -->
    <link href="<?= base_url('assets/temp/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e3c72;
            --secondary-color: #2a5298;
            --accent-color: #4CAF50;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
        }

        .right_col {
            padding: 2rem;
        }

        .page-title {
            margin-bottom: 2rem;
        }

        .breadcrumbs {
            padding: 0.5rem 0;
            color: #6c757d;
        }

        .breadcrumbs a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumbs a:hover {
            color: var(--secondary-color);
        }

        .x_panel {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .x_title {
            padding: 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .x_content {
            padding: 1.5rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $title ?></h3>
        </div>
        
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <?php foreach($breadcrumbs as $crumb): ?>
                <?php if($crumb['url'] != '#'): ?>
                    <a href="<?= base_url($crumb['url']) ?>"><?= $crumb['label'] ?></a> /
                <?php else: ?>
                    <?= $crumb['label'] ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fas fa-info-circle"></i> Detail Informasi</h2>
                    <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Data Details -->
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <tr>
                                    <th width="200">Kode RS</th>
                                    <td><?= $item->kode_rs ?? 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <th>Nama RS</th>
                                    <td><?= $item->nama_rs ?? 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <th>Status Verifikasi</th>
                                    <td>
                                        <?php if($item->status_verifikasi ?? false): ?>
                                            <span class="badge bg-success">Sudah Verifikasi</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Belum Verifikasi</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status TTE</th>
                                    <td>
                                        <?php if($item->status_tte ?? false): ?>
                                            <span class="badge bg-success">Sudah TTE</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Belum TTE</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <td><?= $item->tanggal_pengajuan ?? 'N/A' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a href="<?= base_url('V2/Data') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                            <a href="<?= base_url('V2/Data/edit/' . ($item->id ?? '')) ?>" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a>
                            <a href="<?= base_url('V2/Data/print/' . ($item->id ?? '')) ?>" class="btn btn-info" target="_blank">
                                <i class="fas fa-print me-2"></i> Cetak
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/temp/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/temp/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>