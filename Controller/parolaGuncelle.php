<?php

if(Router::route(0) == 'parolaGuncelle' && !Router::route(1)){
    Router::view('forgetpassword/parolaGuncelle') ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
