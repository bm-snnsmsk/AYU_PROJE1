<?php
require_once "Config/init.php" ;


## sistemdeki kayıtlı tüm doktorlar
$doctors = $DBConnect->getRows("SELECT doctorID, doctorPoliklinikID FROM doctors") ;
## sistemdeki kayıtlı tüm randevular
$randevular = $DBConnect->getRows("SELECT randevuHour, randevuDate, randevuPatientID FROM randevu") ;
## otomatik olarak seans tablosundan randevu oluşturma

 foreach($doctors as $key => $value){ 
    Helper::setRandevu($value['doctorID'], $value['doctorPoliklinikID']) ; ## her bir doktora randevu set edildi
    foreach($randevular as $randevu){
        Helper::deleteOldAppointment($randevu['randevuPatientID'], $randevu['randevuDate'], $randevu['randevuHour'], $value['doctorID'], $value['doctorPoliklinikID']) ; ## bir doktora ait set edilmiş ama geçerli zamandan önceki tarihlerde alınmış randevular, randevu tablosundan silinir
    }
}


if(file_exists(BASEDIR.'/Controller/'.Router::route(0).'.php')){
    require BASEDIR.'/Controller/'.Router::route(0).'.php' ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}
 



?>