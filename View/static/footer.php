
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Ahmet Yesevi Üniversitesi - Proje1 Dersi - Hastane Randevu Sistemi 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkmak istediğinizden emin misiniz?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Oturumunuzu kapatmak için 'Çık' butonuna basınız</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Menüye Geri Dön</button>
                    <a class="btn btn-primary" href="<?php echo Router::url('logout'); ?>">Çık</a>
                </div>
            </div>
        </div>
    </div>

   
    <script src="<?= Router::assets('vendor/jquery/jquery.min.js') ; ?>"></script>
    <script src="<?= Router::assets('vendor/bootstrap/js/bootstrap.bundle.min.js') ; ?>"></script>
    <script src="<?= Router::assets('vendor/jquery-easing/jquery.easing.min.js') ; ?>"></script>
    <script src="<?= Router::assets('js/sb-admin-2.min.js') ; ?>"></script>
    <script src="<?= Router::assets('vendor/chart.js/Chart.min.js') ; ?>"></script>
    <script src="<?= Router::assets('js/demo/chart-area-demo.js') ; ?>"></script>
    <script src="<?= Router::assets('js/demo/chart-pie-demo.js') ; ?>"></script>
    <script src="<?= Router::assets('vendor/sweetalert2/sweetalert2.all.min.js') ; ?>"></script>
</body>

</html>


