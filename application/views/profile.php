<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <!-- <h3>Detail</h3> -->
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5">
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <?php echo $this->session->flashdata('msg');?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profile</h2>
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
                  
                  <?php foreach ($profile as $s) { ?>
                      <div class="col-md-6 col-sm-6  profile_details">
                      <div class="well profile_view">
                      <div class="col-sm-12">
                      <h4 class="brief"><i>Profile User</i></h4>
                      <div class="left col-md-12 col-sm-12">
                      <h2><?=$s->nama_lembaga ?></h2>
                      <p><strong>Nama: </strong><?=$s->nama ?> </p>
                      <ul class="list-unstyled">
                      <li><i class="fa fa-comments"></i> Email: <?=$s->email ?></li>
                      <li><i class="fa fa-user"></i> Nik : <?=$s->nik ?></li>
                      <br>
                      <button type="button" class="btn btn-success btn-sm" onclick="myFunction()"> <i class="fa fa-eye">
                      </i> Ganti Password</button>
                      </ul>
                      </div>
                      </div>
                      </div>
                      </div>
                  <?php } ?>

                      <div id="showform" style="display: none;">
                      <div class="col-md-6 col-sm-6  profile_details">
                      <div class="well profile_view">
                      <div class="col-sm-12">
                      <h4 class="brief"><i>Form Ganti Password</i></h4>
                      <div class="left col-md-12 col-sm-12">
                       <form class="form-horizontal form-label-left" action="<?= base_url('ProfileLpa/Updatepass') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password Lama<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                               <input type="text" name="id" value="" required="required" class="form-control">
                              <input type="hidden" name="password" value="<?php echo $this->session->userdata('id') ?>" required="required" class="form-control">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Password Baru <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="password" id="last-name" name="password" required="required" class="form-control ">
                            </div>
                          </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                  <br>
                                                    <button type='submit' class="btn btn-primary" onclick="spinner()">Update</button>
                                                </div>
                                            </div>
                                        </div>
                        </form>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>

                      <script>
                        function myFunction() {
                          var x = document.getElementById("showform");
                          if (x.style.display === "none") {
                            x.style.display = "block";
                          } else {
                            x.style.display = "none";
                          }
                        }
                        </script>

                </div>
              </div>
                                    
                  <br />
                  <hr>
                  <br />
                  <br />
            </div>
          </div>
        </div>