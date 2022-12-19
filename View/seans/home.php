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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Seanslar</h1>                       
                    </div>

             
                    
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h4 class="m-0 font-weight-bold text-primary">Mevcut Seanslar</h4>                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Poliklinik Adı</th>
                                            <th>Doktor Adı</th>
                                            <th>09:00</th>
                                            <th>09:20</th>
                                            <th>09:40</th>
                                            <th>10:00</th>
                                            <th>10:20</th>
                                            <th>10:40</th>
                                            <th>11:00</th>
                                            <th>11:20</th>
                                            <th>11:40</th>
                                            <th>13:30</th>
                                            <th>13:50</th>
                                            <th>14:10</th>
                                            <th>14:30</th>
                                            <th>14:50</th>
                                            <th>15:10</th>
                                            <th>15:30</th>
                                            <th>15:50</th>
                                            <th>16:10</th>
                                            <th>16:30</th>
                                            <th>16:50</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Poliklinik Adı</th>
                                            <th>Doktor Adı</th>
                                            <th>09:00</th>
                                            <th>09:20</th>
                                            <th>09:40</th>
                                            <th>10:00</th>
                                            <th>10:20</th>
                                            <th>10:40</th>
                                            <th>11:00</th>
                                            <th>11:20</th>
                                            <th>11:40</th>
                                            <th>13:30</th>
                                            <th>13:50</th>
                                            <th>14:10</th>
                                            <th>14:30</th>
                                            <th>14:50</th>
                                            <th>15:10</th>
                                            <th>15:30</th>
                                            <th>15:50</th>
                                            <th>16:10</th>
                                            <th>16:30</th>
                                            <th>16:50</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>                                      
                                     
<?php 
foreach($data as $key => $value){  $sayac = 0 ; 

    ?>

    
    <tr>
        <td><?= $value['seansDate'] ; ?></td>
        <td><?= Helper::convertLetter($value['poliklinikName'],'upper') ?></td>
        <td><?= Helper::convertLetter($value['doctorName'],'firstUpper').' '.Helper::convertLetter($value['doctorSurname'],'upper') ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans0900'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans0900'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans0920'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans0920'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans0940'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans0940'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1000'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1000'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1020'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1020'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1040'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1040'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1100'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1100'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1120'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1120'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1140'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1140'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1330'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1330'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1350'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1350'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1410'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1410'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1430'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1430'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1450'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1450'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1510'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1510'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1530'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1530'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1550'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1550'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1610'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1610'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1630'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1630'] ?></td>
        <td sinan="<?= $value['doctorID'].'/'.$sayac++.'/'.$value['seansDate'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Seansını değiştirmek için çift tıklayın" class="<?= $value['seans1650'] == 'D' ? 'bg-warning text-light' : '' ; ?> text-center change"><?= $value['seans1650'] ?></td>
        <th> 
            <div class="btn-group btn-group-sm">
                <a href="<?= Router::url('seans/delete/'.$value['seansID'].'/'.$value['seansDoctorID'].'/'.$value['seansDate'])?>" class="btn btn-danger btn-sm ml-1" >Sil</a>
            </div></th>
    </tr>
<?php  } ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                        

                 
                        
                  
           

                 


                 
                </div> <!-- /.container-fluid -->
            </div> <!-- End of Main Content -->

    <?php    

  Router::view('static/footer') ; 
?>


<script>
  const SITE_URL = '<?= URL ; ?>' ;

    // bootstrap tooltip START
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    // bootstrap tooltip END


  $(function(){ //jQuery START
    
    // changeSeans START
    let changeSeans = document.querySelectorAll('.change') ;
    //alert(changeSeans.length) ;
    for(let i = 0 ; i < changeSeans.length ; i++){
        changeSeans[i].style.cursor = "pointer" ;       
       
        changeSeans[i].addEventListener('dblclick', (e) => { 
            let seansVal = changeSeans[i].innerHTML ;
            let seansTime = changeSeans[i].getAttribute('sinan') ;
            let arr = seansTime.split('/') ;
            // alert(arr[0]+' '+arr[1]) ;
            $.ajax({
                type:'post',
                url: SITE_URL + '/Controller/api.php?process=changeSeans',
                data:{'seansVal':seansVal,'doctorID':arr[0], 'seansTime':arr[1], 'seansDate':arr[2]},
                dataType :'text',
                success:function(resultData){ 
                    setTimeout(() => {
                        //alert(resultData);
                        window.location.href = 'seans' ;  
                    }, 500);                                   
                }
            }) ;
        }) ;
    }
    // changeSeans END 
  
  
  }) ;//jQuery END
  
  </script>
   