<?php

if($process == 'patientList'){
    $tcnumber = $_SESSION['patientTCNumber'] ?? '' ;
    $patient = $DBConnect->getRows('SELECT * FROM patients WHERE patientTCNumber = ? ',[$tcnumber]) ;
    if($patient){
     return ['success' => true, 'type' => 'success', 'data' => $patient] ;
    }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
    }    
}
?>