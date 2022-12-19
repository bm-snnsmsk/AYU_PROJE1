<?php
if(!$_SESSION['doctorlogin'] || $_SESSION['doctorlogin'] != true){
    Router::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Router::route(0) == 'doctorpanel' && !Router::route(1)){
    //Helper::test("doctor_panel");
    $return = Router::model('doctor', [], 'get_doctor') ;
    Router::view('doctors/home', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
