<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SINAR</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Settings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: #0a0a0a;
            color: #fff;
            display: flex;
            flex-direction: row;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #1e1e1e, #222);
            color: #fff;
            padding-top: 50px;
            width: 260px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 3px 0 12px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transition: 0.4s ease;
        }

        .sidebar:hover {
            width: 300px;
        }

        .sidebar .user-profile {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .sidebar .user-profile img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .sidebar .user-profile img:hover {
            transform: scale(1.1);
        }

        .sidebar .user-profile h5 {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .sidebar .user-profile p {
            color: #bbb;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .sidebar .nav-link {
            color: #ddd;
            font-size: 1.2rem;
            font-weight: 500;
            padding: 15px 25px;
            display: block;
            border-radius: 10px;
            margin: 8px 0;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #343a40;
            transform: scale(1.05);
        }

        .sidebar .nav-item.active .nav-link {
            background-color: #007bff;
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(45deg, #00aaff, #007bff);
            padding: 15px 30px;
            color: white;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-brand {
            font-size: 1.7rem;
            font-weight: bold;
        }

        .navbar .navbar-text {
            font-size: 1.1rem;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
            width: 100%;
            transition: margin-left 0.3s;
        }

        /* Main Dashboard */
        .content .container {
            background-color: #1c1c1c;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            margin-top: 40px;
        }

        .content h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2rem;
        }

        .content .card {
            background: #333;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .content .card:hover {
            transform: translateY(-8px);
        }

        .content .card-body {
            padding: 25px;
        }

        .content .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #00aaff;
            margin-bottom: 15px;
        }

        .content .card-text {
            font-size: 1.2rem;
            color: #bbb;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #006bb3;
        }

        /* Notification icon */
        .notification-icon {
            font-size: 1.6rem;
            position: relative;
        }

        .notification-icon::after {
            content: "3";
            background-color: #ff0000;
            color: white;
            font-size: 0.85rem;
            padding: 4px 7px;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -5px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 240px;
            }

            .content {
                margin-left: 240px;
            }
        }

        /* Custom scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #555;
            border-radius: 8px;
        }

        .sidebar::-webkit-scrollbar-track {
            background-color: #333;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-profile">
            <img src="https://via.placeholder.com/120" alt="User Profile">
            <h5><?php echo $this->session->userdata('name'); ?></h5>
            <p>Admin</p>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-cogs"></i> Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-chart-line"></i> Reports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-bell notification-icon"></i> Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('Auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SINAR Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <span class="navbar-text">Welcome, <?php echo $this->session->userdata('name'); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2>Dashboard</h2>
            <p>Welcome to the SINAR Admin Dashboard. You are logged in as <?php echo $this->session->userdata('name'); ?>.</p>

            <!-- Dashboard Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Statistics</h5>
                            <p class="card-text">Manage active users, view statistics, and handle user registration.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reports</h5>
                            <p class="card-text">Generate and download detailed reports for system usage and performance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">System Settings</h5>
                            <p class="card-text">Configure system-wide settings including user permissions and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>

</body>

</html>
