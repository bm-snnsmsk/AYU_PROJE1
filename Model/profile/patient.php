<?php

if($process == 'getData'){

    $cities = $DBConnect->getRows('SELECT * FROM cities') ;
    $towns = $DBConnect->getRows('SELECT * FROM towns') ;
    $patient = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ? AND patientID = ?',[$_SESSION['patientTCNumber'], $_SESSION['patientID']]) ;
    if($cities && $towns && $patient){
     return ['success' => true, 'type' => 'success', 'data' => array_merge(['cities' => $cities], ['towns' => $towns], ['patient' => $patient])] ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
}
?>