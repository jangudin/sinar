<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SINAR</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2A3F54;
            --secondary: #172D44;
            --success: #26B99A;
            --info: #3498DB;
            --warning: #F39C12;
            --danger: #E74C3C;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
            background: #F7F7F7;
        }

        .container-fluid {
            padding: 0 15px;
        }

        .right_col {
            padding: 10px 20px;
            margin-left: 230px;
            transition: margin-left 0.3s ease;
        }

        .tile_count {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px 0;
        }

        .tile_stats_count {
            flex: 1;
            min-width: 300px;
            background: white;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            transition: transform 0.2s;
        }

        .tile_stats_count:hover {
            transform: translateY(-5px);
        }

        .count_top {
            font-size: 14px;
            color: #666;
            display: block;
            margin-bottom: 10px;
        }

        .count {
            font-size: 30px;
            font-weight: 600;
            color: var(--primary);
        }

        .count_bottom {
            font-size: 12px;
            color: var(--success);
            display: block;
            margin-top: 5px;
        }

        .x_panel {
            background: white;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }

        .x_title {
            border-bottom: 2px solid #E6E9ED;
            padding: 1px 5px 6px;
            margin-bottom: 15px;
        }

        .x_title h2 {
            font-size: 18px;
            color: #333;
        }

        .progress {
            height: 20px;
            background: #F5F5F5;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress-bar {
            height: 100%;
            transition: width 0.3s ease;
        }

        .bg-success { background: var(--success); }
        .bg-info { background: var(--info); }
        .bg-warning { background: var(--warning); }
        .bg-danger { background: var(--danger); }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            margin: 5px;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-primary { background: var(--primary); }
        .btn-success { background: var(--success); }
        .btn-info { background: var(--info); }
        .btn-warning { background: var(--warning); }

        .widget_summary {
            padding: 10px;
            border-bottom: 1px solid #E6E9ED;
        }

        .w_left { width: 30%; float: left; text-align: left; }
        .w_center { width: 40%; float: left; }
        .w_right { width: 30%; float: left; text-align: right; }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        @media (max-width: 768px) {
            .right_col {
                margin-left: 0;
            }
            .tile_stats_count {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="right_col" role="main">
    <!-- Top Tiles -->
    <div class="tile_count">
        <div class="tile_stats_count">
            <span class="count_top"><i class="fas fa-check-circle"></i> Total Verifikasi</span>
            <div class="count">0</div>
            <span class="count_bottom"><i class="fas fa-arrow-up"></i> Sudah Verifikasi</span>
        </div>
        <div class="tile_stats_count">
            <span class="count_top"><i class="fas fa-hospital"></i> TTE RS</span>
            <div class="count">0</div>
            <span class="count_bottom"><i class="fas fa-arrow-up"></i> Sudah TTE</span>
        </div>
        <div class="tile_stats_count">
            <span class="count_top"><i class="fas fa-building"></i> TTE Non-RS</span>
            <div class="count">0</div>
            <span class="count_bottom"><i class="fas fa-arrow-up"></i> Sudah TTE</span>
        </div>
    </div>

    <!-- Progress Panels -->
    <div class="row">
        <!-- Verifikasi Progress -->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Status Verifikasi</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="widget_summary">
                        <div class="w_left">Belum Verifikasi</div>
                        <div class="w_center">
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 50%"></div>
                            </div>
                        </div>
                        <div class="w_right">0</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                        <div class="w_left">Sudah Verifikasi</div>
                        <div class="w_center">
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: 50%"></div>
                            </div>
                        </div>
                        <div class="w_right">0</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Aksi Cepat</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Pengajuan Baru
                    </button>
                    <button class="btn btn-info">
                        <i class="fas fa-search"></i> Cek Status
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-download"></i> Export Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add any JavaScript functionality here
    });
</script>

</body>
</html>