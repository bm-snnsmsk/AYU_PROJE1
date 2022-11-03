<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'polikliniks' && !Router::route(1)){
    $return = Router::model('poliklinik', [], 'getPolikliniks') ;
    //Helper::test($return) ;
    Router::view('admin/poliklinik', $return['data']) ;
}else if(Router::route(0) == 'polikliniks' && Router::route(1) == 'edit' && is_numeric(Router::route(2)) && !Router::route(3)){
    $return = Router::model('poliklinik', ['editID' => Router::route(2)], 'editpoliklinik') ;
    //Helper::test($return) ;
    Router::view('admin/editpoliklinik', $return['data']) ;
}else if(Router::route(0) == 'polikliniks' && Router::route(1) == 'delete' && is_numeric(Router::route(2)) && !Router::route(3)){
    $return = Router::model('poliklinik', ['deleteID' => Router::route(2)], 'deletepoliklinik') ;
    Router::view('admin/poliklinik', $return['data']) ;
}

else{
    require BASEDIR.'/View/static/404.php' ;
}

?>


