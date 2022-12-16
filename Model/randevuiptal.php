<?php

if($process == 'randevuiptal'){ 
     $randevu_count = $DBConnect->getColumn('SELECT patientRandevuCount FROM patients WHERE patientID = ? ',[$_SESSION['patientID']]) ; 
     $query0 = $DBConnect->getRow('SELECT * FROM randevu WHERE randevuID = ?',[$data['iptalID']]) ;
     $query1 = $DBConnect->deleteRow('DELETE FROM randevu WHERE randevuID = ?',[$data['iptalID']]) ;
     $query2 = $DBConnect->updateRow('UPDATE seans SET seans'.$query0['randevuHour'].' = ? WHERE seansDoctorID = ? AND seansDate = ?',['B', $query0['randevuDoctorID'], $query0['randevuDate']]) ;
   
    if($query0 && $query1 && $query2){
     --$randevu_count ;
     $DBConnect->updateRow('UPDATE patients SET patientRandevuCount = ? WHERE patientID = ? ',[$randevu_count, $_SESSION['patientID']]) ; 
     Router::redirect('patients') ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
}

?>