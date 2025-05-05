<!DOCTYPE html>
<html>

<head>
    <title>Login | e-saf</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi Tandatangan elektronik Sinar">
    <meta name="author" content="Wahyudin">
    <!-- Bootstrap -->
    <link href="<?php echo base_url() . 'assets/temp/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo base_url() . 'assets/temp/css/stylesl.css' ?>" rel="stylesheet">
    <style type="email/css">
        body {
            background-image: url(<?php echo base_url() . 'assets/bg.png' ?>);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
        }
    </style>


</head>

<body class="login" style="margin-top: 60px;">


    <div class="page-content container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-wrapper">
                    <div class="box">
                        <div class="content-wrap">
                            <img width="200px" src="<?php echo base_url() . 'assets/temp/img/logotte.png' ?>" />
                            <h3><b>Sertifikasi Elektronik</b></h3>
                            <h2><b>SINAR<b>
                                        <h2>
                                            <p><?php echo $this->session->flashdata('msg'); ?></p>
                                            <hr />
                                            <form action="<?php echo base_url() . 'Auth/aksi_login' ?>" method="post">
                                                <input class="form-control" type="email" name="email" placeholder="Username" required>
                                                <input class="form-control" type="password" name="password" placeholder="Password" required>
                                                <div class="action">
                                                    <button type="submit" class="btn btn-lg">Login</button>

                                                </div>
                                            </form>
                                            <br>
                                            <br>
                                            <div>
                                                <img width="120px" src="<?php echo base_url() . 'assets/temp/img/loginlg1.png' ?>" />
                                                <img width="120px" src="<?php echo base_url() . 'assets/temp/img/logobsre.png' ?>" />
                                            </div>
                        </div>
                    </div>

                    <!-- 			        <div class="already">
						<button class="btn btn-light" type="submit">Portal Ditjen Yankes</button>
						<button class="btn btn-light" type="submit">Dashboard</button>
			        </div> -->
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url() . 'assets/temp/js/jquery.min.js' ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url() . 'assets/temp/js/bootstrap.min.js' ?>"></script>

</body>

</html>