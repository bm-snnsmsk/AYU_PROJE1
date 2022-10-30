<?php
if(!$_SESSION['patientlogin'] || $_SESSION['patientlogin'] != true){
    Helper::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Helper::route(0) == 'patients' && !Helper::route(1)){
    $return = Helper::model('patient', [], 'patientList') ;
    Helper::view('patients/home', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
