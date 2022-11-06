<?php Router::view('static/header') ; ?> 
<?php 
/* Helper::test($data) ;  */

?>
<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">                                              
                    <div class="col col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-900 mb-4">Parolanızı Sıfırlamak İçin Lütfen Bilgilerinizi Doğru Giriniz</h1>
                            </div>

                            <form action="" method="POST" id="forgetpasswordForm">
                                <div class="form-group row">
                                    <label class="col-md-3" for="tcnumber">TC Kimlik Numarası</label>
                                    <input type="text" name="tcnumber" class="form-control form-control-user col-md-9"
                                        id="tcnumber" aria-describedby="tcnumber"
                                        placeholder="TC Kimlik Numarası">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Adı</label>
                                    <input type="text" name="name" class="form-control form-control-user col-md-9"
                                        id="name" aria-describedby="name"
                                        placeholder="Adı">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="surname">Soyadı</label>
                                    <input type="text" name="surname" class="form-control form-control-user col-md-9"
                                        id="surname" aria-describedby="surname"
                                        placeholder="Soyadı">
                                </div>
                              
                                <div class="form-group row">
                                    <span class="col-md-3">Cinsiyet </span>
                                    <div class="form-group col-md-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="patientGender" id="female" value="K" checked>
                                            <label class="form-check-label" for="female">Kadın</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="patientGender" id="male" value="E">
                                            <label class="form-check-label" for="male">Erkek</label>
                                        </div>                                   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="cityName">Doğum Yeri</label>
                                    <select class="form-select form-control col-md-4" name="cityName" id="cityName" aria-label="Default select example">
                                            <option value="0" selected>İl</option>
                                        <?php                                         
                                            foreach($data as $key => $value){
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
                                    <label class="col-md-3" for="birthday">Doğum Tarihi</label>
                                    <input type="date" name="birthday" class="form-control form-control-user col-md-3"
                                        id="birthday" placeholder="Doğum Tarihi">
                                </div> 
                             
                               
                             

                                <div class="form-group row">
                                <button name="forgetpasswordBtn" id="forgetpasswordBtn" class="btn btn-primary btn-user btn-block">Parolayı Sıfırla<span class="myload"></span></button>
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

  

    // forgetpassword formu gönderme START
    let forgetpasswordForm = document.querySelector('#forgetpasswordForm') ;
    document.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#forgetpasswordBtn').prop('disabled', true) ;
        let myData = $('form#forgetpasswordForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=parolaSifirla',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#forgetpasswordBtn').prop('disabled', false) ; 
                
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
    //forgetpassword formu gönderme END



}) ;//jQuery END



</script>

