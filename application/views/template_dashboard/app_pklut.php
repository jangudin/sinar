<?php if ($this->session->userdata('apps') == '5'): ?>
<div class="files-grid" role="list" aria-live="polite" aria-relevant="all">
        <div class="file-item" data-href="apps/verifikasirs" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#fbbc04;">folder</span>
          <div class="file-name">PUSKESMAS</div>
        </div>
        <div class="file-item" data-href="apps/tters" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#34a853;">folder</span>
          <div class="file-name">KLINIK</div>
        </div>
        <div class="file-item" data-href="apps/tters" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#34a853;">folder</span>
          <div class="file-name">LABKES</div>
        </div>
        <div class="file-item" data-href="apps/tters" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#34a853;">folder</span>
          <div class="file-name">UTD</div>
        </div>
          <div class="file-item" data-href="apps/tters" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#34a853;">folder</span>
          <div class="file-name">TPMD</div>
        </div>
        </div>
      </div>
<?php endif; ?>
<script>
document.querySelectorAll('.file-item').forEach(item => {
  item.addEventListener('click', () => {
    const href = item.dataset.href;
    if (href) window.location.href = href;
  });
});
</script>