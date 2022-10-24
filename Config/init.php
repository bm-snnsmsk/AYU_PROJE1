<?php

const BASEDIR = "C:\\xampp\htdocs\AYU_PROJE1" ;
const URL = "http://localhost/AYU_PROJE1/" ;

// TR saat düzenlenmesi
if(date_default_timezone_get() != 'Europe/Istanbul'){
    date_default_timezone_set('Europe/Istanbul') ;
}

// Helper içindeki tüm .php'ler sayfaya require edildi
foreach(glob(BASEDIR.'/Helper/'.'*.php') as $files){
    require $files ;
}

// Veritabanı bağlantsı
$DBConnect = new Database() ;

?>


