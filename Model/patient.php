<?php

if($process == 'patientList'){
    $tcnumber = $_SESSION['patientTCNumber'] ?? '' ;  

    $query = $DBConnect->getRows('SELECT * FROM patients INNER JOIN randevu ON patients.patientID = randevu.randevuPatientID INNER JOIN poliklinik ON poliklinik.poliklinikID = randevu.randevuBolum INNER JOIN doctors ON doctors.doctorID = randevu.randevuDoctorID WHERE patientTCNumber = ? AND randevu.randevuStatus = ? ORDER BY randevu.randevuDate ASC, randevu.randevuHour ASC',[$tcnumber, 1]) ;
    //$query1 = $DBConnect->getRows('SELECT * FROM randevu WHERE randevuPatientID = ? ',[$query0['patientID']]) ;
    if($query){
     return ['success' => true, 'type' => 'success', 'data' => $query] ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' => [] ] ;
    }    
}
?>
