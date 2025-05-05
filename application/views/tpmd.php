<div class="right_col" role="main">
  <div class>
    <div class="page-title">
      <div class="title_left">
        <h3>TPMD / TPMDG</h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Progres Akreditasi</h2>
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
            <table  id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Faskes</th>
                  <th style="text-align:center;">Kode Faskes</th>
                  <th> Aksi </th>
                </tr>
              </thead>
              <tbody>
                       <?php $i = 1; foreach ($data as $a) { ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?=$a->nama_pm ?></td>
                          <td><?=$a->kode_faskes_baru ?></td>
                          <?php if ($link == "tpmdvalid") : ?>
                          <td>
                              <a class="btn btn-sm btn-success" href="<?php echo base_url('Mutu_fasyankes/detailtpmd/'.$a->kode_faskes_baru);?>"><span data-feather="edit"></span> Lihat</a>
                          </td>
                            <?php else: ?>
                              <td>
                              <a class="btn btn-sm btn-success" href="<?php echo base_url('Mutu_fasyankes/detailtpmd/'.$a->kode_faskes_baru);?>"><span data-feather="edit"></span> Validasi </a>
                            </td>
                            <?php endif; ?>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>