<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>



<?php 
    if(isset($_SESSION['patientPhoto'])){
        $profil = $_SESSION['patientPhoto'] ;
    }else if(isset($_SESSION['adminPhoto'])){
        $profil = $_SESSION['adminPhoto'] ;
    }else{
        $profil = '' ;
    }

    if(isset($_SESSION['patientName'])){
        $name = $_SESSION['patientName'] ;
    }else if(isset($_SESSION['adminName'])){
        $name = $_SESSION['adminName'] ;
    }else{
        $name = '' ;
    }

    if(isset($_SESSION['patientSurname'])){
        $surname = $_SESSION['patientSurname'] ;
    }else if(isset($_SESSION['adminSurname'])){
        $surname = $_SESSION['adminSurname'] ; 
    }else{
        $surname = '' ;
    }

?>
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item"> 
        <a class="nav-link" href="<?= Router::url('patients') ; ?>">
            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>Anasayfa
        </a>
    </li>
    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Helper::convertLetter(($name.' '.$surname),'upper') ; ?></span>
            <img class="img-profile rounded-circle"
                src="<?= Router::assets('img/profile/'.$profil)  ?>">
        </a>
        <!-- Dropdown - User Information -->     

        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">      
           
          
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Güvenli Çıkış
            </a>
        </div>
    </li>

</ul>

</nav>