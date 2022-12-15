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

                
                 
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h4 class="m-0 font-weight-bold text-primary">Site Ayarları</h4>
                        </div>
                   
                                                                 
                                         
                        
                          
            
                  
                    <form action="" method="POST" id="editSettingForm">                     
                           <div class="form-group row">
                            <label for="authorName" class="form-label col-md-4">Yazar Adı</label>
                            <input type="text" class="form-control col-md-8" id="authorName" name="authorName" value="<?= $data['settingAuthor'] ; ?>" disabled>
                        </div> 
                       
                        <div class="form-group row">
                            <label for="pageHospitalName" class="form-label col-md-4">Hastane Adı</label>
                            <input type="text" class="form-control col-md-8" id="pageHospitalName" name="pageHospitalName" value="<?= $data['settingHospitalName'] ; ?>">
                        </div>  

                        <div class="form-group row">
                            <label for="pageTitle" class="form-label col-md-4">Başlık Bilgisi</label>
                            <input type="text" class="form-control col-md-8" id="pageTitle" name="pageTitle" value="<?= $data['settingTitle'] ; ?>">
                        </div>  

                        <div class="form-group row">
                            <label for="pageDescription" class="form-label col-md-4">Site Açıklama</label>
                            <input type="text" class="form-control col-md-8" id="pageDescription" name="pageDescription" value="<?= $data['settingDescription'] ; ?>" >
                        </div>  
                        <div class="form-group row">
                            <label for="pageKeyword" class="form-label col-md-4">Site Anahtar Kelimeler</label>
                            <input type="text" class="form-control col-md-8" id="pageKeyword" name="pageKeyword" value="<?= $data['settingKeyword'] ; ?>" >
                        </div>  
                        
                     
                      
                        <div class="form-group row">
                            <label for="pageUrl" class="form-label col-md-4">Site Url Adresi</label>
                            <input type="text" class="form-control col-md-8" id="pageUrl" name="pageUrl" value="<?= $data['settingUrl'] ; ?>">
                        </div> 
                     
                        <div class="form-group row">
                            <label for="pageHosting" class="form-label col-md-4">Site Host Adresi</label>
                            <input type="text" class="form-control col-md-8" id="pageHosting" name="pageHosting" value="<?= $data['settingHost'] ; ?>">
                        </div> 

                       
                        <div class="form-group row ">
                              <button name="editSettingBtn" id="editSettingBtn" class="btn btn-primary btn-user btn-block col-md-8 offset-4">Site Ayarlarını Düzenle<span class="myload"></span></button>
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

    // editSetting START
    let editSetting = document.querySelector('#editSettingForm') ;
    editSetting.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#editSettingBtn').prop('disabled', true) ;
        let myData = $('form#editSettingForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=editSetting',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#editSettingBtn').prop('disabled', false) ; 
                
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
    // editSetting END */



}) ;//jQuery END



</script>


