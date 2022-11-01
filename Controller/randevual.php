<?php

if(!$_SESSION['patientlogin'] || $_SESSION['patientlogin'] != true){
    Router::redirect('login') ; 
}

if(Router::route(0) == 'randevual' && !Router::route(1)){
    $return = Router::model('randevual',[], 'randevual') ; 
    //Helper::test($return) ;   
    Router::view('patients/randevual',$return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}

?>