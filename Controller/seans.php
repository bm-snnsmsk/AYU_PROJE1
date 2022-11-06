<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'seans' && !Router::route(1)){
    $return = Router::model('seans/getSeans', [], 'getSeans') ;
    Router::view('seans/home', $return['data']) ;
}else if(Router::route(0) == 'seans' && Router::route(1) == "changeSeans" && !Router::route(2)){
    $return = Router::model('seans/changeSeans', [], 'changeSeans') ;
    Router::view('seans/home', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
