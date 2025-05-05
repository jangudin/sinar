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


    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets');?>/build/css/custom.min.css" rel="stylesheet">

     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"> -->
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
                  <li><a href="index.html" link="active">Dashboard</a></li>
                  <li><a href="Perbaikan">Perbaikan Sertifikat</a></li>
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

<div class="right_col" role="main">
  <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Monitoring Progres <small>Tanda Tangan Elektronik</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>
<div class="">
 <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count"><?php
                   foreach ($jmlrek as $data) {
                     ?>
            <div class="number"><?=$data->jumlah_rek ?></div>
          <?php } ?></div>
                  <h3>Rekomendasi</h3>
                  <p>Total Rs yg di rekomendasikan LIPA</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count"><?php
                   foreach ($dikerjakanlem as $data) {
                     ?>
            <div class="number"><?=$data->lembaga ?></div>
            <?php } ?></div>
                  <h3>TTE Lembaga</h3>
                  <p>Sertifikat Sudah TTE LIPA</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count"><?php
                   foreach ($dikerjakanmutu as $data) {
                     ?>
            <div class="number"><?=$data->mutu ?></div>
            <?php } ?></div>
                  <h3>Validasi MUTU</h3>
                  <p>Sertifikat di Validasi mutu</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count"><?php
                   foreach ($dikerjakandir as $data) {
                     ?>
            <div class="number"><?=$data->dirjen ?></div>
            <?php } ?></div>
                  <h3>Dirjen Yankes</h3>
                  <p>Sertifikat Di TTE Dirjen Yankes</p>
                </div>
              </div>
            </div>
<div class="clearfix"></div>
<div class="row">
<div class="col-md-12 col-sm-12 ">
<div class="x_panel">
<div class="x_title">
<h2>Data</h2>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<a class="dropdown-item" href="#">Settings 1</a>
<a class="dropdown-item" href="#">Settings 2</a>
</div>
</li>
<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
<div class="x_content">
<div class="row">
<div class="col-sm-12">
<div class="card-box table-responsive">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>KODERS</th>
                <th>Nama Rumah Sakit</th>
                <th>Lembaga Akreditasi</th>
                <th>Tgl tte lembaga</th>
                <th>Lembaga</th>
                <th>Mutu</th>
                <th>Dirjen</th>
                <th>Capaian</th>
                <th>Sertifikat</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              foreach ($list->result_array() as $a):
                $id=$a['id'];
                $rs=$a['namaRS'];
                $lrs=$a['lembagaAkreditasiId'];
                $lem=$a['lembaga'];
                $mut=$a['mutu'];
                $dir=$a['dirjen'];
                $tgl_tte=$a['tte_lembaga'];
                $kd=$a['Propinsi'];
                $capayan=$a['nama'];
                $link=$a['sertifikat_2']

           ?>
            <tr> 
                <td  style="text-align: center;"><?php echo $kd; ?></td>
                <td><?php echo $rs; ?></td>
                <td  style="text-align: center;"><?php echo $lrs; ?></td>
                <td  style="text-align: center;"><?php echo $tgl_tte; ?></td>
                <td  style="text-align: center;">
                  <span style="color: transparent;"><?php echo $lem; ?></span>
                    <?php if ($lem == 1): ?>
                  <div class="indicator">
                  <i class="fa fa-check-square"></i>
                  </div>
                <?php else : ?>
                  <div class="indicator">
                    <i class='fa fa-close'></i>
                  </div>
                <?php endif; ?>
                  </td>

                <td  style="text-align: center;">
                  <?php if ($mut == 1): ?>
                    <span style="color: transparent;"><?php echo $mut; ?></span>
                  <div class="indicator">
                  <i class="fa fa-check-square"></i>
                  </div>
                  <?php elseif ($mut == 2): ?>
                    <span>Ditolak</span>

                  <?php elseif ($mut == 0): ?>
                    <span style="color: transparent;"><?php echo $mut; ?></span>
                  <div class="indicator">
                    <i class='fa fa-close'></i>
                  </div>
                <?php endif; ?>
               </td>

                <td  style="text-align: center;">
                  <span style="color: transparent;"><?php echo $dir; ?></span>
                  <?php if ($dir == 1): ?>
                  <div class="indicator">
                  <i class="fa fa-check-square"></i>
                  </div>
                <?php else : ?>
                  <div class="indicator">
                    <i class='fa fa-close'></i>
                  </div>
                <?php endif; ?>
                </td>
                <td><?php echo $capayan; ?></td>
                <td>
                <?php if ($dir == 1): ?>
                  <a class="btn btn-app" href="https://sinar.kemkes.go.id/assets/generate/<?php echo $lrs; ?>/<?php echo $link; ?>" target="_blank">
                  <i class="fa fa-copy"></i>
                   Sertifikat</a>
                   <?php else : ?>
                   <?php endif; ?>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
            </table>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
      </div>
        <footer>
          <div class="pull-right">
            Copyright-2022<i class="fa fa-copyright"></i><a href="https://yankes.kemkes.go.id"> Ditjen Yankes - Informasi dan Humas</a>
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

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
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
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
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
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

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets');?>/build/js/custom.min.js"></script>

     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" charset="utf-8"></script>
  <script>
  $(function () {
     $('#datatable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      scrollX: true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'excel'
    ]
    });
     $('#example4').DataTable({
    "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "bDestroy": true,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
    });
     $('#example5').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    buttons: [
        'copy', 'excel', 'pdf'
    ]
    }); 
     $('#example3').DataTable({
      "paging": false,  
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
  ]
    }); 

      $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    }); 

    $('#example7').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    }); 
    $('#rawatkomplikasi').DataTable({
      "paging": true, 
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
  ]
    }); 

    $('#rawattanpakomplikasi').DataTable({
      "paging": true, 
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
  ]
    }); 
    
    $('#pasienkeluar').DataTable({
      "paging": true, 
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
  ]
    }); 
     
     $('#borprop').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

   $('#borkabkota').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

    $('#pasiendirawatprop').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

    $('#pasiendirawatkab').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

   $('#pasienmeninggalprop').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

    $('#pasienmeninggalkab').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

    $('#logobat').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

    $('#logapd').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

    $('#borrs').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ]
    });

     $('#dataalkes').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });

    $('#dataoksigenasi').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });
  
    $('#datasdm').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });

    $('#dataigdtriase').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });

   $('#dataplasma').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });

    $('#datanakes').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });

   $('#datapcr').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });

    $('#datasuplier').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
    buttons: [
        'copy', 'excel'
    ]
    });



  });
</script>

  </body>
</html>