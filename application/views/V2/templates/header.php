<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'SINAR' ?></title>
    <!-- Ensure no whitespace or output before DOCTYPE -->
</head>
<body>
    <!-- Navbar start -->
    <nav class="navbar">
        <div class="navbar-brand">
            <span>SINAR</span>
        </div>
        <div class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="<?= base_url('V2/Home') ?>">Dashboard</a>
                <!-- Other menu items -->
            </div>
            <div class="navbar-end">
                <span class="navbar-item">
                    <?= $user['name'] ?? '' ?> - <?= $user['apps'] ?? 'Pimpinan Lembaga Akreditasi' ?>
                </span>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->

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

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $title ?? 'Dashboard' ?></h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- Add your page content here -->
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    SINAR - Sistem Informasi Akreditasi
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/font-awesome/js/all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>