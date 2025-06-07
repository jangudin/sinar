<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SINAR - Sistem Informasi Akreditasi' ?></title>
    
    <!-- CSS -->
    <link href="<?= base_url('assets/temp/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
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

        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 2rem;
        }

        .navbar-brand img {
            height: 40px;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255,.8);
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #fff;
        }

        .user-profile {
            display: flex;
            align-items: center;
            color: white;
            gap: 0.5rem;
        }

        .user-profile img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .right_col {
            padding: 2rem;
            margin-top: 60px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 1rem 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('V2/Home') ?>">
            <img src="<?= base_url('assets/temp/img/logotte.png') ?>" alt="SINAR">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('V2/Home') ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('V2/Data') ?>">
                        <i class="fas fa-database"></i> Data
                    </a>
                </li>
            </ul>
            
            <div class="user-profile">
                <img src="<?= base_url('assets/temp/img/user.png') ?>" alt="User">
                <span><?= $this->session->userdata('name') ?? 'User' ?></span>
                <a href="<?= base_url('V2/logout') ?>" class="btn btn-outline-light btn-sm ms-3">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>