<?php 

if(Router::route(0) == 'signup' && !Router::route(1)){
    $return = Router::model('signup', [], 'getCities') ;
    Router::view('patients/signup', $return['data']) ;
}else{
    Router::view('static/404') ;
}


?>