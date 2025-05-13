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
document.querySelectorAll('.file-item').forEach(item => {
  item.addEventListener('click', () => {
    const href = item.dataset.href;
    if (href) window.location.href = href;
  });
});
</script>