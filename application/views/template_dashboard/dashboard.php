<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');
  @import url('https://fonts.googleapis.com/icon?family=Material+Icons');

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

  /* User profile section at top */
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
  /* Hide profile name on collapsed sidebar */
  .sidebar:not(.expanded) .profile-top .profile-name {
    display: none;
  }

  /* Sidebar navigation items */
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

  /* Projects submenu - vertical under Projects menu item */
  .submenu-vertical {
    display: none;
    flex-direction: column;
    margin-left: 44px; /* indent */
    margin-top: 4px;
    width: calc(100% - 44px);
  }
  .submenu-vertical.open {
    display: flex;
  }
  .submenu-vertical .submenu-btn {
    padding: 8px 12px;
    font-size: 13px;
    background: transparent;
    border: none;
    text-align: left;
    color: #1a73e8;
    cursor: pointer;
    border-radius: 6px;
    user-select: none;
    transition: background-color 0.2s;
    width: 100%;
  }
  .submenu-vertical .submenu-btn:hover, .submenu-vertical .submenu-btn:focus {
    background-color: #e8f0fe;
    outline: none;
  }
  .submenu-vertical .submenu-btn.active {
    background-color: #1a73e8;
    color: white;
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
  .topbar .material-icons.action-btn {
    font-size: 24px;
    color: #5f6368;
    cursor: pointer;
    user-select: none;
  }
  .topbar .material-icons.action-btn:hover {
    color: #1a73e8;
  }

  /* Files area */
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

  /* File/folder item */
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

  /* Responsive adjustments */

  /* Mobile phones */
  @media (max-width: 480px) {
    body {
      flex-direction: column;
      height: 100%;
      max-height: 600px;
      max-width: 350px;
      border: 1px solid #ddd;
      border-radius: 6px;
      margin: 12px auto;
    }
    .sidebar {
      width: 100%;
      height: 48px;
      flex-direction: row;
      padding: 0 8px;
      border-right: none;
      border-bottom: 1px solid #ddd;
      align-items: center;
      justify-content: space-around;
      padding-left: 16px;
      padding-right: 16px;
    }
    .sidebar.expanded {
      width: 100%;
      height: 48px;
      flex-direction: row;
      padding: 0 8px;
    }
    /* Hide profile name on mobile as sidebar is horizontal */
    .profile-top .profile-name {
      display: none;
    }
    .profile-top {
      padding: 0;
      margin-bottom: 0;
      border-bottom: none;
      width: auto;
      gap: 8px;
      justify-content: center;
      flex: 0 0 auto;
    }
    .sidebar .nav-item {
      padding: 0;
      flex-direction: column;
      gap: 2px;
      font-size: 10px;
      justify-content: center;
    }
    .sidebar .nav-item .material-icons {
      font-size: 20px;
      min-width: auto;
      text-align: center;
    }
    .sidebar .nav-item .label {
      display: none !important;
    }
    .topbar {
      height: 48px;
      font-size: 16px;
      padding: 0 12px;
    }
    .topbar .menu-toggle {
      display: inline-block;
    }
    .main-content {
      flex: 1 1 auto;
      height: calc(100% - 48px - 48px);
      overflow: hidden;
    }
    .files-container {
      padding: 8px 12px;
    }
    .topbar .app-name {
      font-size: 16px;
      margin-right: 8px;
    }
  }

  /* Tablets 481-900px */
  @media (min-width: 481px) and (max-width: 900px) {
    .sidebar {
      width: 56px;
      align-items: center;
    }
    .sidebar.expanded {
      width: 160px;
      align-items: flex-start;
      padding-left: 16px;
    }
    .sidebar .nav-item .label {
      display: none;
    }
    .sidebar.expanded .nav-item .label {
      display: inline;
    }
    .topbar {
      height: 56px;
      font-size: 18px;
    }
    .topbar .menu-toggle {
      display: inline-block;
      margin-right: 16px;
    }
    .main-content {
      height: 100vh;
    }
    .files-container {
      padding: 12px 16px;
    }
    .topbar .app-name {
      font-size: 18px;
      margin-right: 12px;
    }
  }

  /* Laptops and larger */
  @media (min-width: 901px) {
    .sidebar {
      width: 72px;
      align-items: center;
    }
    .sidebar.expanded {
      width: 200px;
      align-items: flex-start;
      padding-left: 16px;
    }
    .sidebar .nav-item .label {
      display: none;
    }
    .sidebar.expanded .nav-item .label {
      display: inline;
    }
    .topbar {
      height: 56px;
      font-size: 18px;
    }
    .topbar .menu-toggle {
      display: inline-block;
      margin-right: 16px;
    }
    .main-content {
      height: 100vh;
    }
    .files-container {
      padding: 16px 20px;
    }
    .topbar .app-name {
      font-size: 20px;
      margin-right: 16px;
    }
  }
</style>
</head>
<body>
  <nav class="sidebar" aria-label="Main Navigation">
    <div class="profile-top" tabindex="0" role="button" aria-label="User profile: Sinar User">
      <div class="profile-menu">SI</div>
      <span class="app-name" aria-label="Application name"><?php echo $this->session->userdata('name')?></span>
    </div>

    <div class="nav-items" role="menu">
<?php foreach ($menu_data as $menu): ?>
  <div class="nav-item" data-section="<?php echo htmlspecialchars($menu['icon']); ?>" tabindex="0" role="button" aria-pressed="false">
    <span class="material-icons" aria-hidden="true"><?php echo htmlspecialchars($menu['icon']); ?></span>
    <span class="label"><?php echo htmlspecialchars($menu['nama_menu']); ?></span>
  </div>
<?php endforeach; ?>
</div>

  </nav>
  <main class="main-content" role="main" tabindex="-1">
    <header class="topbar">
      <span class="material-icons menu-toggle" title="Toggle menu">menu</span>
      <span class="app-name" aria-label="Application name">Sinar</span>
      <span class="title">My Drive</span>
    </header>
    <section class="files-container" aria-label="Files and folders">
      <!-- Grid View -->
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
    </section>
  </main>

<script>
  // Toggle sidebar expanded/collapsed on large screens or toggle visibility on mobile
  const sidebar = document.querySelector('.sidebar');
  const menuToggle = document.querySelector('.menu-toggle');
  const viewToggleBtn = document.getElementById('viewToggleBtn');
  const filesGrid = document.querySelector('.files-grid');
  const filesTable = document.querySelector('.files-table');
  const topbarTitle = document.querySelector('.topbar .title');
  const navItems = document.querySelectorAll('.sidebar .nav-item');

  // For view toggle
  let isGridView = true;
  function updateView() {
    if(isGridView){
      filesGrid.style.display = 'grid';
      filesTable.style.display = 'none';
      viewToggleBtn.textContent = 'view_module';
      viewToggleBtn.setAttribute('aria-label', 'Switch to table view');
    } else {
      filesGrid.style.display = 'none';
      filesTable.style.display = 'table';
      viewToggleBtn.textContent = 'table_view';
      viewToggleBtn.setAttribute('aria-label', 'Switch to grid view');
    }
  }
  viewToggleBtn.addEventListener('click', () => {
    isGridView = !isGridView;
    updateView();
  });

  // Sidebar expanded on wider screens - toggle for smaller screens
  function checkScreenAndSetSidebar() {
    if(window.innerWidth > 900){
      sidebar.classList.add('expanded');
      sidebar.style.display = 'flex';
    } else {
      sidebar.classList.remove('expanded');
      // On mobile viewport, toggle sidebar display by menu toggle button
      sidebar.style.display = 'none';
    }
  }

  checkScreenAndSetSidebar();

  menuToggle.addEventListener('click', () => {
    if(sidebar.style.display === 'flex'){
      sidebar.style.display = 'none';
      menuToggle.setAttribute('aria-expanded', 'false');
    } else {
      sidebar.style.display = 'flex';
      menuToggle.setAttribute('aria-expanded', 'true');
    }
  });

  // Close sidebar clicking outside on mobile
  document.body.addEventListener('click', (e) => {
    if(window.innerWidth <= 900){
      if(!sidebar.contains(e.target) && e.target !== menuToggle){
        sidebar.style.display = 'none';
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    }
  });

  // Navigation actions (for demo only - highlight active and update title)
  navItems.forEach(item => {
    item.addEventListener('click', () => {
      navItems.forEach(i => {
        i.classList.remove('active');
        i.setAttribute('aria-pressed', 'false');
      });
      item.classList.add('active');
      item.setAttribute('aria-pressed', 'true');
      const label = item.querySelector('.label').textContent;
      topbarTitle.textContent = label;
      // Close sidebar on mobile after selection
      if(window.innerWidth <= 900) {
        sidebar.style.display = 'none';
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    });
    item.addEventListener('keydown', e => {
      if(e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        item.click();
      }
    });
  });

  // Initialize view
  updateView();

  // Update sidebar display and expanded state on window resize
  window.addEventListener('resize', () => {
    checkScreenAndSetSidebar();
  });
</script>
</body>
</html>

