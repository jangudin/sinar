<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>Responsive GDrive-like Dashboard with Verification Filters</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

  /* Reset & base */
  * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #f5f7fa;
    color: #202124;
    height: 100vh;
    display: flex;
    overflow: hidden;
  }

  /* Sidebar */
  .sidebar {
    background-color: #ffffff;
    border-right: 1px solid #ddd;
    display: flex;
    flex-direction: column;
    padding-top: 12px;
    transition: width 0.3s ease;
    flex-shrink: 0;
    width: 72px;
    align-items: center;
  }
  .sidebar.expanded {
    width: 200px;
    align-items: flex-start;
    padding-left: 16px;
  }
  .profile-top {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 12px 12px 12px;
    width: 100%;
    border-bottom: 1px solid #ddd;
    margin-bottom: 8px;
  }
  .profile-top .profile-menu {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #1a73e8;
    color: #fff;
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    cursor: pointer;
    transition: background-color 0.2s;
    position: relative;
  }
  .profile-top .profile-menu:hover {
    background-color: #155ab6;
  }
  .profile-top .profile-name {
    font-weight: 600;
    font-size: 14px;
    color: #202124;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 110px;
  }
  .sidebar:not(.expanded) .profile-top .profile-name {
    display: none;
  }
  .sidebar .nav-items {
    width: 100%;
  }
  .sidebar .nav-item {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 16px;
    cursor: pointer;
    padding: 12px 12px;
    border-radius: 8px;
    color: #5f6368;
    font-weight: 500;
    font-size: 14px;
    user-select: none;
    transition: background-color 0.2s, color 0.2s;
    position: relative;
  }
  .sidebar .nav-item.active,
  .sidebar .nav-item:hover {
    background-color: #e8f0fe;
    color: #1a73e8;
  }
  .sidebar .nav-item .material-icons {
    font-size: 28px;
    min-width: 28px;
    text-align: center;
  }
  .sidebar.expanded .nav-item .label {
    display: inline;
  }
  .sidebar .nav-item .label {
    display: none;
  }

  /* Main content */
  .main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    background-color: #fff;
    height: 100vh;
  }

  /* Topbar */
  .topbar {
    height: 56px;
    border-bottom: 1px solid #ddd;
    display: flex;
    align-items: center;
    padding: 0 16px;
    font-weight: 500;
    font-size: 18px;
    color: #202124;
    user-select: none;
    background: #fff;
    flex-shrink: 0;
  }
  .topbar .menu-toggle {
    display: none;
    cursor: pointer;
    margin-right: 16px;
    font-size: 28px;
    color: #5f6368;
  }
  .topbar .app-name {
    font-weight: 700;
    font-size: 20px;
    margin-right: 16px;
    user-select: none;
    color: #1a73e8;
  }
  .topbar .actions {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .topbar .material-icons.action-btn:hover {
    color: #1a73e8;
  }

  /* Files container */
  .files-container {
    padding: 12px 16px;
    overflow-y: auto;
    flex: 1;
    background: #fff;
  }

  /* Grid for files/folders */
  .files-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
    gap: 12px;
  }
  .file-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    border-radius: 8px;
    padding: 10px 8px;
    user-select: none;
    transition: background-color 0.2s;
  }
  .file-item:hover {
    background-color: #f1f3f4;
  }
  .file-item:active {
    background-color: #e8f0fe;
  }
  .file-icon {
    font-size: 42px;
    color: #616161;
    margin-bottom: 6px;
  }
  .file-name {
    font-size: 13px;
    color: #3c4043;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
  }

  /* Table responsive container */
  .table-responsive {
    margin-top: 24px;
    overflow-x: auto;
  }

  /* Datatable styles */
  .datatable-container {
    margin-top: 24px;
    background: #fff;
    padding: 16px;
    border-radius: 8px;
    box-shadow: 0 1px 6px rgba(0,0,0,0.1);
    max-width: 100%;
    box-sizing: border-box;
  }
  .datatable-search {
    margin-bottom: 12px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
  }
  .datatable-search input[type="search"]{
    flex: 1;
    min-width: 180px;
    padding: 8px 12px;
    border: 1.5px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    outline-offset: 2px;
    transition: border-color 0.3s;
  }
  .datatable-search input[type="search"]:focus {
    border-color: #1a73e8;
    outline: none;
  }

  /* Status filter buttons */
  .status-filters {
    display: flex;
    gap: 12px;
  }
  .status-filter-btn {
    background-color: #e8f0fe;
    border: none;
    color: #1a73e8;
    padding: 10px 22px;
    border-radius: 24px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    user-select: none;
    box-shadow: 0 2px 6px rgba(26, 115, 232, 0.3);
    transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
    min-width: 120px;
    text-align: center;
    flex-shrink: 0;
  }
  .status-filter-btn:hover {
    background-color: #1a73e8;
    color: #fff;
    box-shadow: 0 4px 14px rgba(26, 115, 232, 0.5);
  }
  .status-filter-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.6);
  }
  .status-filter-btn.active {
    background-color: #155ab6;
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(21, 90, 182, 0.7);
  }

  table.datatable {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    min-width: 600px;
    font-size: 14px;
  }
  table.datatable thead tr {
    background-color: #f1f3f4;
  }
  table.datatable th {
    padding: 12px 10px;
    font-weight: 600;
    color: #5f6368;
    text-align: left;
    cursor: pointer;
    position: relative;
    user-select: none;
  }
  table.datatable th.sortable:hover {
    background-color: #e8f0fe;
  }
  table.datatable th .sort-arrow {
    position: absolute;
    right: 12px;
    font-size: 14px;
    opacity: 0.4;
    user-select: none;
  }
  table.datatable tbody tr {
    background: #fff;
    box-shadow: 0 1px 2px rgba(60,64,67,.1);
    border-radius: 8px;
    transition: box-shadow 0.15s ease;
  }
  table.datatable tbody tr:hover {
    box-shadow: 0 4px 8px rgba(60,64,67,.15);
  }
  table.datatable td {
    padding: 12px 10px;
    vertical-align: middle;
    white-space: nowrap;
    color: #202124;
  }
  .file-type-cell {
    width: 48px;
    font-size: 24px;
    text-align: center;
  }

  /* Scrollbar style */
  .files-container::-webkit-scrollbar {
    width: 8px;
  }
  .files-container::-webkit-scrollbar-thumb {
    background-color: rgba(60,64,67,.3);
    border-radius: 4px;
  }
  .files-container::-webkit-scrollbar-track {
    background-color: transparent;
  }

  /* Responsive */
  @media (max-width: 600px) {
    table.datatable {
      border-spacing: 0;
      min-width: auto;
    }
    table.datatable thead {
      display: none;
    }
    table.datatable tbody tr {
      display: block;
      margin-bottom: 12px;
      background: #f9fafb;
      border-radius: 6px;
      padding: 12px 10px;
      box-shadow: none;
    }
    table.datatable tbody td {
      display: flex;
      justify-content: space-between;
      padding: 6px 0;
      border-bottom: 1px solid #ddd;
      white-space: normal;
    }
    table.datatable tbody td:last-child {
      border-bottom: none;
    }
    table.datatable tbody td::before {
      content: attr(data-label);
      font-weight: 600;
      color: #5f6368;
      flex-basis: 40%;
      text-align: left;
    }
    .file-type-cell {
      font-size: 20px;
      padding-left: 0;
      justify-content: flex-start;
    }
    .file-type-cell span.material-icons {
      margin-right: 10px;
      vertical-align: middle;
    }
  }

  /* Pagination */
  .datatable-pagination {
    margin-top: 12px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 8px;
    user-select: none;
  }
  .datatable-pagination button {
    background: #f1f3f4;
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    color: #202124;
    transition: background-color 0.3s;
  }
  .datatable-pagination button[disabled] {
    opacity: 0.5;
    cursor: default;
  }
  .datatable-pagination button:hover:not([disabled]) {
    background-color: #c2dafd;
  }
  .datatable-pagination .page-info {
    font-size: 14px;
    color: #5f6368;
    margin-left: auto;
    user-select: text;
  }
