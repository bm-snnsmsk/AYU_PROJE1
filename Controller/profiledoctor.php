<?php
if(!$_SESSION['doctorlogin'] || $_SESSION['doctorlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'profiledoctor' && !Router::route(1)){
    $return = Router::model('profile/doctor', [], 'getData') ;
    Router::view('profile/doctorhome', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
