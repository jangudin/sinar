<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah User Baru</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php echo form_open('user/store'); ?>
        <div class="card-body">
            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="srt_klas">Sertifikat Klas</label>
                        <input type="text" class="form-control" id="srt_klas" name="srt_klas" placeholder="Masukkan sertifikat klas">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pejabat_sertifikat_id">ID Pejabat Sertifikat</label>
                        <input type="number" class="form-control" id="pejabat_sertifikat_id" name="pejabat_sertifikat_id" placeholder="Masukkan ID pejabat">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo site_url('user'); ?>" class="btn btn-default">Batal</a>
        </div>
    <?php echo form_close(); ?>
</div>