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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            position: relative;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('<?= base_url("assets/bg.png") ?>') center/cover no-repeat fixed;
            opacity: 0.1;
            z-index: 0;
        }

        .animated-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, transparent 20%, #1e3c72 80%);
            animation: wave 15s infinite linear;
        }

        @keyframes wave {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .login-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            margin: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Add glass morphism effect to form controls */
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
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
            background: linear-gradient(45deg, var(--primary-color), #0056b3);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
        }

        .btn-login:hover {
            background: linear-gradient(45deg, #0056b3, var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .divider {
            border-top: 1px solid #eee;
            margin: 1.5rem 0;
        }

        /* Add these new styles for floating particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>
    <div class="particles" id="particles"></div>

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
    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const numberOfParticles = 50;

            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size between 2px and 6px
                const size = Math.random() * 4 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Random animation duration between 10s and 20s
                const duration = Math.random() * 10 + 10;
                particle.style.animation = `float ${duration}s infinite linear`;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Add floating animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0% {
                    transform: translateY(0) translateX(0);
                }
                50% {
                    transform: translateY(-100px) translateX(50px);
                }
                100% {
                    transform: translateY(0) translateX(0);
                }
            }
        `;
        document.head.appendChild(style);

        // Initialize particles on load
        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>