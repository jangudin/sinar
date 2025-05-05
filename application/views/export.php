<div class="right_col" role="main">
  <div class>
    <div class="page-title">
      <div class="title_left">
        <h3>Export Data</h3>
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
          <div class="x_content">
            <table  id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th style="text-align:center;">Kode Faskes</th>
                  <th style="text-align:center;">Nama Faskes</th>
                  <th style="text-align:center;">Jenis Faskes</th>
                  <th>Nama LPA</th>
                  <th style="text-align:center;">TGL Sertifikat</th>
                  <th style="text-align:center;">Nomor Sertifikat</th>
                  <th style="text-align:center;">Masa Berlaku Sertifikat</th>
                </tr>
              </thead>
              <tbody>
                 <?php  
                $i = 1;
                foreach ($data as $value) { 
                  ?>

                  <tr>
                    <td style="text-align:center;"><?= $i++; ?></td>
                    <td style="text-align:center;"><?=$value->kode_faskes; ?></td>
                    <td style="text-align:left;"><?=$value->nama_faskes; ?></td>
                    <td style="text-align:center;"><?=$value->jenis_faskes; ?></td>
                    <td style="text-align:center;"><?=$value->lpa; ?></td>
                    <td style="text-align:center;"><?=$value->tgl_nomor_surat; ?></td>
                    <td style="text-align:center;"><?=$value->nomor_surat; ?></td>
                    <td style="text-align:center;"><?= date('Y-m-d', strtotime('+5 year', strtotime($value->tgl_nomor_surat))); ?></td>
                  </tr>
                <?php }?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>