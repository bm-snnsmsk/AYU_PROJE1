<?php 

if(Helper::route(0) == 'signup' && !Helper::route(1)){
    $return = Helper::model('signup', [], 'getCities') ;
    Helper::view('patients/signup', $return['data']) ;
}else{
    Helper::view('static/404') ;
}


?>