<?php

if(!$_SESSION['patientlogin'] || $_SESSION['patientlogin'] != true){
    Helper::redirect('login') ; 
}

if(Helper::route(0) == 'randevual' && !Helper::route(1)){
    $return = Helper::model('randevual',[], 'randevual') ; 
    //Helper::test($return) ;   
    Helper::view('randevual',$return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}

?>