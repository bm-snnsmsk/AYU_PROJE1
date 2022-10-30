<?php

if($process == 'randevual'){
    $tcnumber = $_SESSION['patientTCNumber'] ?? '' ;
    $patient = $DBConnect->getRows('SELECT * FROM patients WHERE patientTCNumber = ? ',[$tcnumber]) ;
    $cities = $DBConnect->getRows('SELECT * FROM cities') ;
    //Helper::test($patient) ;
    if($patient && $cities){
     return ['success' => true, 'type' => 'success', 'data' => array_merge(['patients' => $patient], ['cities' => $cities])] ;
    }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
    }    
}

?>