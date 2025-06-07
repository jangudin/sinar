</div><!-- /.right_col -->
        
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted">
                            &copy; <?= date('Y') ?> SINAR - Sistem Informasi Akreditasi
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p class="text-muted">
                            Version 2.0 | Kementerian Kesehatan RI
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Core Scripts -->
        <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

        <script>
            $(document).ready(function() {
                // Initialize Tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });

                // Initialize Popovers
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl)
                });

                // Auto hide alerts
                $('.alert').delay(4000).fadeOut(350);

                // Active menu highlighting
                const currentPath = window.location.pathname;
                $('.nav-link').each(function() {
                    if ($(this).attr('href') === currentPath) {
                        $(this).addClass('active');
                    }
                });

                // Initialize DataTables if present
                if ($.fn.DataTable) {
                    $('.datatable').DataTable({
                        responsive: true,
                        language: {
                            search: "Cari:",
                            lengthMenu: "Tampilkan _MENU_ data",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                            infoFiltered: "(disaring dari _MAX_ total data)",
                            paginate: {
                                first: "Pertama",
                                last: "Terakhir",
                                next: "Selanjutnya",
                                previous: "Sebelumnya"
                            }
                        }
                    });
                }

                // Progress bar animation
                $('.progress-bar').each(function() {
                    const width = $(this).attr('aria-valuenow') + '%';
                    $(this).css('width', width);
                });
            });
        </script>
    </body>
</html>