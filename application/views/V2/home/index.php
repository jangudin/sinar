<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SINAR</title>
    
    <!-- CSS -->
    <link href="<?= base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/font-awesome/css/all.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

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

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 1rem;  /* reduced from 1.5rem */
            margin-bottom: 1rem;
            transition: transform 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 45px;    /* reduced from 60px */
            height: 45px;   /* reduced from 60px */
            line-height: 45px; /* reduced from 60px */
            text-align: center;
            border-radius: 50%;
            font-size: 18px; /* reduced from 24px */
            margin-bottom: 0.75rem; /* reduced from 1rem */
        }

        .stat-number {
            font-size: 1.5rem; /* reduced from 2rem */
            font-weight: 600;
            margin: 0;
            line-height: 1;
        }

        .progress {
            height: 6px;    /* reduced from 8px */
            margin: 0.75rem 0; /* reduced from 1rem */
            border-radius: 3px;
        }

        h3 {
            font-size: 1.2rem; /* reduced heading size */
            margin-bottom: 0.5rem;
        }

        .footer {
            background: white;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -1px 4px rgba(0,0,0,0.1);
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
        }

        .nav-link:hover {
            color: white !important;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.5em;
            vertical-align: 0.2em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }

        .dropdown-menu {
            background: white;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 0.5rem !important;
            animation: fadeIn 0.3s ease;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            color: var(--primary);
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background: rgba(0,0,0,0.05);
            color: var(--secondary);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .navbar-nav .dropdown-toggle::after {
            margin-left: 0.5rem;
        }

        /* Adjust spacing for action buttons */
        .btn {
            padding: 0.4rem 0.8rem; /* reduced padding */
            font-size: 0.9rem;      /* reduced font size */
        }

        .btn:not(:first-child) {
            margin-left: 1rem;
        }

        #tteSectionContainer {
            transition: opacity 0.3s ease;
        }

        .stat-card {
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .table td, .table th {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background: var(--primary);">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
            <img src="<?= base_url('assets/temp/img/logotte.png') ?>" height="40" alt="SINAR">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <!-- Main Navigation (Left Side) -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-tasks"></i> Verifikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-file-signature"></i> TTE</a>
                </li>
            </ul>
            
            <!-- User Profile Dropdown (Right Side) -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg me-2"></i>
                        <span class="text-white"><?= $this->session->userdata('name') ?? 'User' ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="<?= base_url('V2/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-0">Selamat Datang di SINAR</h2>
                <p class="mb-0">Sistem Informasi Akreditasi Rumah Sakit</p>
            </div>
            <div class="col-md-6 text-end">
                <img src="<?= base_url('assets/temp/img/loginlg1.png') ?>" height="60" alt="Kemkes">
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="stat-card">
                <h3 class="mb-4">Aksi Cepat</h3>
                <div class="d-flex gap-2">
                    <button class="btn btn-info" onclick="toggleTTESection()">
                        <i class="fas fa-hospital"></i> Rumah Sakit
                    </button>
                    <button class="btn btn-primary text-white ms-3">
                        <i class="fas fa-building"></i> Non Rumah Sakit
                    </button>
                    <button class="btn btn-success ms-3">
                        <i class="fas fa-download"></i> Unduh Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TTE Actions (Initially Hidden) -->
    <div class="row mt-4" id="tteSectionContainer" style="display: none;">
        <div class="col-12">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-4">Status TTE Rumah Sakit</h3>
                    <button class="btn btn-sm btn-outline-secondary" onclick="toggleTTESection()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-success" onclick="showTTEData('sudah')">
                        <i class="fas fa-check-circle"></i> Sudah TTE
                    </button>
                    <button class="btn btn-warning text-white ms-3" onclick="showTTEData('belum')">
                        <i class="fas fa-clock"></i> Belum TTE
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Section (Initially Hidden) -->
    <div class="row mt-4" id="tteDataSection" style="display: none;">
        <div class="col-12">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0" id="tteTableTitle">Data TTE</h3>
                    <button class="btn btn-sm btn-outline-secondary" onclick="hideTTEData()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tteTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode RS</th>
                                <th>Nama RS</th>
                                <th>No Sertifikat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tteTableBody">
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="dataTables_info" id="paginationInfo"></div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination" id="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0 text-muted">&copy; <?= date('Y') ?> SINAR - Sistem Informasi Akreditasi</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="mb-0 text-muted">Version 2.0 | Kementerian Kesehatan RI</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        // Initialize Bootstrap dropdowns
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });

        // Enable tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Animate numbers
        $('.stat-number').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 1000,
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    });

    let currentPage = 1;
    const perPage = 10;
    let currentStatus = '';  // Add this global variable

    function toggleTTESection() {
        $('#tteSectionContainer').toggle();
        $('#tteDataSection').hide();
    }

    function showTTEData(status, page = 1) {
        currentStatus = status;  // Store the status globally
        currentPage = page;
        $('#tteTableTitle').text('Data TTE - ' + (status === 'sudah' ? 'Sudah TTE' : 'Belum TTE'));
        $('#tteDataSection').show();
        $('#tteSectionContainer').hide();
        
        // Show loading indicator
        $('#tteTableBody').html('<tr><td colspan="6" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');

        // AJAX call to fetch data
        $.ajax({
            url: '<?= base_url('V2/Home/get_tte_data') ?>',
            type: 'POST',
            data: { 
                status: status,
                page: page,
                limit: perPage
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    renderTable(response.data, status);  // Pass status to renderTable
                    renderPagination(response.pagination, status);  // Pass status to renderPagination
                } else {
                    $('#tteTableBody').html(`
                        <tr>
                            <td colspan="6" class="text-center text-danger">
                                <i class="fas fa-exclamation-circle"></i> ${response.message || 'Terjadi kesalahan'}
                            </td>
                        </tr>
                    `);
                }
            },
            error: function(xhr, status, error) {
                $('#tteTableBody').html(`
                    <tr>
                        <td colspan="6" class="text-center text-danger">
                            <i class="fas fa-exclamation-circle"></i> ${error || 'Terjadi kesalahan sistem'}
                        </tr>
                    `);
            }
        });
    }

    function renderTable(data, status) {
        let html = '';
        if (data && data.length > 0) {
            data.forEach((item, index) => {
                let progressStatus = '';
                if (status === 'sudah') {
                    progressStatus = `<span class="badge bg-success">Sudah TTE</span>`;
                } else {
                    progressStatus = `
                        <div class="d-flex flex-column">
                            <span class="badge bg-${item.lembaga === '1' ? 'success' : 'warning'} mb-1">Lembaga: ${item.lembaga === '1' ? 'Selesai' : 'Pending'}</span>
                            <span class="badge bg-${item.mutu === '1' ? 'success' : 'warning'} mb-1">Mutu: ${item.mutu === '1' ? 'Selesai' : 'Pending'}</span>
                            <span class="badge bg-${item.dirjen === '1' ? 'success' : 'warning'}">Dirjen: ${item.dirjen === '1' ? 'Selesai' : 'Pending'}</span>
                        </div>
                    `;
                }

                html += `
                    <tr>
                        <td>${((currentPage - 1) * perPage) + index + 1}</td>
                        <td>${item.kodeRS || '-'}</td>
                        <td>${item.namaRS || '-'}</td>
                        <td>${item.no_sertifikat || '-'}</td>
                        <td>${progressStatus}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewDetail('${item.id}')">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                `;
            });
        } else {
            html = `
                <tr>
                    <td colspan="6" class="text-center">
                        <i class="fas fa-info-circle"></i> Tidak ada data ${status === 'sudah' ? 'sudah' : 'belum'} TTE
                    </td>
                </tr>
            `;
        }
        $('#tteTableBody').html(html);
    }

    function renderPagination(pagination, status) {
        const {current_page, total_pages, total_records, per_page} = pagination;
        let paginationHtml = '';
        
        // Previous button
        paginationHtml += `
            <li class="page-item ${current_page === 1 ? 'disabled' : ''}">
                <a class="page-link" href="javascript:void(0)" onclick="${current_page > 1 ? `showTTEData('${status}', ${current_page - 1})` : ''}">&laquo;</a>
            </li>
        `;
        
        // Page numbers
        for(let i = 1; i <= total_pages; i++) {
            paginationHtml += `
                <li class="page-item ${i === current_page ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="showTTEData('${status}', ${i})">${i}</a>
                </li>
            `;
        }
        
        // Next button
        paginationHtml += `
            <li class="page-item ${current_page === total_pages ? 'disabled' : ''}">
                <a class="page-link" href="javascript:void(0)" onclick="${current_page < total_pages ? `showTTEData('${status}', ${current_page + 1})` : ''}">&raquo;</a>
            </li>
        `;
        
        $('#pagination').html(paginationHtml);
        $('#paginationInfo').text(`Menampilkan ${((current_page - 1) * per_page) + 1} sampai ${Math.min(current_page * per_page, total_records)} dari ${total_records} data`);
    }

    function hideTTEData() {
        $('#tteDataSection').hide();
    }
</script>

</body>
</html>