<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'hospitals' && !Router::route(1)){
    $return = Router::model('hospital', [], 'hospitalList') ;
    Router::view('admin/hospital', $return['data']) ;
}else if(Router::route(0) == 'hospitals' && Router::route(1) == 'edit' && is_numeric(Router::route(2)) && !Router::route(3)){
    $return = Router::model('hospital', ['editID' => Router::route(2)], 'edithospital') ;
    Router::view('admin/edithospital', $return['data']) ;
}else if(Router::route(0) == 'hospitals' && Router::route(1) == 'delete' && is_numeric(Router::route(2)) && !Router::route(3)){
    $return = Router::model('hospital', ['deleteID' => Router::route(2)], 'deletehospital') ;
   // Helper::test($return) ;
    Router::view('admin/hospital', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>






