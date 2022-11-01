<?php
if(!$_SESSION['patientlogin'] || $_SESSION['patientlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'patients' && !Router::route(1)){
    $return = Router::model('patient', [], 'patientList') ;
    Router::view('patients/home', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
