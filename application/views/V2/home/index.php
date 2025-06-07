<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SINAR</title>
    
    <!-- CSS -->
    <link href="<?= base_url('assets/temp/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e3c72;
            --secondary-color: #2a5298;
            --accent-color: #4CAF50;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .dashboard-container {
            padding: 2rem;
        }

        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .recent-activity {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .activity-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .quick-actions {
            margin-top: 2rem;
        }

        .action-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="row">
            <div class="col-md-8">
                <h2>Selamat Datang, <?= $this->session->userdata('name') ?></h2>
                <p>Sistem Informasi Akreditasi - SINAR</p>
            </div>
            <div class="col-md-4 text-end">
                <img src="<?= base_url('assets/temp/img/logotte.png') ?>" alt="SINAR Logo" height="60">
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-hospital stat-icon"></i>
                <div class="stat-number">245</div>
                <div class="stat-label">Total Rumah Sakit</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-certificate stat-icon"></i>
                <div class="stat-number">180</div>
                <div class="stat-label">Tersertifikasi</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-clock stat-icon"></i>
                <div class="stat-number">65</div>
                <div class="stat-label">Dalam Proses</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-check-circle stat-icon"></i>
                <div class="stat-number">95%</div>
                <div class="stat-label">Tingkat Keberhasilan</div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h4 class="mb-4">Aktivitas Terbaru</h4>
        <div class="activity-item">
            <div class="row">
                <div class="col-md-8">
                    <strong>RS Umum Daerah</strong> - Pengajuan Sertifikasi Baru
                </div>
                <div class="col-md-4 text-end">
                    2 jam yang lalu
                </div>
            </div>
        </div>
        <!-- Add more activity items as needed -->
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="row">
            <div class="col-md-3">
                <button class="action-button w-100">
                    <i class="fas fa-plus-circle me-2"></i> Pengajuan Baru
                </button>
            </div>
            <div class="col-md-3">
                <button class="action-button w-100">
                    <i class="fas fa-search me-2"></i> Cek Status
                </button>
            </div>
            <!-- Add more quick actions as needed -->
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/temp/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/temp/js/bootstrap.bundle.min.js') ?>"></script>
<script>
    // Add any custom JavaScript here
</script>

</body>
</html>