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

<div class="files-grid" role="list" aria-live="polite" aria-relevant="all">
    <?php foreach ($menu_data as $menu): ?>
        <div class="file-item nav-item" data-menu-id="<?php echo $menu['id_apps_menu']; ?>" role="listitem" tabindex="0" aria-label="<?php echo htmlspecialchars($menu['nama_menu']); ?>">
            <span class="material-icons file-icon" style="color:#fbbc04;"><?php echo htmlspecialchars($menu['icon']); ?></span>
            <div class="file-name"><?php echo htmlspecialchars($menu['nama_menu']); ?></div>
        </div>
        <div class="submenu-vertical" id="submenu-<?php echo $menu['id_apps_menu']; ?>" role="menu" aria-label="<?php echo htmlspecialchars($menu['nama_menu']); ?> submenu" style="display: none;">
            <?php foreach ($menu['sub_menus'] as $sub_menu): ?>
                <button class="submenu-btn" tabindex="0" role="menuitem" aria-label="<?php echo htmlspecialchars($sub_menu['nama_sub_menu']); ?>">
                    <span class="material-icons" aria-hidden="true"><?php echo htmlspecialchars($sub_menu['icon']); ?></span>
                    <?php echo htmlspecialchars($sub_menu['nama_sub_menu']); ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
