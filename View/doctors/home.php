<?php Router::view('static/header') ; ?> 
<?php  //Helper::test($data) ; ?>
<?php  //Helper::test($_SESSION) ; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php Router::view('static/doctor_sidebar') ; ?> 
 
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
                        <h1 class="h3 mb-0 text-gray-800">Randevular</h1>                       
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-12 mb-4">
                        

                                       

                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Tarih</th>
                                    <th scope="col">Gün</th>
                                    <th scope="col">Seans</th>
                                    <th scope="col">Hasta Adı Soyadı</th>
                                    <th scope="col">Cinsiyet</th>
                                    <th scope="col">Yaş</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($data as $key => $value){
                                            $randevu_date = date_create($value["randevuDate"]);
                                            $h = str_split($value["randevuHour"]) ;
                                            $randevu_hour = $h[0].$h[1].":".$h[2].$h[3];
                                    ?>
                                    <tr>
                                    <th scope="row"><?=  date_format($randevu_date, "d-m-Y") ; ?></th>
                                    <th scope="row"><?=  $value["randevuDay"] ; ?></th>
                                    <th scope="row"><?=  $randevu_hour ; ?></th>
                                    <td><?=  Helper::convertLetter($value["patientName"],'firstUpper')." ".Helper::convertLetter($value["patientSurname"],'upper') ; ?></td>
                                    <td><?=  $value["patientGender"] ; ?></td>
                                    <td><?=  $value["patientAge"] ; ?></td>
                                    </tr>


                                    <?php  } ?>  
                                </tbody>
                                </table>


                              
                            
                               
                                
                            
                          
                        </div>

                      
                    <!-- Content Row -->
                    </div>

                 


                 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        

    <?php Router::view('static/footer') ; ?> 



