<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'profileadmin' && !Router::route(1)){
    $return = Router::model('profile/admin', [], 'getData') ;
    Router::view('profile/adminhome', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
