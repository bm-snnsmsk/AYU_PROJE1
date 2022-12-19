<?php
 //Helper::test($data) ; 

 Router::view('static/header') ; 
  //Helper::test($_SESSION) ;
?>
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php Router::view('static/admin_sidebar') ;  ?>
 
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php Router::view('static/navbar') ; ?> 
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Admin Paneli</h1>                       
                    </div>

                   
                    <div class="row">
                    
                    
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a class="nav-link" href="<?= Router::url('polikliniks') ; ?>">Poliklinikler</a>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Poliklinik sayısı : <?= $data['toplam_poliklinik'] ; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas-solid fa-user-doctor"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a class="nav-link" href="<?= Router::url('polikliniks') ; ?>">Doktorlar</a>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Doktor mevcudu : <?= $data['toplam_doctor'] ; ?></div>
                                        </div>
                                        <div class="col-auto">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                  
                    </div>

                 


                 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

    <?php    

  Router::view('static/footer') ; 






?>