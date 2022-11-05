<?php

if(!$_SESSION['patientlogin'] || $_SESSION['patientlogin'] != true){
    Router::redirect('login') ; 
}

if(Router::route(0) == 'randevuiptal' && is_numeric(Router::route(1)) && !Router::route(2)){
    $return = Router::model('randevuiptal',['iptalID' => Router::route(1)], 'randevuiptal') ; 
    //Helper::test($return) ;   
    Router::view('patients',$return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}

?>
 