<!-- sidebar.php -->
<div class="col-md-3 col-lg-2 d-none d-md-block bg-dark sidebar shadow-lg">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white" href="<?php echo site_url('Admin/Dashboard'); ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('Admin/Settings'); ?>">
                    <i class="fas fa-cogs"></i>
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo site_url('Auth/logout'); ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>
