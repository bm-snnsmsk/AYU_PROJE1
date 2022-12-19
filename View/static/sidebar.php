       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Router::url("patients") ; ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><?= $_SESSION['patientName'] ?? NULL ; ?></div>
        </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Hastane Randevu Sistemi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">







    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= Router::url('randevual') ; ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Randevu Al</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= Router::url('profilepatient') ; ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Profil</span></a>
    </li>

  
    <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Güvenli Çıkış
            </a>
    </li>

 

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
