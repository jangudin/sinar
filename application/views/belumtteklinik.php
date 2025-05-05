<div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <br />
            <br />
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Klinik<small>Belum Validasi</small></h2>
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
                                    <th>No</th>
                                    <th>Kode Faskes</th>
                                    <th>Nama Faskes</th>
                                    <th>Nomor Sertifikat</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php 
                                            $no=0;
                                            foreach ($data->result_array() as $a):
                                                $no++;
                                                $id=$a['fasyankes_id'];
                                                $fs=$a['nama_klinik'];
                                                $noser=$a['nomor_sertifikat'];
                                        ?>
                                    <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $fs; ?></td>
                                    <td><?php echo $noser; ?></td>
                                    <!-- <td><span class="badge badge-success">Sudah TTE</span></td> -->
                                    <td>
                                      <a href="<?php echo base_url('AkreditasiNonRS/ttesertifikat/'.$id);?>" class="btn btn-success btn-xs" onclick="spinner()" >Validasi Sertifikat</a>
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
        </div>