<?php
require_once "Config/init.php" ;


if(file_exists(BASEDIR.'/Controller/'.Router::route(0).'.php')){
    require BASEDIR.'/Controller/'.Router::route(0).'.php' ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}
 



?>