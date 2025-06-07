<div class="right_col" role="main">
    <!-- Welcome Section -->
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-tachometer-alt"></i> Dashboard</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <!-- Verifikasi -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua">
                            <i class="fa fa-check-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Verifikasi</span>
                            <span class="info-box-number">0</span>
                            <a href="#" class="small-box-footer">More info</a>
                        </div>
                    </div>
                </div>

                <!-- TTE RS -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green">
                            <i class="fa fa-hospital"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">TTE RS</span>
                            <span class="info-box-number">0</span>
                            <a href="#" class="small-box-footer">More info</a>
                        </div>
                    </div>
                </div>

                <!-- TTE Non RS -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow">
                            <i class="fa fa-building"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">TTE Non RS</span>
                            <span class="info-box-number">0</span>
                            <a href="#" class="small-box-footer">More info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-box {
    border-radius: 3px;
    background: #ffffff;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.info-box-icon {
    border-radius: 3px 0 0 3px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    color: #fff;
}

.info-box-content {
    padding: 15px 10px;
    margin-left: 90px;
}

.info-box-text {
    display: block;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-transform: uppercase;
}

.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
}

.bg-aqua { background-color: #00c0ef !important; }
.bg-green { background-color: #00a65a !important; }
.bg-yellow { background-color: #f39c12 !important; }
</style>