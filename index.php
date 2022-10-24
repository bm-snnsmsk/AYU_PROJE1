<?php
session_start();
require_once "Config/init.php" ;


if(isset($_GET['route'])){
    $route['route'] = explode('/', $_GET['route']) ; // GET'ten gelen değer $route array'ine dönüştürüldü    
}

if(empty($route['route'][0])){
    $route['route'][0] = 'login' ; 
}

if(file_exists(BASEDIR.'/Controller/'.$route['route'][0].'.php')){
    require BASEDIR.'/Controller/'.$route['route'][0].'.php' ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}
 



?>