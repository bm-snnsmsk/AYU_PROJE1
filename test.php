<?php
require_once('Helper/Database.php') ;
require_once('Helper/Helper.php') ;
$DBConnect = new Database() ;
date_default_timezone_set('Europe/Istanbul') ;



$toplam_seans = $DBConnect->getRow('SELECT COUNT(*) AS toplam FROM seans WHERE seansDoctorID = ?', [46]) ;


print_r($toplam_seans['toplam']) ;

?>