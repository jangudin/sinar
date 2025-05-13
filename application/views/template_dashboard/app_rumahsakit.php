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
 <h2>Daftar Folder Aplikasi</h2>

  <div class="table-container">
    <table id="fileTable" class="display" style="width:100%">
      <thead>
        <tr>
          <th>Icon</th>
          <th>Nama Folder</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><span class="material-icons" style="color:#fbbc04;">folder</span></td>
          <td>RS</td>
          <td><a href="apps/rumahsakit">Buka</a></td>
        </tr>
        <tr>
          <td><span class="material-icons" style="color:#34a853;">folder</span></td>
          <td>Selain RS</td>
          <td><a href="apps/pklut">Buka</a></td>
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
    $(document).ready(function () {
      $('#fileTable').DataTable({
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ data",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          paginate: {
            first: "Pertama",
            last: "Terakhir",
            next: "Berikutnya",
            previous: "Sebelumnya"
          },
          zeroRecords: "Tidak ditemukan data yang cocok"
        }
      });
    });
</script>