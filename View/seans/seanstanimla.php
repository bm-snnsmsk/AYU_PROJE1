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

                   
             
                    
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h3 class="m-0 font-weight-bold text-primary">Doktora Seans Tanımla</h3>                            
                        </div>
                        <div class="card-body">
                          
                        <form action="" method="POST" id="seansTanimlaForm" class="col-6">
                             
                            
                                <div class="form-group row">
                                    <label class="col-md-4" for="poliklinikName">Poliklinik</label>
                                    <select class="form-select form-control col-md-8" name="poliklinikName" id="poliklinikName">
                                            <option value="0" selected>Poliklinikler</option>
                                        <?php                                         
                                            foreach($data as $key => $value){
                                        ?>
                                           <option value="<?= $value['poliklinikID'] ; ?>"><?= Helper::convertLetter($value['poliklinikName'], 'upperWords') ; ?></option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>  
                                </div> 

                           
                                <div class="form-group row">
                                    <label class="col-md-4" for="doctor">Doktorlar</label>                                   
                                    <select class="form-select form-control col-md-8" name="doctor" id="doctor">
                                        <option value="0" selected>Doktor Seç</option>
                                    </select>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-4" for="seansdate">Seans Tarihi</label>
                                    <input type="date" name="seansdate" class="form-control form-control-user col-md-8" id="seansdate">
                                </div> 
                                
                                <div class="form-group row">
                                <button name="seansTanimlaBtn" id="seansTanimlaBtn" class="btn btn-primary btn-user btn-block">Seans Tanımla<span class="myload"></span></button>
                                </div> 
                                
                                <hr>
                            </form>    
                        </div>
                    </div>
                    
                        

                 
                        
                  
           

                 


                 
                </div> <!-- /.container-fluid -->
            </div> <!-- End of Main Content -->

    <?php    

  Router::view('static/footer') ; 
?>


<script>
const SITE_URL = '<?= URL ; ?>' ;
$(function(){ //jQuery START

     // get doctors START
     $('#poliklinikName').change(function(){         
        let poliklinikID = $(this).val() ;
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=getDoctors',
            data:{'poliklinikID':poliklinikID},
            dataType :'text',
            success:function(resultData){   
                //alert(resultData) ;       
                $("#doctor").html(resultData) ;
            }
        });       
    }) ;
    // get doctors START
    

    // seansTanimlaForm START
    let seansTanimlaForm = document.querySelector('#seansTanimlaForm') ;
    document.addEventListener('submit', (e) => {
        e.preventDefault() ;
        $(".myload").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>') ;
        $('#seansTanimlaBtn').prop('disabled', true) ;
        let myData = $('form#seansTanimlaForm').serialize() ; 
        $.ajax({
            type:'post',
            url: SITE_URL + '/Controller/api.php?process=addSeans',
            data:myData,
            dataType :'json',
            success:function(resultData){          
                $(".myload").html('') ;
                $('#seansTanimlaBtn').prop('disabled', false) ; 
                
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
    // seansTanimlaForm END



}) ;//jQuery END



</script>

