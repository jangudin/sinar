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
                                    <th>Status Verifikasi Mutu</th>
                                    <th>Catatan</th>
                                    <th>Progres</th>
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
                                                $status=$a['mutu'];
                                                $ket=$a['keterangan'];
                                        ?>
                                    <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $kdrs; ?></td>
                                    <td><?php echo $rs; ?></td>
                                    <td>
                                      <?php if ($status == 2): ?>
                                      <span class="badge badge-danger">Ditolak</span>
                                      <?php else: ?>
                                      <span class="badge badge-success">Disetujui</span>
                                    <?php endif; ?>
                                    </td>
                                    <td> <?php if ($status == 2): ?>
                                      <p><?php echo $ket ?></p>
                                      <?php else: ?>
                                      <span class="badge badge-success">Tidak ada keterangan</span>
                                    <?php endif; ?></td>
                                    <td>
                                      <a class="btn btn-xs btn-info" href="#progresview<?php echo $id?>" data-toggle="modal" title="Edit">Progres</a>
                                    </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                                </table> 


                  <?php 
                       foreach ($data->result_array() as $a):
                                                $id=$a['id_rekomendasi'];
                                                $TimeLembaga=$a['tgl_dibuat_lembaga'];
                                                $verifmutu=$a['mutu'];
                                                $TimeMutu=$a['tgl_dibuat_mutu'];
                                                $keterangan=$a['keterangan'];
                                                $dirjen=$a['dirjen'];
                                                $TimeDirjen=$a['tgl_dibuat_dirjen'];
                                                $idlembaga = $this->session->userdata('lembaga_id');
                                                                          if($idlembaga == 'kars'){
                                                        $attachment = 'assets/generate/kars/showfiletteKars_dirjen'.$id.'.pdf';
                                                    }elseif($idlembaga == 'lam') {
                                                        $attachment = 'assets/generate/lam/showfiletteLamdirjen'.$id.'.pdf';
                                                    }elseif ($idlembaga == 'larsi') {
                                                        $attachment = 'assets/generate/larsi/showfiletteLarsidirjen'.$id.'.pdf';
                                                    }elseif ($idlembaga == 'larsdhp') {
                                                        $attachment = 'assets/generate/larsdhp/showfiletteLarsdhpdirjen'.$id.'.pdf';
                                                    }elseif ($idlembaga == 'lafki') {
                                                        $attachment = 'assets/generate/lafki/showfilettelafkidirjen'.$id.'.pdf';
                                                    }elseif ($idlembaga == 'lars') {
                                                        $attachment = 'assets/generate/lars/showfiletteLarsdirjen'.$id.'.pdf';
                                                    }

                                        ?>
                  <div id="progresview<?php echo $id?>" class="modal fade bs-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Timeline Progress</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container-fluid">
                        <div class="x_content">
                          <ul class="list-unstyled timeline">
                            <li>
                              <div class="block">
                                <div class="tags">
                                  <a href="" class="tag">
                                    <span>Lembaga</span>
                                  </a>
                                </div>
                                <div class="block_content">
                                  <h2 class="title">
                                                  <a>Telah Disetujui dan di Tandatangan secara elektronik</a>
                                              </h2>
                                  <div class="byline">
                                    <span>Time : <?php echo $TimeLembaga; ?></span>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <?php if ($verifmutu >= 0): ?>
                            <li>
                              <div class="block">
                                <div class="tags">
                                  <a href="" class="tag">
                                    <span>Mutu</span>
                                  </a>
                                </div>
                                <div class="block_content">
                                  <h2 class="title">
                                          <?php if ($verifmutu == '1') : ?>
                                            <a> Telah diverifikasi dan disetujui oleh Direktorat Mutu </a>
                                          <?php elseif ($verifmutu == '2') : ?>
                                            <a style="color: red;"> Pengajuan ditolak oleh Direktorat Mutu</a>
                                          <?php elseif ($verifmutu == 0) : ?>
                                            <a> Belum diverifikasi </a>
                                          <?php endif; ?>   
                                              </h2>
                                  <div class="byline">
                                    <span>Time : <?php echo $TimeMutu; ?></span>
                                  </div>
                                  <p class="excerpt">Keterangan : <?php echo $keterangan; ?></p>
                                </div>
                              </div>
                            </li>
                          <?php endif; ?>
                          <?php if ($dirjen == 0): ?>
                          <?php else: ?>
                            <li>
                              <div class="block">
                                <div class="tags">
                                  <a href="" class="tag">
                                    <span>Dirjen Yankes</span>
                                  </a>
                                </div>
                                <div class="block_content">
                                  <h2 class="title">
                                          <?php if ($dirjen == '1') : ?>
                                            <a> Telah di setujui oleh Dirjen yankes </a>
                                          <?php elseif ($dirjen == '2') : ?>
                                            <a> Pengajuan ditolak Dirjen Yankes</a>
                                          <?php elseif ($dirjen == 0) : ?>
                                            <a> Belum di tindak lanjuti </a>
                                          <?php endif; ?>
                                              </h2>
                                  <div class="byline">
                                    <span><?php echo $TimeDirjen; ?></span>
                                  </div>
                                  <label><a href="<?php echo base_url($attachment) ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Lihat Berkas</a></label>
                                  <!-- <a href="<?= $attachment ?>"><p><i class="fa fa-file-pdf-o"></i> Lihat Berkas<p></a> -->
                                </div>
                              </div>
                            </li>
                          <?php endif; ?>
                          </ul>

                        </div>
                      </div>
                    </div>
                      </div>
                    </div>
                  </div>  
                              <?php endforeach;?> 
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