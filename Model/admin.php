<?php

if($process == 'adminList'){
    $tcnumber = $_SESSION['adminTCNumber'] ?? '' ;
    $admin = $DBConnect->getRow('SELECT * FROM admins WHERE adminTCNumber = ? ',[$tcnumber]) ;
    if($admin){
      return ['success' => true, 'type' => 'success', 'data' => $admin] ;
    }else{
      return ['success' => false, 'type' => 'warning', 'data' => [] ] ;
    }    
}

?>