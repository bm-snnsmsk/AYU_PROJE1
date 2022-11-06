<?php

if($process == 'changeSeans'){
    Helper::test("changeSeans") ;
    $getseans = $DBConnect->getRows('SELECT * FROM seans AS s INNER JOIN poliklinik AS p ON s.seansPoliklinikID = p.poliklinikID INNER JOIN doctors AS d ON s.seansDoctorID = d.doctorID ORDER BY s.seansDate ASC, p.poliklinikName ASC, d.doctorName, d.doctorSurname') ;
    if($getseans){
      return ['success' => true, 'type' => 'success', 'data' => $getseans] ;
    }else{
      return ['success' => false, 'type' => 'warning', 'data' => [] ] ;
    }    
}

?>