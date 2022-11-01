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
                    <h4 class="m-0 font-weight-bold text-primary">Hastane Düzenle</h4>                   
                    </div>
                   

                    <form action="" method="POST" id="editHospitalForm">
                        <div class="form-group row">
                            <label class="col-md-4" for="cityHospital">Şehir Seç</label>
                            <select class="form-select form-control col-md-8" name="cityHospital" id="cityHospital" aria-label="Default select example">
                                <option value="0" selected>İl</option>
                                <?php                                         
                                    foreach($data['cities'] as $key => $value){
                                ?>
                                <option value="<?= $value['cityID'] ; ?>" <?= $data['cities_hospitals']['cityID'] == $value['cityID'] ? 'selected' : NULL ; ?> ><?= $value['cityName'] ; ?></option>
                                <?php 
                                    } 
                                ?>
                            </select>
                        </div> 
                           
                        <div class="form-group row">
                            <label for="hospitalname" class="form-label col-md-4">Hastane Adı</label>
                            <input type="text" class="form-control col-md-8" id="hospitalname" name="hospitalname" aria-describedby="emailHelp" value="<?= $data['cities_hospitals']['hospitalName'] ; ?>">
                        </div>                 

                        <div class="form-group row ">
                              <button name="editHospital" id="editHospitalBtn" class="btn btn-primary btn-user btn-block col-md-8 offset-4">Hastane Düzenle<span class="myload"></span></button>
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
<script src="<?= Router::assets('vendor/datatables/jquery.dataTables.min.js') ; ?>"></script>
<script src="<?= Router::assets('vendor/datatables/dataTables.bootstrap4.min.js') ; ?>"></script>
<script src="<?= Router::assets('js/demo/datatables-demo.js') ; ?>"></script>


<script>
const SITE_URL = '<?= URL ; ?>' ;
$(function(){ //jQuery START

    // editHospitalForm START
    let editHospital = document.querySelector('#editHospitalForm') ;
    editHospital.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#editHospitalBtn').prop('disabled', true) ;
        let cityID = $('#cityHospital').val() ; 
        let hospitalname = $('#hospitalname').val() ; 
        let editID = <?= $data['cities_hospitals']['hospitalID'] ?> ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=editHospital',
            data:{cityID:cityID, hospitalname:hospitalname, editID:editID},
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#editHospitalBtn').prop('disabled', false) ; 
                
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
    // editHospital END */



}) ;//jQuery END



</script>

