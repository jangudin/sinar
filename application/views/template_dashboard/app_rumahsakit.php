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
        <table class="datatable" aria-describedby="datatableSearchInput">
          <thead>
            <tr>
              <th scope="col" class="sortable" data-key="name" tabindex="0" aria-sort="none">Name <span class="sort-arrow">⇅</span></th>
              <th scope="col" class="sortable" data-key="type" tabindex="0" aria-sort="none">Type <span class="sort-arrow">⇅</span></th>
              <th scope="col" class="sortable" data-key="size" tabindex="0" aria-sort="none">Size <span class="sort-arrow">⇅</span></th>
              <th scope="col" class="sortable" data-key="modified" tabindex="0" aria-sort="none">Last Modified <span class="sort-arrow">⇅</span></th>
            </tr>
          </thead>
          <tbody id="datatableBody">
            <!-- Rows inserted by JavaScript -->
          </tbody>
        </table>
        <div class="datatable-pagination" aria-label="Pagination controls">
          <button id="prevPageBtn" aria-label="Previous page" disabled>Prev</button>
          <button id="nextPageBtn" aria-label="Next page">Next</button>
          <span class="page-info" id="pageInfo"></span>
        </div>
      </div>
    </section>
<script>
    const data = [
    { name: 'Report.pdf', type: 'PDF', size: '1.2 MB', modified: '2024-06-01' },
    { name: 'Budget.xlsx', type: 'Spreadsheet', size: '900 KB', modified: '2024-06-07' },
    { name: 'Meeting Notes.txt', type: 'Text', size: '20 KB', modified: '2024-06-10' },
    { name: 'Presentation.pptx', type: 'Presentation', size: '2.8 MB', modified: '2024-06-01' },
    { name: 'Design.sketch', type: 'Design', size: '3.5 MB', modified: '2024-06-05' },
    { name: 'Project Alpha', type: 'Folder', size: '--', modified: '2024-05-20' },
    { name: 'Project Beta', type: 'Folder', size: '--', modified: '2024-05-21' },
    { name: 'Project Gamma', type: 'Folder', size: '--', modified: '2024-05-22' },
    { name: 'Notes.txt', type: 'Text', size: '12 KB', modified: '2024-06-02' },
    { name: 'Summary.docx', type: 'Document', size: '45 KB', modified: '2024-06-03' },
    // Add more data if needed
  ];

  const rowsPerPage = 5;
  let currentPage = 1;
  let currentSortKey = null;
  let currentSortOrder = 'asc';
  let currentSearchTerm = '';

  const tbody = document.getElementById('datatableBody');
  const prevBtn = document.getElementById('prevPageBtn');
  const nextBtn = document.getElementById('nextPageBtn');
  const pageInfo = document.getElementById('pageInfo');
  const searchInput = document.getElementById('datatableSearchInput');
  const headers = document.querySelectorAll('.datatable th.sortable');

  function compare(a, b, key, order) {
    let valA = a[key];
    let valB = b[key];

    // For size field, parse as KB or MB (numeric comparison)
    if (key === 'size') {
      valA = parseSize(valA);
      valB = parseSize(valB);
    } else if (key === 'modified') {
      valA = new Date(valA);
      valB = new Date(valB);
    } else {
      valA = valA.toString().toLowerCase();
      valB = valB.toString().toLowerCase();
    }

    if (valA < valB) return order === 'asc' ? -1 : 1;
    if (valA > valB) return order === 'asc' ? 1 : -1;
    return 0;
  }

  function parseSize(sizeStr) {
    if(sizeStr === '--') return -1; // treat folders smaller than any files
    const units = {'kb': 1, 'mb': 1024};
    let [number, unit] = sizeStr.toLowerCase().split(' ');
    number = parseFloat(number);
    return number * (units[unit] || 1);
  }

  function filterData(data, term) {
    if(!term) return data;
    term = term.toLowerCase();
    return data.filter(item => item.name.toLowerCase().includes(term));
  }

  function paginateData(filteredData, page) {
    const start = (page - 1) * rowsPerPage;
    return filteredData.slice(start, start + rowsPerPage);
  }

  function renderTable() {
    let filteredData = filterData(data, currentSearchTerm);

    if(currentSortKey) {
      filteredData.sort((a,b) => compare(a,b,currentSortKey,currentSortOrder));
    }

    const paginatedData = paginateData(filteredData, currentPage);

    tbody.innerHTML = '';
    paginatedData.forEach(item => {
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

    pageInfo.textContent = `Page ${currentPage} of ${Math.max(1, Math.ceil(filteredData.length / rowsPerPage))}`;
    prevBtn.disabled = currentPage <= 1;
    nextBtn.disabled = currentPage >= Math.ceil(filteredData.length / rowsPerPage);
  }

  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Event listeners
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
    currentSearchTerm = e.target.value;
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

      header.setAttribute('aria-sort', currentSortOrder === 'asc' ? 'ascending' : 'descending');
      header.querySelector('.sort-arrow').textContent = currentSortOrder === 'asc' ? '⬆' : '⬇';

      renderTable();
    });

    header.addEventListener('keydown', e => {
      if(e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        header.click();
      }
    });
  });

  // Initial render
  renderTable();
document.querySelectorAll('.file-item').forEach(item => {
  item.addEventListener('click', () => {
    const href = item.dataset.href;
    if (href) window.location.href = href;
  });
});
</script>