</style>
</head>
<body>
  <nav class="sidebar" aria-label="Main Navigation">
    <div class="profile-top" tabindex="0" role="button" aria-label="User profile: Sinar User">
      <div class="profile-menu">SI</div>
      <div class="profile-name">Sinar User</div>
    </div>
    <div class="nav-items" role="menu">
      <div class="nav-item active" data-section="my-drive" tabindex="0" role="menuitem" aria-pressed="true">
        <span class="material-icons" aria-hidden="true">folder</span>
        <span class="label">My Drive</span>
      </div>
      <div class="nav-item" data-section="shared" tabindex="0" role="menuitem" aria-pressed="false">
        <span class="material-icons" aria-hidden="true">people</span>
        <span class="label">Shared with me</span>
      </div>
      <div class="nav-item" data-section="recent" tabindex="0" role="menuitem" aria-pressed="false">
        <span class="material-icons" aria-hidden="true">access_time</span>
        <span class="label">Recent</span>
      </div>
      <div class="nav-item" data-section="trash" tabindex="0" role="menuitem" aria-pressed="false">
        <span class="material-icons" aria-hidden="true">delete</span>
        <span class="label">Trash</span>
      </div>
      <div class="nav-item" data-section="storage" tabindex="0" role="menuitem" aria-pressed="false">
        <span class="material-icons" aria-hidden="true">storage</span>
        <span class="label">Storage</span>
      </div>
    </div>
  </nav>
  <main class="main-content" role="main" tabindex="-1">
    <header class="topbar">
      <span class="material-icons menu-toggle" title="Toggle menu" role="button" tabindex="0">menu</span>
      <span class="app-name" aria-label="Application name">Sinar</span>
      <span class="title">My Drive</span>
      <div class="actions" role="toolbar" aria-label="File actions">
        <span class="material-icons action-btn" title="Refresh" tabindex="0" role="button" aria-label="Refresh files">refresh</span>
        <span class="material-icons action-btn" title="New Folder" tabindex="0" role="button" aria-label="Create new folder">create_new_folder</span>
        <span class="material-icons action-btn" title="Upload" tabindex="0" role="button" aria-label="Upload files">upload_file</span>
        <span class="material-icons action-btn" id="viewToggleBtn" title="Toggle grid/table view" tabindex="0" role="button" aria-label="Toggle grid or table view">view_module</span>
      </div>
    </header>
    <section class="files-container" aria-label="Files and folders">
      <div class="files-grid" role="list" aria-live="polite" aria-relevant="all">
        <div class="file-item" role="listitem" tabindex="0" aria-label="Folder: Projects">
          <span class="material-icons file-icon" style="color:#fbbc04;">folder</span>
          <div class="file-name">Projects</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="Folder: Photos">
          <span class="material-icons file-icon" style="color:#34a853;">folder</span>
          <div class="file-name">Photos</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="File: Report.pdf">
          <span class="material-icons file-icon" style="color:#4285f4;">picture_as_pdf</span>
          <div class="file-name">Report.pdf</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="File: Budget.xlsx">
          <span class="material-icons file-icon" style="color:#0f9d58;">grid_on</span>
          <div class="file-name">Budget.xlsx</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="File: Meeting Notes.txt">
          <span class="material-icons file-icon" style="color:#f28b25;">description</span>
          <div class="file-name">Meeting Notes.txt</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="Folder: Work">
          <span class="material-icons file-icon" style="color:#a142f4;">folder</span>
          <div class="file-name">Work</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="File: Presentation.pptx">
          <span class="material-icons file-icon" style="color:#ea4335;">slideshow</span>
          <div class="file-name">Presentation.pptx</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="File: Design.sketch">
          <span class="material-icons file-icon" style="color:#00838f;">palette</span>
          <div class="file-name">Design.sketch</div>
        </div>
      </div>

      <div class="table-responsive">
        <div class="datatable-container" aria-label="Data Table">
          <div class="status-filters" role="group" aria-label="Filter by verification status" style="margin-bottom:12px; display:flex; gap:12px; flex-wrap:wrap;">
            <button type="button" class="status-filter-btn active" data-status="all" style="background-color: #155ab6; color: #ffffff; border: none; padding: 10px 22px; border-radius: 24px; font-weight:600; font-size:14px; cursor:pointer; user-select:none; box-shadow: 0 4px 14px rgba(21, 90, 182, 0.7); min-width: 120px; text-align:center; flex-shrink:0;">Semua</button>
            <button type="button" class="status-filter-btn" data-status="verified" style="background-color: #e8f0fe; color: #1a73e8; border: none; padding: 10px 22px; border-radius: 24px; font-weight: 600; font-size: 14px; cursor: pointer; user-select: none; box-shadow: 0 2px 6px rgba(26, 115, 232, 0.3); min-width: 120px; text-align:center; flex-shrink: 0;">Sudah Verifikasi</button>
            <button type="button" class="status-filter-btn" data-status="unverified" style="background-color: #e8f0fe; color: #1a73e8; border: none; padding: 10px 22px; border-radius: 24px; font-weight: 600; font-size: 14px; cursor: pointer; user-select: none; box-shadow: 0 2px 6px rgba(26, 115, 232, 0.3); min-width: 120px; text-align:center; flex-shrink: 0;">Belum Verifikasi</button>
          </div>

          <div class="datatable-search">
            <label for="datatableSearchInput" style="display:none;">Cari nama</label>
            <input type="search" id="datatableSearchInput" placeholder="Cari nama file..." aria-label="Cari nama file" style="width:100%; padding:8px 12px; border:1.5px solid #ddd; border-radius:6px; font-size:14px; font-family: inherit; outline-offset:2px; transition: border-color 0.3s;" />
          </div>
          <table class="datatable" aria-describedby="datatableSearchInput" style="width:100%; border-collapse: separate; border-spacing: 0 8px; min-width: 600px; font-size:14px;">
            <thead>
              <tr style="background-color: #f1f3f4;">
                <th scope="col" class="sortable" data-key="name" tabindex="0" aria-sort="none" style="padding:12px 10px; font-weight:600; color:#5f6368; text-align:left; cursor:pointer; position:relative; user-select:none;">
                  Name <span class="sort-arrow" style="position:absolute; right:12px; font-size:14px; opacity:0.4; user-select:none;">⇅</span>
                </th>
                <th scope="col" class="sortable" data-key="type" tabindex="0" aria-sort="none" style="padding:12px 10px; font-weight:600; color:#5f6368; text-align:left; cursor:pointer; position:relative; user-select:none;">
                  Type <span class="sort-arrow" style="position:absolute; right:12px; font-size:14px; opacity:0.4; user-select:none;">⇅</span>
                </th>
                <th scope="col" class="sortable" data-key="size" tabindex="0" aria-sort="none" style="padding:12px 10px; font-weight:600; color:#5f6368; text-align:left; cursor:pointer; position:relative; user-select:none;">
                  Size <span class="sort-arrow" style="position:absolute; right:12px; font-size:14px; opacity:0.4; user-select:none;">⇅</span>
                </th>
                <th scope="col" class="sortable" data-key="modified" tabindex="0" aria-sort="none" style="padding:12px 10px; font-weight:600; color:#5f6368; text-align:left; cursor:pointer; position:relative; user-select:none;">
                  Last Modified <span class="sort-arrow" style="position:absolute; right:12px; font-size:14px; opacity:0.4; user-select:none;">⇅</span>
                </th>
              </tr>
            </thead>
            <tbody id="datatableBody">
              <!-- Filled by JavaScript -->
            </tbody>
          </table>
          <div class="datatable-pagination" aria-label="Pagination controls" style="margin-top:12px; display:flex; justify-content:flex-end; gap:8px; user-select:none;">
            <button id="prevPageBtn" aria-label="Previous page" disabled style="background:#f1f3f4; border:none; padding:6px 14px; border-radius:6px; cursor:pointer; font-weight:600; color:#202124; transition:background-color 0.3s;">Prev</button>
            <button id="nextPageBtn" aria-label="Next page" style="background:#f1f3f4; border:none; padding:6px 14px; border-radius:6px; cursor:pointer; font-weight:600; color:#202124; transition:background-color 0.3s;">Next</button>
            <span class="page-info" id="pageInfo" style="font-size:14px; color:#5f6368; margin-left:auto; user-select:text;"></span>
          </div>
        </div>
    </section>
  </main>
