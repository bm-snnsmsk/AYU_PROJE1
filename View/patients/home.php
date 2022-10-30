<?php Helper::view('static/header') ; ?> 
<?php  //Helper::test($data) ; ?>
<?php  //Helper::test($_SESSION) ; ?>
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php Helper::view('static/sidebar') ; ?> 
 
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                   

                    <?php 
                      $profil = $_SESSION['patientPhoto'] ?? NULL ; 
                      $name = $_SESSION['patientName'] ?? '' ;
                      $surname = $_SESSION['patientSurname'] ?? '' ;
                    ?>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Helper::convertLetter(($name.' '.$surname),'upper') ; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= Helper::assets('img/profile/'.$profil)  ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= Helper::url('profile') ; ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="<?= Helper::url('settings') ; ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ayarlar
                                </a>
                              
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Güvenli Çıkış
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Randevularım</h1>                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">

<?php 
foreach($data['randevu'] as $key => $value){
?>


                                <div class="card-header">
                                    <h5 class="card-title"> <?= $value['randevuHospital'] ; ?></h5>
                                </div>                                
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">

                                    <!-- randevular START -->
                                        <div class="col-sm-3">
                                            <div class="card bg-info text-white shadow p-3">
                                            <?= $value['randevuDate'] ; ?> <?= $value['randevuHour'] ; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-3"> 
                                            <div class="card bg-info text-white shadow p-3">
                                               <?= $value['randevuBolum'] ; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-3"> 
                                            <div class="card bg-info text-white shadow p-3">
                                            <?= $value['randevuDoctor'] ; ?>
                                            </div>
                                        </div> 

                                        <div class="col-sm-3 d-flex justify-content-center justify-content-sm-end"> 
                                           <a class="btn btn-danger btn-lg" href="<?= Helper::url('randevuiptal') ; ?>"> Randevu İptal</a>  
                                        </div>                                          
                                 <!-- randevular END -->
                                    </div>
                                </div>
                                <?php  } ?>   
                            </div>
                        </div>

                      
                    <!-- Content Row -->
                    </div>

                 


                 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        

    <?php Helper::view('static/footer') ; ?> 



