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
                                            foreach($data['cities_hospitals'] as $key => $value){
                                        ?>
                                             <tr>
                                                <td><?= $value['cityName'] ; ?></td>
                                                <td><?= $value['hospitalName'] ; ?></td>
                                                <td>  
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= Router::url('hospitals/delete/'.$value['hospitalID'])?>" class="btn btn-danger btn-sm ml-1" >Sil</a>
                                                        <a href="<?= Router::url('hospitals/edit/'.$value['hospitalID'])?>" class="btn btn-warning btn-sm ml-1" >Güncelle</a>
                                                    </div>
                                                </td>
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
                    <h4 class="m-0 font-weight-bold text-primary">Yeni Poliklinik Ekle</h4>                   
                    </div>
                   

                    <form action="" method="POST" id="addPoliklinikForm">
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
<script src="<?= Router::assets('vendor/datatables/jquery.dataTables.min.js') ; ?>"></script>
<script src="<?= Router::assets('vendor/datatables/dataTables.bootstrap4.min.js') ; ?>"></script>
<script src="<?= Router::assets('js/demo/datatables-demo.js') ; ?>"></script>


<script>
const SITE_URL = '<?= URL ; ?>' ;
$(function(){ //jQuery START    

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

