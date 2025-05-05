<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-transparent shadow-sm">
    <a class="navbar-brand text-white font-weight-bold" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="#">Welcome, <?php echo $this->session->userdata('name'); ?></a>
            </li>
        </ul>
    </div>
</nav>
