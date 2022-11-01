<?php

  if($process == 'hospitalList'){    
      $query0 = $DBConnect->getRows('SELECT * FROM hospitals LEFT JOIN cities ON hospitals.hospitalCityID = cities.cityID ORDER BY cityID, hospitalName ASC') ;    
      $query1 = $DBConnect->getRows('SELECT * FROM cities ORDER BY cityID ASC') ;    
      if($query0 && $query1){
       return ['success' => true, 'type' => 'success', 'data' => array_merge(['cities_hospitals' => $query0], ['cities' => $query1])] ;
      }else{
        return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
      }    
  }else if($process == 'edithospital'){
      $editID = $data['editID'] ;
      $adminID = $_SESSION['adminID'] ;
      $adminTCNumber = $_SESSION['adminTCNumber'] ; 
    // Helper::test($data);
      $query0 = $DBConnect->getRow('SELECT * FROM admins WHERE adminTCNumber = ? AND adminID = ?', [$adminTCNumber, $adminID]) ;    
      $query1 = $DBConnect->getRow('SELECT * FROM hospitals AS h LEFT JOIN cities AS c ON h.hospitalCityID = c.cityID WHERE h.hospitalID = ?', [$editID]) ;   
      $query2 = $DBConnect->getRows('SELECT * FROM cities ORDER BY cityID ASC') ;    
      if($query0 && $query1 && $query2){
       return ['success' => true, 'type' => 'success', 'data' => array_merge(['cities_hospitals' => $query1], ['cities' => $query2])] ; 
      }else{
        return ['success' => true, 'type' => 'success'] ;
      }  
  }else if($process == 'deletehospital'){ // düzenleme yapılacak  (hastane içindeki poliklinik-doktor-randevular da eşzamanlı silinmeli)
      $deleteID = $data['deleteID'] ;
      $adminID = $_SESSION['adminID'] ;
      $adminTCNumber = $_SESSION['adminTCNumber'] ; 
    // Helper::test($data);
      $query0 = $DBConnect->getRows('SELECT * FROM admins WHERE adminTCNumber = ? AND adminID = ?', [$adminTCNumber, $adminID]) ;    
      $query1 = $DBConnect->deleteRow('DELETE FROM hospitals WHERE hospitalID = ?', [$deleteID]) ; 
      $query2 = $DBConnect->getRows('SELECT * FROM hospitals LEFT JOIN cities ON hospitals.hospitalCityID = cities.cityID ORDER BY cityID, hospitalName ASC') ;
      $query3 = $DBConnect->getRows('SELECT * FROM cities ORDER BY cityID ASC') ;   
      if($query0 && $query1 && $query2 && $query3){
       return ['success' => true, 'type' => 'success', 'data' => array_merge(['cities_hospitals' => $query2], ['cities' => $query3])] ; 
      }else{
        return ['success' => true, 'type' => 'success'] ;
      }  
  }
?>





