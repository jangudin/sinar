<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>e-saf</title>

  <!-- Bootstrap -->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="<?php echo base_url('assets');?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url('assets');?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url('assets');?>/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo base_url('assets');?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->

  <link href="<?php echo base_url('assets');?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets');?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets');?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets');?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets');?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


  <link href="<?php echo base_url('assets');?>/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
  <link href="<?php echo base_url('assets');?>/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
  <link href="<?php echo base_url('assets');?>/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">


  <!-- Custom Theme Style -->
  <link href="<?php echo base_url('assets');?>/build/css/custom.min.css" rel="stylesheet">
  <style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
    .myDiv{
      display:none;
    }
  </style>

</head>

<body class="nav-md">
    <!-- <div class="preloader">
      <div class="loading">
        <img src="<?php echo base_url('assets/loadinglogo.gif')?>" height="200">
      </div>
    </div> -->
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <br />
            <br />
            <br />


            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix" style="padding-left: 25px;">
              <div class="profile_pic" style="padding-left: 40px;">
                <img src="<?php echo base_url('assets/temp/img/sidelg.png')?>" alt="..." height="80" >
              </div>
              <a href="index.html" class="site_title"><span>E-SERTIFIKAT</span></a>
              <p style="padding-left:20px;"><?php echo $this->session->userdata('name')?></p>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <?php if ($this->session->userdata('jabatan_id') == 3) : ?>

                    <li><a href="<?php echo base_url('Lembaga')?>"><i class="fa fa-edit"></i> Belum TTE</a>
                    </li>
                    <li><a href="<?php echo base_url('Lembaga/sudahtte')?>"><i class="fa fa-check"></i> Sudah TTE</a>
                    </li>
                    <li><a href="<?php echo base_url('Lembaga/progrestte')?>"><i class="fa fa-paper-plane-o"></i> Progres TTE</a>
                    </li>
                    <li><a href="<?php echo base_url('Lembaga/surat_tugas')?>"><i class="fa fa-copy"></i> Surat Tugas</a>
                    </li>
                    <li><a href="<?php echo base_url('Auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a>
                    </li>


                  <?php elseif ($this->session->userdata('jabatan_id') == 2) : ?>
                   <li><a><i class="fa fa-hospital-o"></i>RS</a>
                    <ul class="nav child_menu" style="display:none;">
                      <li><a href="<?php echo base_url('Mutu_fasyankes')?>">BELUM VERIFIKASI</a></li>
                      <li><a href="<?php echo base_url('Mutu_fasyankes/sudahverif')?>">SUDAH VERIFIKASI</a></li>
                    </ul>
                  </li>


                 <!--  <li><a><i class="fa fa-building-o"></i>NON RS</a>
                    <ul class="nav child_menu" style="display:none;">
                      <li><a href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi')?>">BELUM VERIFIKASI</a></li>
                      <li><a href="<?php echo base_url('Mutu_fasyankes/nonrssudahverifikasi')?>">SUDAH VERIFIKASI</a></li>
                    </ul>
                  </li> -->



                  <li><a><i class="fa fa-building-o"></i> Non RS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Verifikasi<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li class="sub_menu"><a href="<?php echo base_url('Mutu_fasyankes/nonrsbelumverifikasi')?>">Belum Verifikasi</a>
                          </li>
                          <li><a href="<?php echo base_url('Mutu_fasyankes/nonrssudahverifikasi')?>">Sudah Verifikasi</a>
                          </li>
                          <li><a href="#level2_2">Perbaikan</a>
                          </li>
                        </ul>
                      </li>

                      <li><a>TTE LPA<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li class="sub_menu"><a href="<?php echo base_url('Mutu_fasyankes/ceklpa/Belum')?>">Belum TTE</a>
                          </li>
                          <li><a href="<?php echo base_url('Mutu_fasyankes/ceklpa/Sudah')?>">Sudah TTE</a>
                          </li>
                        </ul>
                      </li>

                      <li><a>TTE Dirjen<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li class="sub_menu"><a href="<?php echo base_url('Mutu_fasyankes/cekdirjen/Belum')?>">Belum TTE</a>
                          </li>
                          <li><a href="<?php echo base_url('Mutu_fasyankes/cekdirjen/Sudah')?>">Sudah TTE</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-home"></i>TPMD</a>
                    <ul class="nav child_menu" style="display:none;">
                      <li><a href="<?php echo base_url('Mutu_fasyankes/tpmd')?>">BELUM VERIFIKASI</a></li>
                      <li><a href="<?php echo base_url('Mutu_fasyankes/tpmdvalid')?>">SUDAH VERIFIKASI</a></li>
                    </ul>
                  </li>

                  <li><a href="<?php echo base_url('DirjenYankes/monitoring');?>"><i class="fa fa-clock-o"></i>Monitoring</a></li>  
                  <li><a href="<?php echo base_url('Auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>



                <?php elseif ($this->session->userdata('jabatan_id') == 1) : ?>
                  <li><a><i class="fa fa-building-o"></i>SERTIFIKAT RS</a>
                    <ul class="nav child_menu" style="display:block;">
                      <li><a href="<?php echo base_url('DirjenYankes')?>">BELUM TTE</a></li>
                      <li><a href="<?php echo base_url('DirjenYankes/sudahtte')?>">SUDAH TTE</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-hospital-o"></i>SERTIFIKAT NON RS</a>
                    <ul class="nav child_menu" style="display:block;">
                      <li><a href="<?php echo base_url('DirjenYankes/nonrsbelumtte')?>">BELUM TTE</a></li>
                      <li><a href="<?php echo base_url('DirjenYankes/nonrssudahtte')?>">SUDAH TTE</a></li>
                    </ul>
                  </li>
                 <!--  <li><a><i class="fa fa-hospital-o"></i>SERTIFIKAT TPMD / TPMDG</a>
                    <ul class="nav child_menu" style="display:block;">
                      <li><a href="<?php echo base_url('DirjenYankes/TPMDbelumtte')?>">BELUM TTE</a></li>
                      <li><a href="<?php echo base_url('DirjenYankes/tpmdTTE')?>">SUDAH TTE</a></li>
                    </ul>
                  </li> -->
                  <li><a href="<?php echo base_url('DirjenYankes/monitoring');?>"><i class="fa fa-clock-o"></i>Monitoring</a></li>
                  <li><a href="<?php echo base_url('Auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>

                <?php elseif ($this->session->userdata('jabatan_id') == 10) : ?>
                  <li><a><i class="fa fa-hospital-o"></i>SERTIFIKAT NON RS</a>
                    <ul class="nav child_menu" style="display:block;">
                      <li><a href="<?php echo base_url('DirjenYankes/nonrsbelumtte')?>">BELUM TTE</a></li>
                      <li><a href="<?php echo base_url('DirjenYankes/nonrssudahtte')?>">SUDAH TTE</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-hospital-o"></i>SERTIFIKAT TPMD / TPMDG</a>
                    <ul class="nav child_menu" style="display:block;">
                      <li><a href="<?php echo base_url('DirjenYankes/TPMDbelumtte')?>">BELUM TTE</a></li>
                      <li><a href="<?php echo base_url('DirjenYankes/tpmdTTE')?>">SUDAH TTE</a></li>
                    </ul>
                  </li>s
                  <li><a href="<?php echo base_url('DirjenYankes/monitoring');?>"><i class="fa fa-clock-o"></i>Monitoring</a></li>
                  <li><a href="<?php echo base_url('Auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>


                <?php elseif ($this->session->userdata('jabatan_id') == 5) : ?>
                  <li><a href="<?php echo base_url('ProfileLpa')?>"><i class="fa fa-home"></i>Profile</a></li>
                  <li><a><i class="fa fa-hospital-o"></i>TTE Ketua LPA<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display:block;">
                      <li><a href="<?php echo base_url('AkreditasiNonRS');?>">Belum TTE</span></a></li>
                      <li><a href="<?php echo base_url('AkreditasiNonRS/nonrssudahtte');?>">Sudah TTE</a></li>
                    </ul>
                  </li> 
                  <li><a><i class="fa fa-hospital-o"></i>TTE Dirjen Yankes<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display:block;">
                      <li><a href="<?php echo base_url('AkreditasiNonRS/cekdirjen/Belum');?>">Belum TTE</span></a></li>
                      <li><a href="<?php echo base_url('AkreditasiNonRS/cekdirjen/Sudah');?>">Sudah TTE</a></li>
                    </ul> 
                  </li>
                  <li><a href="<?php echo base_url('Surat_tugas/general');?>"><i class="fa fa-file"></i>Surat Tugas</a></li>
                  <li><a href="<?php echo base_url('AkreditasiNonRS/monitoring');?>"><i class="fa fa-eye"></i>Monitoring</a></li>
                  <!-- <li><a href="<?php echo base_url('AkreditasiNonRS/Monitoring')?>"><i class="fa fa-eye"></i>Monitoring</a></li> -->
                  <li><a href="<?php echo base_url('Auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                <?php elseif ($this->session->userdata('jabatan_id') == 7) : ?>
                  <li><a href="<?php echo base_url('AdminNomorSurat');?>"><i class="fa fa-edit"></i>Belum Input Nomor</a></li>
                  <li><a href="<?php echo base_url('AdminNomorSurat/SudahInput');?>"><i class="fa fa-edit"></i>Sudah Input Nomor</a></li>
                  <li><a><i class="fa fa-home"></i>TPMD</a>
                    <ul class="nav child_menu" style="display:none;">
                      <li><a href="<?php echo base_url('AdminNomorSurat/tpmd')?>">BELUM VERIFIKASI</a></li>
                      <li><a href="<?php echo base_url('AdminNomorSurat/tpmdnomor')?>">SUDAH VERIFIKASI</a></li>
                    </ul>
                  </li>
                  <li><a href="<?php echo base_url('DirjenYankes/monitoring');?>"><i class="fa fa-clock-o"></i>Monitoring</a></li>
                  <li><a href="<?php echo base_url('AdminNomorSurat/Export_data');?>"><i class="fa fa-database"></i>Export Data</a></li>
                  <li><a href="<?php echo base_url('Auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                <?php elseif ($this->session->userdata('jabatan_id') == 8) : ?>
                  <li><a href="<?php echo base_url('Task');?>"><i class="fa fa-file"></i>Vendor</a></li>
                  <li><a href="<?php echo base_url('Task/perbaikan_sertifikat');?>"><i class="fa fa-file"></i>Pebaikan Sertifikat</a></li>
                  <li><a href="<?php echo base_url('Task/puskesmas');?>"><i class="fa fa-file"></i>Tarik Puskesmas</a></li>
                  <li><a href="<?php echo base_url('Surat_tugas/general');?>"><i class="fa fa-file"></i>Surat Tugas</a></li>
                  <li><a href="<?php echo base_url('Auth/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                <?php endif; ?>


              </ul>
              <br>

            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
               <a href="javascript:;" id="navbarDropdown1" aria-expanded="false">
                <i class="fa fa-wifi"></i>
              </a>
              <!-- <span class="badge bg-green" id="result"></span> -->
              <div class="result" id="result">
                ...
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <?php $this->load->view($contents)?>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
      <div class="pull-right">
        Copyright-2022<i class="fa fa-copyright"></i><a href="https://yankes.kemkes.go.id"> Ditjen Yankes - Informasi dan Humas</a>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function(){
    $('#myselection').on('change', function(){
      var demovalue = $(this).val(); 
      $("div.myDiv").hide();
      $("#show"+demovalue).show();
    });
  });
