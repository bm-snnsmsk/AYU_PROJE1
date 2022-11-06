<?php

if(Router::route(0) == 'forgetpassword' && !Router::route(1)){
    $return = Router::model('signup', [], 'getCities') ;
    Router::view('forgetpassword/parolaSifirla',$return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
