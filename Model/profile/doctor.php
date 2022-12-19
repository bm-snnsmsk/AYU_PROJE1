<?php

if($process == 'getData'){

    $cities = $DBConnect->getRows('SELECT * FROM cities') ;
    $towns = $DBConnect->getRows('SELECT * FROM towns') ;
    $doctor = $DBConnect->getRow('SELECT * FROM doctors WHERE doctorTCNumber = ? AND doctorID = ?',[$_SESSION['doctorTCNumber'], $_SESSION['doctorID']]) ;
    if($cities && $towns && $doctor){
     return ['success' => true, 'type' => 'success', 'data' => array_merge(['cities' => $cities], ['towns' => $towns], ['doctor' => $doctor])] ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
}
?>