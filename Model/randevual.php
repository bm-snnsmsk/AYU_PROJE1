<?php

if($process == 'randevual'){
    $tcnumber = $_SESSION['patientTCNumber'] ?? '' ;
    $patient = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ?', [$tcnumber]) ;
    $query = $DBConnect->getRows('SELECT * FROM poliklinik') ;
    $_SESSION['patientID'] = $patient['patientID'] ;
    if($query){
     return ['success' => true, 'type' => 'success', 'data' => $query ] ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
}

?>