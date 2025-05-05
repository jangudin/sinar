<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar User</h3>
        <div class="card-tools">
            <a href="<?php echo site_url('apps/sinar/create'); ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Sertifikat Klas</th>
                    <th>Tanggal Dibuat</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->nama; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->srt_klas; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($user->created_at)); ?></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="<?php echo site_url('apps/sinar/view/'.$user->id); ?>" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo site_url('apps/sinar/edit/'.$user->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?php echo site_url('user/delete/'.$user->id); ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>