<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Helper::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Helper::route(0) == 'admin' && !Helper::route(1)){
    $return = Helper::model('admin', [], 'adminList') ;
    Helper::view('admin/home', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
