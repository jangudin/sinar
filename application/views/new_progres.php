            <?php
            if ($cek == 'Belum') {
              $look = "col-md-12 col-sm-12";
              $dis = "none";
            } else {
              $look = "col-md-6 col-sm-6";
              $dis = "";
            }
            ?>
          <?php
            if ($this->session->userdata('jabatan_id') == 5) {
              $slpa = "none";
            } else {
              $slpa = "block";
            }
            ?>

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <br />
    <br />
    <div class="row">
      <div class="<?= $look ?>">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sertifikat <?= $cek ?> TTE DIRJEN </h2>
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
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Faskes</th>
                <th>Nama Faskes</th>
                <th style="display:<?= $slpa ?>">Nama LPA</th>
                <th style="display:<?= $dis ?>;">Aksi</th>
              </tr>
            </thead>
            <tbody>
             <?php 
             $i = 1;
             foreach ($data as $a) { ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?=$a->kode_faskes ?></td>
                <td><?=$a->nama_faskes ?></td>
                <td style="display:<?= $slpa ?>"><?=$a->nmlpa ?></td>
                <td style="display:<?= $dis ?>">
                  <button type="button" id="https://sinar.kemkes.go.id/assets/faskessertif/<?=$a->url_sertifikat ?>" class="btn btn-success btn-sm" onClick="reply_click(this.id)">CEK</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>


    <div class="col-md-6 col-sm-6 " style="display:<?= $dis ?>;">
      <div class="x_panel">
        <div class="x_title">
          <h2>View Sertifikat</h2>
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
        <iframe id="doc" src="" hidden="hidden" width="580" height="500"></iframe>
      </div>
    </div>

  </div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
  var doc = document.querySelector('#doc');
  function reply_click(clicked_id)
  {
      document.getElementById('doc').src = clicked_id;
      document.getElementById('doc').hidden = '';
  }
</script>