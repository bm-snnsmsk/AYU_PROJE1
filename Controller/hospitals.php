<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Helper::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Helper::route(0) == 'hospitals' && !Helper::route(1)){
    $return = Helper::model('hospital', [], 'hospitalList') ;
    Helper::view('admin/hospital', $return['data']) ;
}else if(Helper::route(0) == 'hospitals' && Helper::route(1) == 'edit' && is_numeric(Helper::route(2)) && !Helper::route(3)){
    $return = Helper::model('hospital', ['editID' => Helper::route(2)], 'edithospital') ;
    Helper::view('admin/edithospital', $return['data']) ;
}else if(Helper::route(0) == 'hospitals' && Helper::route(1) == 'delete' && is_numeric(Helper::route(2)) && !Helper::route(3)){
    $return = Helper::model('hospital', ['deleteID' => Helper::route(2)], 'deletehospital') ;
   // Helper::test($return) ;
    Helper::view('admin/hospital', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>






