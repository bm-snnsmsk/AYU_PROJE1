<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'doctors' && !Router::route(1)){
    $return = Router::model('doctor', [], 'getdoctors') ;
    Router::view('admin/doctor', $return['data']) ;
}else if(Router::route(0) == 'doctors' && Router::route(1) == 'edit' && is_numeric(Router::route(2)) && !Router::route(3)){
    $return = Router::model('doctor', ['editID' => Router::route(2)], 'editdoctor') ;
    Router::view('admin/editdoctor', $return['data']) ;
}else if(Router::route(0) == 'doctors' && Router::route(1) == 'delete' && is_numeric(Router::route(2)) && !Router::route(3)){
    $return = Router::model('doctor', ['deleteID' => Router::route(2)], 'deletedoctor') ;
   // Helper::test($return) ;
     Router::view('admin/doctor', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>






