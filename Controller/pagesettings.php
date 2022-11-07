<?php

if(!$_SESSION['adminlogin'] || $_SESSION['adminlogin'] != true){
    Router::redirect('login') ; 
}
if(Router::route(0) == 'pagesettings' && !Router::route(1)){
    $return = Router::model('settings', [], 'getSettings') ;
    Router::view('admin/pagesettings', $return['data']) ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}









?>