<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SINAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #4e73df, #1f2d3d);
            padding: 0 15px;
            overflow: hidden;
        }

        .login-container {
            background: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            padding: 3rem 2rem;
            text-align: center;
            z-index: 10;
        }

        .login-container img {
            width: 200px;
            margin-bottom: 1.5rem;
        }

        .login-container h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            font-size: 0.9rem;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 0.9rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 0.9rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .footer-logos {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .footer-logos img {
            width: 80px;
            transition: transform 0.3s;
        }

        .footer-logos img:hover {
            transform: scale(1.1);
        }

        /* Custom alert styles */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            display: none; /* Hidden by default */
            text-align: center;
        }

        .alert.success {
            background-color: #28a745;
            color: white;
        }

        .alert.error {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://sinar.kemkes.go.id/assets/temp/img/logotte.png" alt="Logo">
        <h1>Sertifikasi Elektronik</h1>
        <p>Login ke sistem SINAR untuk melanjutkan</p>

        <!-- PHP Alert Message -->
        <div id="alertMessage" class="alert">
            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert <?php echo $this->session->flashdata('message_type'); ?>">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>
        </div>

        <form id="loginForm" action="<?php echo base_url('Akreditasi/Auth/login'); ?>" method="post">
            <div class="form-group">
                <label for="email">Username</label>
                <input type="text" id="email" name="email" placeholder="Masukkan Email Terdaftar" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="footer-logos">
            <img src="https://sinar.kemkes.go.id/assets/temp/img/loginlg1.png" alt="Logo 1">
            <img src="https://sinar.kemkes.go.id/assets/temp/img/logobsre.png" alt="Logo 2">
        </div>
    </div>
</body>
</html>
