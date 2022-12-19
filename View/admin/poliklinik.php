<?php

 Router::view('static/header') ; 
//Helper::test($data) ; 
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

                 <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h4 class="m-0 font-weight-bold text-primary">Mevcut Poliklinikler</h4>
                            <a href="#addPoliklinikForm" class="btn btn-primary p-2">Yeni Poliklinik Ekle</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Hastane Adı</th>
                                            <th>Poliklinik Adı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Hastane Adı</th>
                                            <th>Poliklinik Adı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>                                      
                                     
                                    <?php foreach($data['poliklinik'] as $key => $value){  ?>
                                        <tr>
                                            <th> <?= Helper::convertLetter($data['settings']['settingHospitalName'], 'upper') ?> </th>
                                            <td>  <?= Helper::convertLetter($value['poliklinikName'], 'upper') ?></td>
                                            <td>  
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?= Router::url('polikliniks/delete/'.$value['poliklinikID'])?>" class="btn btn-danger btn-sm ml-1" >Sil</a>
                                                    <a href="<?= Router::url('polikliniks/edit/'.$value['poliklinikID'])?>" class="btn btn-warning btn-sm ml-1" >Güncelle</a>
                                                </div></td>
                                        </tr>
                                    <?php  } ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            
                  
                  


                    <hr class="my-5">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h4 class="m-0 font-weight-bold text-primary">Yeni Poliklinik Ekle</h4>                   
                </div>
                   

                    <form action="" method="POST" id="addPoliklinikForm">
                       
                        <div class="form-group row">
                            <label for="poliklinikname" class="form-label col-md-4">Poliklinik Adı</label>
                            <input type="text" class="form-control col-md-8" id="poliklinikname" name="poliklinikname">
                        </div>     
                        
                       

                        <div class="form-group row ">
                              <button name="addPoliklinik" id="addPoliklinikBtn" class="btn btn-primary btn-user btn-block col-md-8 offset-4">Poliklinik Ekle<span class="myload"></span></button>
                        </div> 
                    </form> 




                </div>
                <!-- /.container-fluid -->
                
            </div>
            <!-- End of Main Content -->

    <?php    

  Router::view('static/footer') ;   
?>



<script>
const SITE_URL = '<?= URL ; ?>' ;
$(function(){ //jQuery START    

    // addPoliklinik START
    let addPoliklinik = document.querySelector('#addPoliklinikForm') ;
    addPoliklinik.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#addPoliklinikBtn').prop('disabled', true) ;
        let myData = $('form#addPoliklinikForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=addPoliklinik',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#addPoliklinikBtn').prop('disabled', false) ; 
                console.log(resultData) ;
                
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

