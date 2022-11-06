<?php

if($process == 'getData'){

    $cities = $DBConnect->getRows('SELECT * FROM cities') ;
    $towns = $DBConnect->getRows('SELECT * FROM towns') ;
    $admin = $DBConnect->getRow('SELECT * FROM admins WHERE adminTCNumber = ? AND adminID = ?',[$_SESSION['adminTCNumber'], $_SESSION['adminID']]) ;
    if($cities && $towns && $admin){
     return ['success' => true, 'type' => 'success', 'data' => array_merge(['cities' => $cities], ['towns' => $towns], ['admin' => $admin])] ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
}
?>