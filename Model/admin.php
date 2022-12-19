<?php

if($process == 'adminList'){
    $tcnumber = $_SESSION['adminTCNumber'] ?? '' ;
    $settings = $DBConnect->getRow('SELECT * FROM settings') ;
    $admin = $DBConnect->getRow('SELECT * FROM admins WHERE adminTCNumber = ? ',[$tcnumber]) ;
    $toplam_poliklinik = $DBConnect->getColumn('SELECT COUNT(*) AS toplam_poliklinik FROM poliklinik') ;
    $toplam_doctor = $DBConnect->getColumn('SELECT COUNT(*) AS toplam_doctor FROM doctors') ;
    if($admin){
      return ['success' => true, 'type' => 'success', 'data' => array_merge(['settings' => $settings], ['admin' => $admin],['toplam_poliklinik' => $toplam_poliklinik],['toplam_doctor' => $toplam_doctor])] ;
    }else{
      return ['success' => false, 'type' => 'warning', 'data' => [] ] ;
    }    
}

?>