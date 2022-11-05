<?php Router::view('static/header') ; ?> 
<?php  //Helper::test($data) ; ?>
<?php  //Helper::test($_SESSION) ; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php Router::view('static/sidebar') ; ?> 
 
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
                        <h1 class="h3 mb-0 text-gray-800">Randevularım</h1>                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">

<?php 
if(count($data) == 0){
    echo "<h1>Randevunuz bulunmamaktadır.</h1>" ; 
}
foreach($data as $key => $value){
?>


                                <div class="card-header">
                                    <h5 class="card-title"> <?= $value['randevuHospital'] ; ?></h5> 
                                </div>                                
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">

                                    <!-- randevular START -->
                                        <div class="col-sm-3">
                                            <div class="card bg-info text-white shadow p-3">
                                            <?= Helper::dateConvert($value['randevuDate'])." - ".Helper::convertLetter($value['randevuDay'], 'upper') ;  ?> <?= Helper::setTime($value['randevuHour']) ; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-3"> 
                                            <div class="card bg-info text-white shadow p-3">
                                               <?= $value['poliklinikName'] ; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-3"> 
                                            <div class="card bg-info text-white shadow p-3">
                                            <?= Helper::convertLetter($value['doctorName'], 'firstUpper')." ".Helper::convertLetter($value['doctorSurname'], 'upper') ; ?>
                                            </div>
                                        </div> 

                                        <div class="col-sm-3 d-flex justify-content-center justify-content-sm-end"> 
                                           <a class="btn btn-danger btn-lg" href="<?= Router::url('randevuiptal/'.$value['randevuID']) ; ?>"> Randevu İptal</a>  
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

        

    <?php Router::view('static/footer') ; ?> 