</script>

<!-- jQuery -->
<script type="text/javascript">

  if(window.addEventListener){
    window.addEventListener('load', InitiateSpeedDetection, false);
  }else if(window.attachEvent){
    window.attachEvent('onload', InitiateSpeedDetection);
  }

  var imageAddr = "https://4k-uhd.nl/wp-content/uploads/2018/08/4K-3840x2160-Wallpaper-Uitzicht-5.jpg"; 
        var downloadSize = 5739426; //bytes

        function ShowProgressMessage(msg) {
          var oProgress = document.getElementById("progress");
          if (oProgress) {
            oProgress.innerHTML = msg;
          }
        }

        function showResultMessage(msg){
          document.getElementById("result").innerHTML = msg;
          document.getElementById("progress").innerHTML = '';
        }

        function InitiateSpeedDetection() {
          ShowProgressMessage("Calculating Speed ...");
          window.setTimeout(MeasureConnectionSpeed, 1);
        };

        function MeasureConnectionSpeed() {
          var startTime, endTime;
          var download = new Image();
          download.onload = function () {
            endTime = (new Date()).getTime();
            showResults();
          }

          download.onerror = function (err, msg) {
            ShowProgressMessage("Invalid image, or error downloading");
          }

          startTime = (new Date()).getTime();
          var cacheBuster = "?nnn=" + startTime;
          download.src = imageAddr + cacheBuster;

          function showResults() {
            var duration = (endTime - startTime) / 1000;
            var bitsLoaded = downloadSize * 8;
            var speedBps = (bitsLoaded / duration).toFixed(2);
            var speedKbps = (speedBps / 1024).toFixed(2);
            var speedMbps = (speedKbps / 1024).toFixed(2);
            showResultMessage(speedMbps + " Mbps");
          }
        }
      </script>
      <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
      <script>
        $(document).ready(function(){
          $(".preloader").fadeOut();
        })
      </script>
      <script type="text/javascript">
        function spinner() {
          document.getElementsByClassName("preloader")[0].style.display = "block";
        }
      </script>
      <script src="<?php echo base_url('assets');?>/vendors/echarts/dist/echarts.min.js"></script>
      <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="<?php echo base_url('assets');?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url('assets');?>/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="<?php echo base_url('assets');?>/vendors/nprogress/nprogress.js"></script>
      <!-- iCheck -->
      <script src="<?php echo base_url('assets');?>/vendors/iCheck/icheck.min.js"></script>
      <!-- Datatables -->
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/jszip/dist/jszip.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/pdfmake/build/pdfmake.min.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/pdfmake/build/vfs_fonts.js"></script>

      <script src="<?php echo base_url('assets');?>/vendors/pnotify/dist/pnotify.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/pnotify/dist/pnotify.buttons.js"></script>
      <script src="<?php echo base_url('assets');?>/vendors/pnotify/dist/pnotify.nonblock.js"></script>

      <!-- Custom Theme Scripts -->
      <script src="<?php echo base_url('assets');?>/build/js/custom.min.js"></script>

    </body>
    </html>