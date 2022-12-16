<?php
require_once "Config/init.php" ;


## sistemdeki kayıtlı tüm doktorlar
$doctors = $DBConnect->getRows("SELECT doctorID, doctorPoliklinikID FROM doctors") ;
## otomatik olarak seans tablosundan randevu oluşturma
foreach($doctors as $key => $value){
   $DBConnect->setRandevu($value['doctorID'], $value['doctorPoliklinikID']) ;
}


if(file_exists(BASEDIR.'/Controller/'.Router::route(0).'.php')){
    require BASEDIR.'/Controller/'.Router::route(0).'.php' ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}
 



?>