<?php

if($process == 'adminList'){
    $tcnumber = $_SESSION['adminTCNumber'] ?? '' ;
    $admin = $DBConnect->getRows('SELECT * FROM admins WHERE adminTCNumber = ? ',[$tcnumber]) ;
    if($admin){
     return ['success' => true, 'type' => 'success', 'data' => $admin] ;
    }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
    }    
}

?>