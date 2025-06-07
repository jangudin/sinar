<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="SINAR" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('V2/Home') ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-tasks"></i> Verifikasi
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Belum Verifikasi</a></li>
                        <li><a class="dropdown-item" href="#">Sudah Verifikasi</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-hospital"></i> TTE RS
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Belum TTE</a></li>
                        <li><a class="dropdown-item" href="#">Sudah TTE</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('assets/images/user.png') ?>" class="rounded-circle me-2" width="32">
                        <?= $user['name'] ?? 'User' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('V2/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>