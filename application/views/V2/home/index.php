<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SINAR</title>
    
    <!-- CSS -->
    <link href="<?= base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/font-awesome/css/all.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1e3c72;
            --secondary: #2a5298;
            --success: #26B99A;
            --info: #3498DB;
            --warning: #F39C12;
            --danger: #E74C3C;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F7F7F7;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: transform 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            border-radius: 50%;
            font-size: 24px;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            line-height: 1;
        }

        .progress {
            height: 8px;
            margin: 1rem 0;
            border-radius: 4px;
        }

        .footer {
            background: white;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -1px 4px rgba(0,0,0,0.1);
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
        }

        .nav-link:hover {
            color: white !important;
        }

        .user-profile img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background: var(--primary);">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
            <img src="<?= base_url('assets/img/logo.png') ?>" height="40" alt="SINAR">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-tasks"></i> Verifikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-file-signature"></i> TTE</a>
                </li>
            </ul>
            <div class="user-profile d-flex align-items-center">
                <img src="<?= base_url('assets/img/user.png') ?>" alt="User" class="me-2">
                <span class="text-white"><?= $this->session->userdata('name') ?? 'User' ?></span>
                <a href="<?= base_url('V2/logout') ?>" class="btn btn-outline-light btn-sm ms-3">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-0">Selamat Datang di SINAR</h2>
                <p class="mb-0">Sistem Informasi Akreditasi Rumah Sakit</p>
            </div>
            <div class="col-md-6 text-end">
                <img src="<?= base_url('assets/img/kemkes.png') ?>" height="60" alt="Kemkes">
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-success text-white">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Verifikasi</h3>
                <p class="stat-number">0</p>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%"></div>
                </div>
                <div class="d-flex justify-content-between text-muted">
                    <span>Total</span>
                    <span>60%</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-primary text-white">
                    <i class="fas fa-hospital"></i>
                </div>
                <h3>TTE RS</h3>
                <p class="stat-number">0</p>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 45%"></div>
                </div>
                <div class="d-flex justify-content-between text-muted">
                    <span>Total</span>
                    <span>45%</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon bg-warning text-white">
                    <i class="fas fa-building"></i>
                </div>
                <h3>TTE Non-RS</h3>
                <p class="stat-number">0</p>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"></div>
                </div>
                <div class="d-flex justify-content-between text-muted">
                    <span>Total</span>
                    <span>30%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="stat-card">
                <h3 class="mb-4">Aksi Cepat</h3>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Pengajuan Baru
                    </button>
                    <button class="btn btn-info text-white">
                        <i class="fas fa-search"></i> Cek Status
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-download"></i> Unduh Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0 text-muted">&copy; <?= date('Y') ?> SINAR - Sistem Informasi Akreditasi</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="mb-0 text-muted">Version 2.0 | Kementerian Kesehatan RI</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        // Enable tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Animate numbers
        $('.stat-number').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 1000,
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    });
</script>

</body>
</html>