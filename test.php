<?php
require_once('Helper/Database.php') ;
require_once('Helper/Helper.php') ;
$DBConnect = new Database() ;


$randevu_doctor = $DBConnect->getRows('SELECT randevuDoctorID, randevuBolum FROM randevu WHERE randevuPatientID = ? ',[11]) ;

Helper::test($randevu_doctor) ; 



  





?>