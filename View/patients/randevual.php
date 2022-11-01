<?php Router::view('static/header') ; ?> 
<?php  //Helper::test($data) ; ?>
<?php  //Helper::test($_SESSION) ; ?>
   

   
 
 

<!-- Main Content -->
<div id="content">

                <!-- Topbar -->
                <?php Router::view('static/navbar') ; ?> 
                <!-- End of Topbar -->

               

                  
     <div class="container">
        <div class="row justify-content-center col-md-12">          
                <div class="card-body  p-0">                                              
                   
                        <div class="p-5 ">
                            <div class="text-center">
                                <h1 class="h4 text-900 mb-4">Randevu Al</h1>
                            </div>

                            <form action="" method="POST" id="randevualForm">
                              
                            
                             
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
                                    <label class="col-md-4" for="hospitals">Hastane Seç</label>
                                    <select class="form-select form-control col-md-8" name="hospitals" id="hospitals" aria-label="Default select example">
                                        <option value="0" selected>Hastane</option>                                       
                                    </select>                                   
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-4" for="poliklinik">Poliklinik Seç</label>
                                    <select class="form-select form-control col-md-8" name="poliklinik" id="poliklinik" aria-label="Default select example">
                                        <option value="0" selected>Poliklinikler</option>
                                    </select>                                   
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-4" for="doctors">Doktor Seç</label>
                                    <select class="form-select form-control col-md-8" name="doctors" id="doctors" aria-label="Default select example">
                                        <option value="0" selected>Doktor Seç</option>
                                    </select>                                   
                                </div> 

                              
                                    <div class="col-md-8 offset-4 d-flex justify-content-between flex-wrap"  id="randevular"></div>                              
                              
                             
                            

                                <div class="form-group row">
                                <button name="randevual" id="randevualBtn" class="btn btn-primary btn-user btn-block">Randevu Al<span class="myload"></span></button>
                                </div> 
                                
                                <hr>
                            </form>                                   
                        </div>                         
                             
                </div>     
        </div>
    </div>
                 


    
</div>
<!-- End of Main Content -->

        

    <?php Router::view('static/footer') ; ?> 

    <script>
const SITE_URL = '<?= URL ; ?>' ;
$(function(){ //jQuery START

    // hospital START
    $('#cityHospital').change(function(){         
     let cityID = $(this).val() ;
     $.ajax({
         type:'post',
         url: SITE_URL + '/Controller/api.php?process=getHospitals',
         data:{'cityID':cityID},
         dataType :'text',
         success:function(resultData){    
           // alert(resultData);   
                $("#hospitals").html(resultData) ;
            }
         });       
    }) ;
    // hospital END

    // poliklinik START
    $('#hospitals').change(function(){         
     let hospitalID = $(this).val() ;
     $.ajax({
         type:'post',
         url: SITE_URL + '/Controller/api.php?process=getPoliklinik',
         data:{'hospitalID':hospitalID},
         dataType :'text',
         success:function(resultData){      
                $("#poliklinik").html(resultData) ;
            }
         });       
    }) ;
    // poliklinik END

    // doctors START
    $('#poliklinik').change(function(){         
     let poliklinikID = $(this).val() ;
     $.ajax({
         type:'post',
         url: SITE_URL + '/Controller/api.php?process=getDoctors',
         data:{'poliklinikID':poliklinikID},
         dataType :'text',
         success:function(resultData){    
                $("#doctors").html(resultData) ;
            }
         });       
    }) ;
    //doctors END

    // uygun randevular START
    $('#doctors').change(function(){         
        let doctorID = $(this).val() ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=getAvailableAppointments',
            data:{'doctorID':doctorID},
            dataType :'text',
            success:function(resultData){    
               //alert(resultData);
                $("#randevular").html(resultData) ;
            }
        });       
    }) ;
    //uygun randevular END

// form submit START
let frm = document.querySelector('#randevualForm') ;
frm.addEventListener('submit', function(e){
    e.preventDefault() ; 
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#randevualBtn').prop('disabled', true) ;
        let myData = $('form#randevualForm').serialize() ; 
        console.log(myData) ;
        $.ajax({ 
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=randevual',
            data:myData,
            dataType :'json',
            success:function(resultData){
                console.log(resultData) ;
                $(".myload").html('') ;
                $('#randevualBtn').prop('disabled', false) ; 

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
        }) ; // ajax END
})// addEventListener END
// form submit END



     





}) ;//jQuery END



</script>
