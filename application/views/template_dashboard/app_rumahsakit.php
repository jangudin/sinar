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
        <div class="datatable-container" aria-label="Data Table">
  <div class="status-filters" role="group" aria-label="Filter by verification status">
    <button type="button" class="status-filter-btn active" data-status="all">Semua</button>
    <button type="button" class="status-filter-btn" data-status="verified">Sudah Verifikasi</button>
    <button type="button" class="status-filter-btn" data-status="unverified">Belum Verifikasi</button>
  </div>
  <div class="datatable-search">
    <label for="datatableSearchInput" class="visually-hidden">Search files</label>
    <input type="search" id="datatableSearchInput" placeholder="Cari nama..." aria-label="Cari nama file" />
  </div>
  <!-- existing datatable table here -->
  ...
</div>
    <script>
  // Additional status filter JS
  const statusButtons = document.querySelectorAll('.status-filter-btn');
  let currentStatusFilter = "all";

  statusButtons.forEach(button => {
    button.addEventListener('click', () => {
      statusButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      currentStatusFilter = button.getAttribute('data-status');
      currentPage = 1;
      renderTable();
    });
  });

  // Update sample data items to include status (verified/unverified)
  const data = [
    { name: 'Report.pdf', type: 'PDF', size: '1.2 MB', modified: '2024-06-01', status: 'verified' },
    { name: 'Budget.xlsx', type: 'Spreadsheet', size: '900 KB', modified: '2024-06-07', status: 'unverified' },
    { name: 'Meeting Notes.txt', type: 'Text', size: '20 KB', modified: '2024-06-10', status: 'verified' },
    // ...and so on, add status field accordingly
  ];

  // Modify filterData function to include status filter
  function filterData(data, term){
    let filtered = data;
    if(currentStatusFilter !== 'all'){
      filtered = filtered.filter(item => item.status === currentStatusFilter);
    }
    if(!term) return filtered;
    term = term.toLowerCase();
    return filtered.filter(item => item.name.toLowerCase().includes(term));
  }

  // Keep rest of your existing JS code unchanged, just update filterData usage inside renderTable.
  document.querySelectorAll('.file-item').forEach(item => {
  item.addEventListener('click', () => {
    const href = item.dataset.href;
    if (href) window.location.href = href;
  });
});
</script>