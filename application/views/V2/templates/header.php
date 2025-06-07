<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SINAR - Sistem Informasi Akreditasi' ?></title>
    
    <!-- CSS Libraries -->
    <link href="<?= base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/font-awesome/css/all.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand img { height: 40px; }

        .nav-link {
            padding: 0.8rem 1rem !important;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
        }

        /* Content Styles */
        .right_col {
            padding: 2rem;
            margin-top: 60px;
            min-height: calc(100vh - 120px);
        }

        .tile_stats_count {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .tile_stats_count:hover {
            transform: translateY(-5px);
        }

        /* Card Styles */
        .x_panel {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            padding: 15px;
        }

        .x_title {
            border-bottom: 2px solid #E6E9ED;
            padding: 1px 5px 6px;
            margin-bottom: 10px;
        }

        /* Progress Bars */
        .progress {
            height: 20px;
            background: #F5F5F5;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            transition: width 0.3s ease;
        }

        /* Footer Styles */
        .footer {
            background: white;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -1px 4px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        /* Utility Classes */
        .shadow-hover:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .rounded-custom {
            border-radius: 8px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .right_col {
                padding: 1rem;
                margin-top: 56px;
            }

            .tile_stats_count {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- sidebar -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= base_url() ?>" class="site_title">
                            <i class="fa fa-hospital-o"></i> 
                            <span>SINAR</span>
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= base_url('assets/images/user.png') ?>" alt="User" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?= $this->session->userdata('name') ?? 'User' ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li>
                                    <a href="<?= base_url('V2/Home') ?>">
                                        <i class="fa fa-home"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?= base_url('V2/Data/add') ?>">Add New</a></li>
                                        <li><a href="<?= base_url('V2/Data') ?>">List Data</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>
            <!-- /sidebar -->

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class="navbar-right">
                            <li class="nav-item dropdown open">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('assets/images/user.png') ?>" alt="">
                                    <?= $this->session->userdata('name') ?? 'User' ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right">
                                    <a class="dropdown-item" href="<?= base_url('V2/logout') ?>">
                                        <i class="fa fa-sign-out pull-right"></i> Log Out
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->