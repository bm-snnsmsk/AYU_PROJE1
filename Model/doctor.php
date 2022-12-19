<?php

  if($process == 'getdoctors'){    
    $cities = $DBConnect->getRows('SELECT * FROM cities') ;
    $towns = $DBConnect->getRows('SELECT * FROM towns') ;
      $query0 = $DBConnect->getRows('SELECT * FROM doctors AS d LEFT JOIN poliklinik AS p ON d.doctorPoliklinikID = p.poliklinikID ORDER BY p.poliklinikName, d.doctorName, d.doctorSurname ASC') ; 

      $query1 = $DBConnect->getRows('SELECT * FROM poliklinik ORDER BY poliklinikName ASC') ; 
      if($query1){
       return ['success' => true, 'type' => 'success', 'data' => array_merge(['doctors' => $query0], ['polikliniks' => $query1], ['cities' => $cities], ['towns' => $towns])] ;
      }else{
        return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
      }    
  }else if($process == 'editdoctor'){
      $editID = $data['editID'] ;
      $query0 = $DBConnect->getRows('SELECT * FROM doctors AS d RIGHT JOIN poliklinik AS p ON d.doctorPoliklinikID = p.poliklinikID WHERE d.doctorID = ?', [$editID]) ; 
      $query1 = $DBConnect->getRows('SELECT * FROM poliklinik') ; 
      if($query0 && $query1){
       return ['success' => true, 'type' => 'success', 'data' => array_merge(['doctor' => $query0], ['polikliniks' => $query1]) ] ; 
      }else{
        return ['success' => false, 'type' => 'danger'] ;
      }  
  }else if($process == 'deletedoctor'){
      $deleteID = $data['deleteID'] ;
      $query = $DBConnect->deleteRow('DELETE FROM doctors WHERE doctorID = ?', [$deleteID]) ;
      if($query){
        Router::redirect("doctors") ;
      }else{
        return ['success' => false, 'type' => 'danger'] ;
      }  
  }else if($process == 'get_doctor'){
    $query = $DBConnect->getRows('SELECT * FROM patients AS p INNER JOIN randevu AS r ON p.patientID = r.randevuPatientID WHERE r.randevuDoctorID = ?', [$_SESSION["doctorID"]]) ; 
    if($query){
     return ['success' => true, 'type' => 'success', 'data' => $query ] ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
  }
?>





