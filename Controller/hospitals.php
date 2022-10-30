<?php
if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Helper::redirect('login') ;  // login yoksa eğer http://localhost/AYU_PROJE1/login  'e git
}
if(Helper::route(0) == 'hospitals' && !Helper::route(1)){
    $return = Helper::model('hospital', [], 'hospitalList') ;
    Helper::view('admin/hospital', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>






