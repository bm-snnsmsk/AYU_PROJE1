<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'seans' && !Router::route(1)){
    $return = Router::model('seans', [], 'getSeans') ;
    Router::view('seans/home', $return['data']) ;
}else if(Router::route(0) == 'seans' && Router::route(1) == 'seansTanimla' && !Router::route(2)){
    $return = Router::model('seans', [], 'getpoliklinik') ;
    Router::view('seans/seanstanimla', $return['data']) ;
}else if(Router::route(0) == 'seans' && Router::route(1) == 'delete' && is_numeric(Router::route(2)) && is_numeric(Router::route(3)) && is_string(Router::route(4)) && !Router::route(5)){
    $return = Router::model('seans', ['delID' => Router::route(2), 'doctorID' => Router::route(3), 'seansDate' => Router::route(4)], 'delAllSeans') ;
    Router::view('seans/home') ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
