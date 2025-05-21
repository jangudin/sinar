<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class>
      <div class="row">
        <div class="col-md-12">
          <div class>
            <div class="x_content">
              <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-copy"></i>
                    </div>
                    <div class="count">
                      <?php if ($this->session->userdata('nik') == '3174102606710006') {
                        echo $belumtte_dua->belumTTE; 
                      }else{
                        echo $belumtte->belumTTE;
                      } ?>
                      </div>
                    <h3>Belum TTE</h3>
                  </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-copy"></i>
                    </div>
                    <div class="count"><?php echo $sudahtte->sudahTTE; ?></div>
                    <h3>Sudah TTE</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DAFTAR SERTIFIKAT</h2>
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

                  <?php if ($this->session->userdata('jabatan_id') == 10) : ?>
                     <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo base_url('DirjenYankes/nonrsbelumtte/Pusat Kesehatan Masyarakat') ?>">
                      Puskesmas
                    </a>
                  </div>

                  <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo base_url('DirjenYankes/nonrsbelumtte/Klinik/Pratama') ?>">
                      Klinik Pratama
                    </a>
                  </div>
                  <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo base_url('DirjenYankes/nonrsbelumtte/Laboratorium/Laboratorium Kesehatan') ?>">
                      Lab Kesmas
                    </a>
                  </div>

                <?php elseif ($this->session->userdata('jabatan_id') == 1) : ?>
                                      
                   <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo base_url('DirjenYankes/nonrsbelumtte/Klinik/Utama') ?>">
                      Klinik Utama
                    </a>
                  </div>

                  <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo base_url('DirjenYankes/nonrsbelumtte/Laboratorium/Laboratorium Medis') ?>">
                      Lab Medis
                    </a>
                  </div>

                   <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo base_url('DirjenYankes/nonrsbelumtte/Unit Transfusi Darah') ?>">
                      UPD
                    </a>
                  </div>

                  <?php endif; ?>

                  </div>

                  <!-- <table id="datatable" class="table table-striped table-bordered" style="width:100%"> -->
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Faskes</th>
                          <th>Jenis Faskes</th>
                          <th>Nama Faskes</th>
                          <th>LPA</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                       $i = 1;
                       foreach ($prapus as $a) { ?>

                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?=$a->kode_faskes ?></td>
                          <td><?=$a->kategori_faskes ?></td>
                          <td><?=$a->nama_faskes ?></td>
                          <td><?=$a->lpa_id ?></td>
                          <td>
                            <a class="btn btn-sm btn-success" href="<?php echo base_url('DirjenYankes/nonrsdetail/'.$a->id_pengajuan.'/'.$a->lpa_id)  ?>"><span data-feather="edit"></span> Detail</a>
                            
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>