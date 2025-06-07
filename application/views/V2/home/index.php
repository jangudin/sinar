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
            border-radius: 8px;
            padding: 1rem;  /* reduced from 1.5rem */
            margin-bottom: 1rem;
            transition: transform 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 45px;    /* reduced from 60px */
            height: 45px;   /* reduced from 60px */
            line-height: 45px; /* reduced from 60px */
            text-align: center;
            border-radius: 50%;
            font-size: 18px; /* reduced from 24px */
            margin-bottom: 0.75rem; /* reduced from 1rem */
        }

        .stat-number {
            font-size: 1.5rem; /* reduced from 2rem */
            font-weight: 600;
            margin: 0;
            line-height: 1;
        }

        .progress {
            height: 6px;    /* reduced from 8px */
            margin: 0.75rem 0; /* reduced from 1rem */
            border-radius: 3px;
        }

        h3 {
            font-size: 1.2rem; /* reduced heading size */
            margin-bottom: 0.5rem;
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

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.5em;
            vertical-align: 0.2em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }

        .dropdown-menu {
            background: white;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 0.5rem !important;
            animation: fadeIn 0.3s ease;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            color: var(--primary);
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background: rgba(0,0,0,0.05);
            color: var(--secondary);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .navbar-nav .dropdown-toggle::after {
            margin-left: 0.5rem;
        }

        /* Adjust spacing for action buttons */
        .btn {
            padding: 0.4rem 0.8rem; /* reduced padding */
            font-size: 0.9rem;      /* reduced font size */
        }

        .btn:not(:first-child) {
            margin-left: 1rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background: var(--primary);">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
            <img src="<?= base_url('assets/temp/img/logotte.png') ?>" height="40" alt="SINAR">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <!-- Main Navigation (Left Side) -->
            <ul class="navbar-nav">
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
            
            <!-- User Profile Dropdown (Right Side) -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg me-2"></i>
                        <span class="text-white"><?= $this->session->userdata('name') ?? 'User' ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="<?= base_url('V2/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
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
                <img src="<?= base_url('assets/temp/img/loginlg1.png') ?>" height="60" alt="Kemkes">
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="stat-card">
                <h3 class="mb-4">Aksi Cepat</h3>
                <div class="d-flex gap-2">
                    <button class="btn btn-danger">
                        <i class="fas fa-plus-circle"></i> Rumah Sakit
                    </button>
                    <button class="btn btn-primary text-white ms-3">
                        <i class="fas fa-search"></i> Non Rumah Sakit
                    </button>
                    <button class="btn btn-success ms-3">
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
        // Initialize Bootstrap dropdowns
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });

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