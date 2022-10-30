<?php

 Helper::view('static/header') ; 
 // Helper::test($data) ; 
 //Helper::test($_SESSION) ;
?>
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php Helper::view('static/admin_sidebar') ;  ?>
 
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
                      $profil = $_SESSION['adminPhoto'] ?? NULL ; 
                      $name = $_SESSION['adminName'] ?? '' ;
                      $surname = $_SESSION['adminSurname'] ?? '' ;
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

                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h4 class="m-0 font-weight-bold text-primary">Mevcut Hastaneler</h4>
                            <a href="#addHospitalForm" class="btn btn-primary p-2">Yeni Hastane Ekle</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Şehir</th>
                                            <th>Hastane Adı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Şehir</th>
                                            <th>Hastane Adı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>                                       
                                     

                                        <?php                                         
                                            foreach($data['hospitals'] as $key => $value){
                                        ?>
                                             <tr>
                                            <td>Donna Snider</td>
                                            <td><?= $value['hospitalName'] ; ?></td>
                                            <td>New York</td>
                                            
                                        </tr>


                                        <?php 
                                            } 
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            
                  
                    <hr class="my-5">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h4 class="m-0 font-weight-bold text-primary">Yeni Hastane Ekle</h4>                   
                    </div>
                   

                    <form action="" method="POST" id="addHospitalForm">
                        <div class="form-group row">
                            <label class="col-md-4" for="cityHospital">Şehir Seç</label>
                            <select class="form-select form-control col-md-8" name="cityHospital" id="cityHospital" aria-label="Default select example">
                                <option value="0" selected>İl</option>
                                <?php                                         
                                    foreach($data['cities'] as $key => $value){
                                ?>
                                <option value="<?= $value['cityID'] ; ?>"><?= $value['cityName'] ; ?></option>
                                <?php 
                                    } 
                                ?>
                            </select>
                        </div> 
                           
                        <div class="form-group row">
                            <label for="hospitalname" class="form-label col-md-4">Hastane Adı</label>
                            <input type="text" class="form-control col-md-8" id="hospitalname" name="hospitalname" aria-describedby="emailHelp">
                        </div>                 

                        <div class="form-group row ">
                              <button name="addHospital" id="addHospitalBtn" class="btn btn-primary btn-user btn-block col-md-8 offset-4">Hastane Ekle<span class="myload"></span></button>
                        </div> 
                    </form> 

                </div>
                <!-- /.container-fluid -->
                
            </div>
            <!-- End of Main Content -->

    <?php    

  Helper::view('static/footer') ;   
?>
<script src="<?= Helper::assets('vendor/datatables/jquery.dataTables.min.js') ; ?>"></script>
<script src="<?= Helper::assets('vendor/datatables/dataTables.bootstrap4.min.js') ; ?>"></script>
<script src="<?= Helper::assets('js/demo/datatables-demo.js') ; ?>"></script>


<script>
const SITE_URL = '<?= URL ; ?>' ;
$(function(){ //jQuery START
     //hospitals START
     $('#cityHospital').change(function(){         
        let cityID = $(this).val() ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=listHospital',
            data:{'cityID':cityID},
            dataType :'text',
            success:function(resultData){   
                //alert(resultData) ;       
                $("#hospitals").html(resultData) ;
            }
        });       
    }) ;
    //hospitals START

    // addHospital START
    let addHospital = document.querySelector('#addHospitalForm') ;
    addHospital.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#addHospitalBtn').prop('disabled', true) ;
        let myData = $('form#addHospitalForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=addHospital',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#addHospitalBtn').prop('disabled', false) ; 
                
                if(resultData.redirect){
                    window.location.href = resultData.redirect ;
                }else{
                    Swal.fire({
                        icon : resultData.icon,
                        title : resultData.title,
                        text : resultData.text
                    }) ;
                }  

         



            }
        }) ;
    }) ;
    // addHospital END */



}) ;//jQuery END



</script>

