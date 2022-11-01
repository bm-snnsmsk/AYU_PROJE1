<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'admin' && !Router::route(1)){
    $return = Router::model('admin', [], 'adminList') ;
    Router::view('admin/home', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
