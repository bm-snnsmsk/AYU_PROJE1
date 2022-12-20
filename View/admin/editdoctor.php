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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h4 class="m-0 font-weight-bold text-primary">Doktor Düzenle</h4>                   
                    </div>
                   

                    <form action="" method="POST" id="editDoctorForm">                       
                    
                    <div class="form-group row">
                            <label class="col-md-4" for="poliklinikName">Poliklinik Seç</label>
                            <select class="form-select form-control col-md-8" name="poliklinikName" id="poliklinikName" aria-label="Default select example" disabled>
                                <option value="0">Poliklinik Seç</option>  
                                <?php                                        
                                foreach($data['polikliniks'] as $key => $value){  
                                ?>    
                                 <option value="<?= $value['poliklinikID'] ; ?>" <?= $value['poliklinikID'] == $data['doctor'][0]['doctorPoliklinikID'] ? 'selected' : NULL ; ?> ><?= $value['poliklinikName'] ; ?></option>  
                                <?php 
                                    } 
                                ?>                     
                            </select>
                        </div>                         
                        <div class="form-group row">
                            <label for="doctorName" class="form-label col-md-4">Doctor Adı</label>
                            <input type="text" class="form-control col-md-8" id="doctorName" name="doctorName" value="<?= $data['doctor'][0]['doctorName'] ; ?>">
                        </div>   
                        <div class="form-group row">
                            <label for="doctorSurname" class="form-label col-md-4">Doctor Soyadı</label>
                            <input type="text" class="form-control col-md-8" id="doctorSurname" name="doctorSurname" value="<?= $data['doctor'][0]['doctorSurname'] ; ?>">
                        </div>     
                        <div class="form-group row ">
                              <button name="editDoctor" id="editDoctorBtn" class="btn btn-primary btn-user btn-block col-md-8 offset-4">Doktor Düzenle<span class="myload"></span></button>
                        </div> 

                    </form> 
                   <hr class="my-5">
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

    // editDoctorForm START
    let editDoctorForm = document.querySelector('#editDoctorForm') ;
    editDoctorForm.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#editDoctorBtn').prop('disabled', true) ;
        let poliklinikname = $('#poliklinikName').val() ; 
        let doctorName = $('#doctorName').val() ; 
        let doctorSurname = $('#doctorSurname').val() ; 
        let editID = <?= $data['doctor'][0]['doctorID'] ?> ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=editDoctor',
            data:{poliklinikname:poliklinikname, doctorName:doctorName, doctorSurname:doctorSurname, editID:editID},
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#editDoctorBtn').prop('disabled', false) ; 
                console.log('Sonuç : '+ resultData);
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
    // editDoctorForm END */



}) ;//jQuery END



</script>

