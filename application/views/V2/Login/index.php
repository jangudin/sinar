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
    
    <!-- ...existing styles... -->
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