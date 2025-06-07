        </div><!-- /.right_col -->
        
        <footer class="footer mt-auto py-3">
            <div class="container">
                <div class="text-center">
                    <span class="text-muted">© <?= date('Y') ?> SINAR - Sistem Informasi Akreditasi. All rights reserved.</span>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="<?= base_url('assets/temp/js/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/temp/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js') ?>"></script>
        
        <script>
            // Initialize DataTables
            $(document).ready(function() {
                $('.datatable').DataTable();
                
                // Enable tooltips
                $('[data-toggle="tooltip"]').tooltip();
                
                // Enable popovers
                $('[data-toggle="popover"]').popover();
                
                // Auto-hide alerts
                $('.alert').delay(4000).fadeOut(350);
            });
        </script>

    </body>
</html>