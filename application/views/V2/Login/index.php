<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    
    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
        }
        .login-container {
            max-width: 400px;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-container img {
            max-width: 150px;
            height: auto;
        }
        .login-title {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .form-control {
            border-radius: 5px;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
        }
        .input-group-text {
            background: transparent;
            border-right: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #80bdff;
        }
        .btn-login {
            padding: 0.75rem;
            font-weight: 600;
            background: #007bff;
            border: none;
            border-radius: 5px;
        }
        .btn-login:hover {
            background: #0069d9;
        }
        .alert {
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center h-100">
        <div class="login-container">
            <div class="logo-container">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo SINAR">
            </div>
            
            <h4 class="login-title">Login SINAR</h4>

            <?php if(isset($error)) echo $error; ?>
            
            <?= form_open('V2/Login/aksi_login', ['class' => 'needs-validation']) ?>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" 
                               class="form-control" 
                               name="email" 
                               placeholder="Email"
                               required 
                               autofocus>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                               class="form-control" 
                               name="password" 
                               placeholder="Password"
                               required>
                        <span class="input-group-text password-toggle" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </div>
            <?= form_close() ?>
            
            <div class="text-center mt-4">
                <small class="text-muted">
                    &copy; <?= date('Y') ?> SINAR - Sistem Informasi Akreditasi
                </small>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            // Password visibility toggle
            $('.password-toggle').click(function() {
                const input = $(this).siblings('input');
                const icon = $(this).find('i');
                
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Disable form resubmission
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        });
    </script>
</body>
</html>