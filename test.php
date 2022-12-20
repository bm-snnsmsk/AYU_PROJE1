<?php 
require("Helper/Database.php") ;
require("Helper/Helper.php") ;
// Veritabanı bağlantsı
$DBConnect = new Database() ;
$seans_hour = '0900' ;
$DBConnect->updateRow('UPDATE seans SET seans'.$seans_hour.' = ? WHERE seansDoctorID = ? AND seansPoliklinikID = ? AND seansDate = ?',['D', 58, 31, $seans_hour]) ; 



?>