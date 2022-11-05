<?php

if($process == 'randevuiptal'){ 
     $query0 = $DBConnect->getRow('SELECT * FROM randevu WHERE randevuID = ?',[$data['iptalID']]) ;//Helper::test($query0);
     $query1 = $DBConnect->updateRow('UPDATE randevu SET randevuStatus = ? WHERE randevuID = ?',[0, $data['iptalID']]) ;
     $query2 = $DBConnect->updateRow('UPDATE seans SET seans'.$query0['randevuHour'].' = ? WHERE seansDoctorID = ?',['B', $query0['randevuDoctorID']]) ;
   
    if($query0 && $query1 && $query2){
     Router::redirect('patients') ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
}

?>