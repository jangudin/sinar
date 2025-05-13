    <div class="container">
        <div class="header">
            <h1 class="title">Dashboard</h1>
            <div class="user-info">
                <span class="user-name"><?= $this->session->userdata('name'); ?></span>
                <span class="user-role"><?= $this->session->userdata('role'); ?></span>
            </div>
        </div>

        <div class="content">
            <div class="sidebar">
                <ul class="menu-list">
                    <?php foreach($menu_data as $menu): ?>
                        <li><a href="<?= base_url($menu->link); ?>"><?= $menu->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="main-content">
                <!-- Main content goes here -->
            </div>
        </div>
    </div>
<?php if($this->session->userdata('status') != "login"):?>
    <?=redirect(base_url());?>
<?php else:?>
  <?php echo  $this->session->flashdata('Hallo'); ?>
<?php endif;?>
<!-- <div class="files-grid" role="list" aria-live="polite" aria-relevant="all">
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
      </div> -->