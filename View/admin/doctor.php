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
                            <h4 class="m-0 font-weight-bold text-primary">Mevcut Doktorlar</h4>
                            <a href="#addDoctorForm" class="btn btn-primary p-2">Yeni Doktor Ekle</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th>Hastane Adı</th>
                                            <th>Poliklinik Adı</th>
                                            <th>Doktor Adı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          
                                            <th>Hastane Adı</th>
                                            <th>Poliklinik Adı</th>
                                            <th>Doktor Adı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>                                       
                                     

                                        <?php   
                                            if(isset($data['doctors'])){                             
                                            foreach($data['doctors'] as $key => $value){
                                        ?>
                                             <tr>
                                               
                                                <th><?= Helper::convertLetter($data['settings']['settingHospitalName'], 'upper') ?></th>
                                                <td><?= Helper::convertLetter($value['poliklinikName'], 'upper') ; ?></td>
                                                <td><?= Helper::convertLetter($value['doctorUnvan'], 'upperWords')." ".Helper::convertLetter($value['doctorName'], 'firstUpper')." ".Helper::convertLetter($value['doctorSurname'], 'upper') ; ?></td>
                                                <td>  
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= Router::url('doctors/delete/'.$value['doctorID'])?>" class="btn btn-danger btn-sm ml-1" >Sil</a>
                                                        <a href="<?= Router::url('doctors/edit/'.$value['doctorID'])?>" class="btn btn-warning btn-sm ml-1" >Güncelle</a>
                                                    </div>
                                                </td>
                                            </tr>
                <?php 
                                            }
                                         }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            
                  
                    <hr class="my-5">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h4 class="m-0 font-weight-bold text-primary">Yeni Doktor Ekle</h4>                   
                    </div>
                   

                    <form action="" method="POST" id="addDoctorForm">                     
                           
                       

                        <div class="form-group row">
                            <label for="hospitalname" class="form-label col-md-4">Hastane Adı</label>
                            <input type="text" class="form-control col-md-8" id="hospitalname" name="hospitalname" value = "<?= Helper::convertLetter($data['settings']['settingHospitalName'], 'upper') ?>" disabled>
                        </div>  
                        
                        <div class="form-group row">
                            <label class="col-md-4" for="poliklinikName">Poliklinik Seç</label>
                            <select class="form-select form-control col-md-8" name="poliklinikName" id="poliklinikName" aria-label="Default select example">
                                <option value="0" selected>Poliklinik Seç</option>  
                                <?php                                        
                                foreach($data['polikliniks'] as $key => $value){  
                                ?>    
                                 <option value="<?= $value['poliklinikID'] ; ?>"><?= Helper::convertLetter($value['poliklinikName'], 'upper') ;   ?></option>  
                                <?php 
                                    } 
                                ?>                     
                            </select>
                        </div> 

                        <div class="form-group row">
                            <label for="doctorUnvan" class="form-label col-md-4">Doktor Unvanı</label>
                            <input type="text" class="form-control col-md-8" id="doctorUnvan" name="doctorUnvan">
                        </div> 
                        <div class="form-group row">
                            <label for="doctorName" class="form-label col-md-4">Doktor Adı</label>
                            <input type="text" class="form-control col-md-8" id="doctorName" name="doctorName">
                        </div> 

                        <div class="form-group row">
                            <label for="doctorSurname" class="form-label col-md-4">Doktor Soyadı</label>
                            <input type="text" class="form-control col-md-8" id="doctorSurname" name="doctorSurname">
                        </div>  

                        
                        <div class="form-group row">
                            <label for="doctorTCNumber" class="form-label col-md-4">Doktor TC Numarası</label>
                            <input type="text" class="form-control col-md-8" id="doctorTCNumber" name="doctorTCNumber">
                        </div>

                        <div class="form-group row">
                            <span class="col-md-4">Cinsiyet </span>
                            <div class="form-group col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="doctorGender" id="female" value="K" checked>
                                    <label class="form-check-label" for="female">Kadın</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="doctorGender" id="male" value="E">
                                    <label class="form-check-label" for="male">Erkek</label>
                                </div>                                   
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4" for="cityName">Doğum Yeri</label>
                            <select class="form-select form-control col-md-4" name="cityName" id="cityName" aria-label="Default select example">
                                <option value="0" selected>İl</option>
                                    <?php                                         
                                        foreach($data['cities'] as $key => $value){
                                    ?>
                                <option value="<?= $value['cityID'] ; ?>"><?= $value['cityName'] ; ?></option>
                                    <?php 
                                            } 
                                    ?>
                                    </select>                                    
                                    <select class="form-select form-control col-md-4" name="townName" id="townName" aria-label="Default select example">
                                        <option value="0" selected>İlçe</option>                                       
                                    </select>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-4" for="birthday">Doğum Tarihi</label>
                                    <input type="date" name="birthday" class="form-control form-control-user col-md-4"
                                        id="birthday" placeholder="Doğum Tarihi">
                        </div> 

                        <div class="form-group row">
                            <label for="doctorPhoneNumber" class="form-label col-md-4">Doktor Telefon Numarası</label>
                            <input type="text" class="form-control col-md-8" id="doctorPhoneNumber" name="doctorPhoneNumber">
                        </div>

                        <div class="form-group row ">
                              <button name="addDoctor" id="addDoctorBtn" class="btn btn-primary btn-user btn-block col-md-8 offset-4">Doktor Ekle<span class="myload"></span></button>
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

      // birthday il ilçe START
      $('#cityName').change(function(){         
        let cityID = $(this).val() ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=getTowns',
            data:{'cityID':cityID},
            dataType :'text',
            success:function(resultData){   
                //alert(resultData) ;       
                $("#townName").html(resultData) ;
            }
        });       
    }) ;
    // birthday il ilçe START

    // addDoctor START
    let addDoctor = document.querySelector('#addDoctorForm') ;
    addDoctor.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#addDoctorBtn').prop('disabled', true) ;
        let myData = $('form#addDoctorForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=addDoctor',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#addDoctorBtn').prop('disabled', false) ; 
                
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
    // addDoctor END */



}) ;//jQuery END



</script>

