<?php if ($this->session->userdata('apps') == '5'): ?>
<div class="files-grid" role="list" aria-live="polite" aria-relevant="all">
        <div class="file-item" data-href="apps/verifikasirs" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#fbbc04;">verified</span>
          <div class="file-name">Verifikasi</div>
        </div>
        <div class="file-item" data-href="apps/tters" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#34a853;">draw</span>
          <div class="file-name">TandaTangan</div>
        </div> 
      </div>
<?php endif; ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Rumah Sakit</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>RS Harapan Sehat</td>
            <td>Jl. Sehat No. 123</td>
            <td>021-12345678</td>
            <td>
                <a href="edit/1" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete/1" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>RS Kasih Ibu</td>
            <td>Jl. Kasih No. 456</td>
            <td>021-87654321</td>
            <td>
                <a href="edit/2" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete/2" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
            </td>
        </tr>
    </tbody>
</table>
<script>
document.querySelectorAll('.file-item').forEach(item => {
  item.addEventListener('click', () => {
    const href = item.dataset.href;
    if (href) window.location.href = href;
  });
});
</script>