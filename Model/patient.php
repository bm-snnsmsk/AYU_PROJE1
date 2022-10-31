<?php

if($process == 'patientList'){
    $tcnumber = $_SESSION['patientTCNumber'] ?? '' ;
    $query0 = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ? ',[$tcnumber]) ;
    $query1 = $DBConnect->getRows('SELECT * FROM randevu WHERE randevuPatientID = ? ',[$query0['patientID']]) ;
    if($query0){
     return ['success' => true, 'type' => 'success', 'data' => array_merge(['patient' => $query0], ['randevu' => $query1])] ;
    }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
    }    
}
?>
