<?php

  if($process == 'getPolikliniks'){    
      $query = $DBConnect->getRows('SELECT * FROM poliklinik ORDER BY poliklinikName ASC') ;
      if($query){
       return ['success' => true, 'type' => 'success', 'data' => $query] ;
      }else{
        return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
      }    
  }else if($process == 'editpoliklinik'){
      $editID = $data['editID'] ;
      $query = $DBConnect->getRow('SELECT * FROM poliklinik WHERE poliklinikID = ?', [$editID]) ;   
      if($query){
       return ['success' => true, 'type' => 'success', 'data' => $query] ; 
      }else{
        return ['success' => false, 'type' => 'danger'] ;
      }  
  }else if($process == 'deletepoliklinik'){
      $deleteID = $data['deleteID'] ;
      $query = $DBConnect->deleteRow('DELETE FROM poliklinik WHERE poliklinikID = ?', [$deleteID]) ;
      // mysql tarafında 
      // poliklinik tablosunda 'DELETE FROM doctors WHERE doctorPoliklinikID = OLD.poliklinikID'    
      // doctors tablosunda 'DELETE FROM randevu WHERE randevuDoctorID = OLD.doctorID' 
      // trigger'ları tanımlanmıştır
      if($query){
         Router::redirect("polikliniks") ;
      }else{
         return ['success' => false, 'type' => 'danger'] ;
      }  
  }
?>


     
    



