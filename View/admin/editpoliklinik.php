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
                    <h4 class="m-0 font-weight-bold text-primary">Poliklinik Düzenle</h4>                   
                    </div>
                   

                    <form action="" method="POST" id="editPoliklinikForm">                       
                    
                        <div class="form-group row">
                            <label for="poliklinikname" class="form-label col-md-4">Poliklinik Adı</label>
                            <input type="text" class="form-control col-md-8" id="poliklinikname" name="poliklinikname" aria-describedby="emailHelp" value="<?= $data['poliklinikName'] ; ?>">
                        </div>                           
                             
                        <div class="form-group row ">
                              <button name="editPoliklinik" id="editPoliklinikBtn" class="btn btn-primary btn-user btn-block col-md-8 offset-4">Poliklinik Düzenle<span class="myload"></span></button>
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

    // editPoliklinikForm START
    let editPoliklinik = document.querySelector('#editPoliklinikForm') ;
    editPoliklinik.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#editPoliklinikBtn').prop('disabled', true) ;
        let poliklinikname = $('#poliklinikname').val() ; 
        let editID = <?= $data['poliklinikID'] ?> ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=editPoliklinik',
            data:{poliklinikname:poliklinikname, editID:editID},
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#editPoliklinikBtn').prop('disabled', false) ; 
                
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
    // editPoliklinik END */



}) ;//jQuery END



</script>

