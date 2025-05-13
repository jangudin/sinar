<?php if ($this->session->userdata('apps') == '5'): ?>
<div class="files-grid" role="list" aria-live="polite" aria-relevant="all">
        <div class="file-item" data-href="apps/rumahsakit" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#fbbc04;">folder</span>
          <div class="file-name">RS</div>
        </div>
        <div class="file-item" data-href="apps/pklut" role="listitem" tabindex="0" aria-label="Folder: Projects" style="cursor: pointer;">
          <span class="material-icons file-icon" style="color:#34a853;">folder</span>
          <div class="file-name">Selain RS</div>
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
            <a href="tes.com" class="file-link">
            <span class="material-icons file-icon" style="color:#ea4335;">slideshow</span>
            </a>
          <div class="file-name">Presentation.pptx</div>
        </div>
        <div class="file-item" role="listitem" tabindex="0" aria-label="File: Design.sketch">
          <span class="material-icons file-icon" style="color:#00838f;">palette</span>
          <div class="file-name">Design.sketch</div>
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