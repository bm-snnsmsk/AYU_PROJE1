<?php Router::view('static/header') ; ?> 
<?php 
//Helper::test($_SESSION) ;  

?>
<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">                                              
                    <div class="col col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-900 mb-4">Parola Güncelleme</h1>
                            </div>

                            <form action="" method="POST" id="parolaGuncelleForm">
                               
                                <div class="form-group row">
                                    <label class="col-md-3" for="newpassword">Şifre</label>
                                    <input type="password" name="newpassword" class="form-control form-control-user col-md-9" id="newpassword" placeholder="Şifre">
                                </div>     
                                <div class="form-group row">
                                    <label class="col-md-3" for="newpasswordagain">Şifre Tekrarı</label>
                                    <input type="password" name="newpasswordagain" class="form-control form-control-user col-md-9" id="newpasswordagain" placeholder="Şifre Tekrarı">
                                </div>  
                              
                                <div class="form-group row">
                                <button name="parolaGuncelleFormBtn" id="parolaGuncelleFormBtn" class="btn btn-primary btn-user btn-block">Parola Güncelle<span class="myload"></span></button>
                                </div> 
                                
                                <hr>
                            </form>                                   
                        </div>                          
                    </div>               
                </div>
            </div>
        </div>
    </div>
<script src="<?= Router::assets('vendor/jquery/jquery.min.js') ; ?>"></script>
<script src="<?= Router::assets('vendor/sweetalert2/sweetalert2.all.min.js') ; ?>"></script>
</body>
</html>

<script>
const SITE_URL = '<?= URL ; ?>' ;
$(function(){ //jQuery START 
    //parolaGuncelle formu gönderme START
    let parolaGuncelleForm = document.querySelector('#parolaGuncelleForm') ;
    document.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#parolaGuncelleFormBtn').prop('disabled', true) ;
        let myData = $('form#parolaGuncelleForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=parolaGuncelle',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#parolaGuncelleFormBtn').prop('disabled', false) ;                 
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
    // parolaGuncelle formu gönderme END
}) ;//jQuery END
</script>

