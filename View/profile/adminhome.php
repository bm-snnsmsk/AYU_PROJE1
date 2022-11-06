<?php Router::view('static/header') ; ?> 
<?php  //Helper::test($data) ; ?>
<?php  
//Helper::test($_SESSION) ; 
?>

    <!-- Page Wrapper -->
<div id="wrapper">
    <?php Router::view('static/admin_sidebar') ; ?>
 
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
                    <div class="d-sm-flex align-items-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profil Bilgileriniz</h1>                       
                    </div>

                    <hr>            
                    <div class="row"> <!-- Content Row -->
                        <div class="col-sm-6">
                        <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Bilgilerini Güncelle</h1>
                        </div>
                        <form action="" method="POST" id="profileEditForm" class="">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="tcnumber">TC Kimlik Numarası</label>
                                        <input type="text" name="tcnumber" class="form-control form-control-user col-md-9" id="tcnumber" value="<?= $data['admin']['adminTCNumber'] ?? NULL ;?>" disabled>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3" for="name">Adı</label>
                                        <input type="text" name="name" class="form-control form-control-user col-md-9" id="name" aria-describedby="name" value="<?= Helper::convertLetter($data['admin']['adminName'],'firstUpper') ?? NULL ;?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3" for="surname">Soyadı</label>
                                        <input type="text" name="surname" class="form-control form-control-user col-md-9" id="surname" value="<?= Helper::convertLetter($data['admin']['adminSurname'],'upper') ?? NULL ;?>">
                                    </div>                                  
                                    <div class="form-group row">
                                        <span class="col-md-3">Cinsiyet </span>
                                        <div class="form-group col-md-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="adminGender" id="female" value="K" <?= ($data['admin']['adminGender'] == 'K') ? 'checked' : NULL ;?> disabled>
                                                <label class="form-check-label" for="female">Kadın</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="adminGender" id="male" value="E" <?= ($data['admin']['adminGender'] == 'E') ? 'checked' : NULL ;?> disabled>
                                                <label class="form-check-label" for="male">Erkek</label>
                                            </div>                                   
                                        </div>
                                    </div>                                  
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3" for="birthday">Doğum Tarihi</label>
                                        <input type="date" name="birthday" class="form-control form-control-user col-md-3" disabled id="birthday" value="<?= $data['admin']['adminBirthday'] ?? NULL ;?>">
                                    </div> 
                                  
                                    

                                    <div class="form-group row">
                                    <button name="profileEditBtn" id="profileEditBtn" class="btn btn-primary btn-user btn-block">Profil Bilgilerini Düzenle<span class="myload"></span></button>
                                    </div> 
                                    
                                    <hr>
                        </form>                        
                        </div>

                        <div class="col-sm-6">
                        <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Parolanı Güncelle</h1>
                        </div>
                       <form action="" method="POST" id="passwordEditForm" class="">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="expassword">Mevcut Şifre</label>
                                        <input type="password" name="expassword" class="form-control form-control-user col-md-9" id="expassword" >
                                    </div>     
                                
                                    <div class="form-group row">
                                        <label class="col-md-3" for="newpassword">Yeni Şifre</label>
                                        <input type="password" name="newpassword" class="form-control form-control-user col-md-9" id="newpassword" >
                                    </div>     
                                    <div class="form-group row">
                                        <label class="col-md-3" for="newpasswordagain">Yeni Şifre Tekrarı</label>
                                        <input type="password" name="newpasswordagain" class="form-control form-control-user col-md-9" id="newpasswordagain">
                                    </div>  

                                    <div class="form-group row">
                                    <button name="passwordEditBtn" id="passwordEditBtn" class="btn btn-primary btn-user btn-block">Parolanı Güncelle<span class="myloadPass"></span></button>
                                    </div> 
                                    
                                    <hr>
                        </form>                       
                        </div>
                    </div> <!-- Content Row -->

                 


                   
            </div><!-- /.container-fluid -->
        </div><!-- End of Main Content -->

        

<?php Router::view('static/footer') ; ?> 

<script>    
const SITE_URL = '<?= URL ; ?>' ;

$(function(){ //jQuery START
    

    // profileEditForm formu gönderme START
    let profileEditForm = document.querySelector('#profileEditForm') ;
    profileEditForm.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#profileEditBtn').prop('disabled', true) ;
        let myData = $('form#profileEditForm').serialize() ; 
        //alert(myData) ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=adminEditProfile',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#profileEditBtn').prop('disabled', false) ; 
                
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
    // profileEditForm formu gönderme END


    // passwordEditForm formu gönderme START
    let passwordEditForm = document.querySelector('#passwordEditForm') ;
    passwordEditForm.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myloadPass").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#passwordEditBtn').prop('disabled', true) ;
        let myData = $('form#passwordEditForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=adminEditPassword',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myloadPass").html('') ;
                $('#passwordEditBtn').prop('disabled', false) ; 
                
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
    // passwordEditForm formu gönderme END

}) ;//jQuery END


</script>


