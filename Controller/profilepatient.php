<?php
if(!$_SESSION['patientlogin'] || $_SESSION['patientlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'profilepatient' && !Router::route(1)){
    $return = Router::model('profile/patient', [], 'getData') ;
    Router::view('profile/patienthome', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
