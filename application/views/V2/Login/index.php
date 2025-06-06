<?php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SINAR</title>
    <meta name="description" content="Aplikasi Tandatangan elektronik Sinar">
    <meta name="author" content="Wahyudin">
    
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/temp/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
        }

        body {
            background-image: url('<?= base_url("assets/bg.png") ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            margin: 1rem;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .main-logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 1rem;
        }

        .secondary-logos {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .secondary-logos img {
            max-width: 120px;
            height: auto;
        }

        .login-title {
            text-align: center;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
            border-color: var(--primary-color);
        }

        .btn-login {
            width: 100%;
            padding: 0.8rem;
            border-radius: 8px;
            background: var(--primary-color);
            border: none;
            color: white;
            font-weight: 600;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #0056b3;
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .divider {
            border-top: 1px solid #eee;
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="<?= base_url('assets/temp/img/logotte.png') ?>" alt="SINAR Logo" class="main-logo">
            <h3 class="login-title"><strong>Sertifikasi Elektronik</strong></h3>
            <h2 class="login-title"><strong>SINAR</strong></h2>
        </div>

        <?php if($this->session->flashdata('msg')): ?>
            <?= $this->session->flashdata('msg') ?>
        <?php endif; ?>

        <?= form_open('V2/Login/aksi_login', ['class' => 'needs-validation']) ?>
            <div class="form-group">
                <input type="email" 
                       class="form-control" 
                       name="email" 
                       placeholder="Email"
                       required 
                       autocomplete="off">
            </div>

            <div class="form-group">
                <input type="password" 
                       class="form-control" 
                       name="password" 
                       placeholder="Password"
                       required>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        <?= form_close() ?>

        <div class="divider"></div>

        <div class="secondary-logos">
            <img src="<?= base_url('assets/temp/img/loginlg1.png') ?>" alt="Logo 1">
            <img src="<?= base_url('assets/temp/img/logobsre.png') ?>" alt="Logo BSRE">
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('assets/temp/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/temp/js/bootstrap.min.js') ?>"></script>
</body>
</html>