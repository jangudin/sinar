<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail User</h3>
        <div class="card-tools">
            <a href="<?php echo site_url('user'); ?>" class="btn btn-sm btn-default">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="30%">ID User</th>
                        <td><?php echo $user->id; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td><?php echo $user->nama; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $user->email; ?></td>
                    </tr>
                    <tr>
                        <th>Sertifikat Klas</th>
                        <td><?php echo $user->srt_klas; ?></td>
                    </tr>
                    <tr>
                        <th>ID Pejabat Sertifikat</th>
                        <td><?php echo $user->pejabat_sertifikat_id; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat</th>
                        <td><?php echo date('d/m/Y H:i', strtotime($user->created_at)); ?></td>
                    </tr>
                    <tr>
                        <th>Terakhir Diupdate</th>
                        <td>
                            <?php 
                            if($user->modified_at != '0000-00-00 00:00:00') {
                                echo date('d/m/Y H:i', strtotime($user->modified_at));
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-header">
                        <h3 class="card-title">Aksi</h3>
                    </div>
                    <div class="card-body text-center">
                        <form action="/action_page.php">
                          <label for="fname">Kode Faskes:</label>
                          <input type="number" id="fname" name="kodeFaskes"><br><br>
                          <input type="submit" value="Submit" class="btn btn-warning btn-block mb-2">
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>