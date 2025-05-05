<div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <br />
            <br />
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Rumah Sakit<small>Rekomendasi</small></h2>
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
                                    <th>KodeRS</th>
                                    <th>Nama RS</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php 
                                            $no=0;
                                            foreach ($data->result_array() as $a):
                                                $no++;
                                                $id=$a['id'];
                                                $rs=$a['namaRS'];
                                                $kdrs=$a['kodeRS'];
                                        ?>
                                    <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $kdrs; ?></td>
                                    <td><?php echo $rs; ?></td>
                                    <td>
                                      <a href="<?php echo base_url('LembagaLafki/Detail/').$id;?>" class="btn btn-info btn-xm"><i class="fa fa-eye" aria-hidden="true"> Detail</i></a>
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
        </div>ss