<script>
  // Data with verification status
  const data = [
    { name: 'Report.pdf', type: 'PDF', size: '1.2 MB', modified: '2024-06-01', status: 'verified' },
    { name: 'Budget.xlsx', type: 'Spreadsheet', size: '900 KB', modified: '2024-06-07', status: 'unverified' },
    { name: 'Meeting Notes.txt', type: 'Text', size: '20 KB', modified: '2024-06-10', status: 'verified' },
    { name: 'Presentation.pptx', type: 'Presentation', size: '2.8 MB', modified: '2024-06-01', status: 'verified' },
    { name: 'Design.sketch', type: 'Design', size: '3.5 MB', modified: '2024-06-05', status: 'unverified' },
    { name: 'Project Alpha', type: 'Folder', size: '--', modified: '2024-05-20', status: 'verified' },
    { name: 'Project Beta', type: 'Folder', size: '--', modified: '2024-05-21', status: 'unverified' },
    { name: 'Project Gamma', type: 'Folder', size: '--', modified: '2024-05-22', status: 'verified' },
    { name: 'Notes.txt', type: 'Text', size: '12 KB', modified: '2024-06-02', status: 'verified' },
    { name: 'Summary.docx', type: 'Document', size: '45 KB', modified: '2024-06-03', status: 'unverified' }
  ];
  const tbody = document.getElementById('datatableBody');
  const prevBtn = document.getElementById('prevPageBtn');
  const nextBtn = document.getElementById('nextPageBtn');
  const pageInfo = document.getElementById('pageInfo');
  const searchInput = document.getElementById('datatableSearchInput');
  const headers = document.querySelectorAll('.datatable th.sortable');
  const statusButtons = document.querySelectorAll('.status-filter-btn');

  const rowsPerPage = 5;
  let currentPage = 1;
  let currentSortKey = null;
  let currentSortOrder = 'asc';
  let currentSearchTerm = '';
  let currentStatusFilter = 'all';

  function parseSize(sizeStr) {
    if(sizeStr === '--') return -1;
    const units = {'kb':1, 'mb':1024};
    let [num, unit] = sizeStr.toLowerCase().split(' ');
    num = parseFloat(num);
    return num * (units[unit] || 1);
  }

  function compare(a, b, key, order) {
    let valA = a[key];
    let valB = b[key];
    if(key === 'size'){
      valA = parseSize(valA);
      valB = parseSize(valB);
    } else if(key === 'modified'){
      valA = new Date(valA);
      valB = new Date(valB);
    } else {
      valA = valA.toString().toLowerCase();
      valB = valB.toString().toLowerCase();
    }
    if(valA < valB) return order === 'asc' ? -1 : 1;
    if(valA > valB) return order === 'asc' ? 1 : -1;
    return 0;
  }

  function filterData(data, term){
    let filtered = data;
    if(currentStatusFilter !== 'all'){
      filtered = filtered.filter(item => item.status === currentStatusFilter);
    }
    if(!term) return filtered;
    term = term.toLowerCase();
    return filtered.filter(item => item.name.toLowerCase().includes(term));
  }

  function paginateData(data, page){
    const start = (page - 1) * rowsPerPage;
    return data.slice(start, start + rowsPerPage);
  }

  function escapeHtml(text){
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  function renderTable(){
    let filtered = filterData(data, currentSearchTerm);
    if(currentSortKey){
      filtered.sort((a,b) => compare(a,b,currentSortKey,currentSortOrder));
    }
    const pageData = paginateData(filtered, currentPage);
    tbody.innerHTML = '';
    pageData.forEach(item => {
      const tr = document.createElement('tr');
      tr.tabIndex = 0;
      tr.innerHTML = `
        <td data-label="Name">${escapeHtml(item.name)}</td>
        <td data-label="Type">${escapeHtml(item.type)}</td>
        <td data-label="Size">${escapeHtml(item.size)}</td>
        <td data-label="Last Modified">${escapeHtml(item.modified)}</td>
      `;
      tbody.appendChild(tr);
    });
    const totalPages = Math.max(1, Math.ceil(filtered.length / rowsPerPage));
    pageInfo.textContent = `Page ${currentPage} dari ${totalPages}`;
    prevBtn.disabled = currentPage <= 1;
    nextBtn.disabled = currentPage >= totalPages;
  }

  prevBtn.addEventListener('click', () => {
    if(currentPage > 1){
      currentPage--;
      renderTable();
    }
  });
  nextBtn.addEventListener('click', () => {
    const totalPages = Math.ceil(filterData(data,currentSearchTerm).length / rowsPerPage);
    if(currentPage < totalPages){
      currentPage++;
      renderTable();
    }
  });
  searchInput.addEventListener('input', (e) => {
    currentSearchTerm = e.target.value.trim();
    currentPage = 1;
    renderTable();
  });
  headers.forEach(header => {
    header.addEventListener('click', () => {
      const key = header.dataset.key;
      if(currentSortKey === key){
        currentSortOrder = currentSortOrder === 'asc' ? 'desc' : 'asc';
      } else {
        currentSortKey = key;
        currentSortOrder = 'asc';
      }
      headers.forEach(h => {
        h.setAttribute('aria-sort', 'none');
        h.querySelector('.sort-arrow').textContent = '⇅';
      });
      header.setAttribute('aria-sort', currentSortOrder === 'asc'? 'ascending' : 'descending');
      header.querySelector('.sort-arrow').textContent = currentSortOrder === 'asc'? '⬆' : '⬇';
      renderTable();
    });
    header.addEventListener('keydown', e => {
      if(e.key === 'Enter' || e.key === ' '){
        e.preventDefault();
        header.click();
      }
    });
  });
  statusButtons.forEach(button => {
    button.addEventListener('click', () => {
      statusButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      currentStatusFilter = button.getAttribute('data-status');
      currentPage = 1;
      renderTable();
    });
  });

  renderTable();
</script>
</body>
</html>

