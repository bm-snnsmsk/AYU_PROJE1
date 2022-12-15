<?php

if($process == 'getSeans'){
    $getseans = $DBConnect->getRows('SELECT * FROM seans AS s INNER JOIN poliklinik AS p ON s.seansPoliklinikID = p.poliklinikID INNER JOIN doctors AS d ON s.seansDoctorID = d.doctorID ORDER BY s.seansDate ASC, p.poliklinikName ASC, d.doctorName, d.doctorSurname') ;
    if($getseans){
      return ['success' => true, 'type' => 'success', 'data' => $getseans] ;
    }else{
      return ['success' => false, 'type' => 'warning', 'data' => [] ] ;
    }    
}else if($process == 'delAllSeans'){  
  $delID = $data['delID'] ;
  $doctorID = $data['doctorID'] ;
  $seansDate = $data['seansDate'] ;

  $delAllSeans = $DBConnect->updateRow('UPDATE seans SET
  seans0900 = ?,
  seans0920 = ?,
  seans0940 = ?,
  seans1000 = ?,
  seans1020 = ?,
  seans1040 = ?,
  seans1100 = ?,
  seans1120 = ?,
  seans1140 = ?,
  seans1330 = ?,
  seans1350 = ?,
  seans1410 = ?,
  seans1430 = ?,
  seans1450 = ?,
  seans1510 = ?,
  seans1530 = ?,
  seans1550 = ?,
  seans1610 = ?,
  seans1630 = ?,
  seans1650 = ?
  WHERE seansID = ?', ['B','B','B','B','B','B','B','B','B','B','B','B','B','B','B','B','B','B','B','B',$delID]) ;

  $delRandevu = $DBConnect->updateRow('UPDATE randevu SET randevuStatus = ? WHERE randevuDoctorID = ? AND randevuDate = ?', [0, $doctorID, $seansDate]) ;

 // Helper::test($delID.' '.$doctorID.' '.$seansDate.' '.$delAllSeans.' '.$delRandevu);
 
  if($delAllSeans && $delRandevu){
    Router::redirect('seans') ;
  }else{
    return ['success' => false, 'type' => 'warning', 'data' => []] ;
  }    
}else if($process == 'getpoliklinik'){  

  $getpoliklinik = $DBConnect->getRows('SELECT * FROM poliklinik ORDER BY poliklinikName') ;

  if($getpoliklinik){
    return ['success' => true, 'type' => 'success', 'data' => $getpoliklinik] ;
  }else{
    return ['success' => false, 'type' => 'warning', 'data' => []] ;
  }    
}


?>