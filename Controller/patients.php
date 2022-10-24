<?php

if(Helper::route(0) == 'patients' && !Helper::route(1)){
    $return = Helper::model('patient', [], 'patientList') ;
    Helper::view('patients/home', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
