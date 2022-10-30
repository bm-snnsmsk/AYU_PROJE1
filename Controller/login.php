<?php


if(Helper::route(0) == 'login' && !Helper::route(1)){
    if(isset($_POST['oturumac'])){          
        $tckimlikno = Security::post('tcnumber') ;
        $password = Security::post('password') ;
        $_SESSION['tckimlikno'] = $tckimlikno ;

        $return = Helper::model('login',['tckimlikno' => $tckimlikno,'password' => $password], 'login') ;
       ///Helper::test($return) ;
        if($return['success']){
            if(isset($return['redirect'])){
                Helper::redirect($return['redirect']) ; 
            }
        }else{
            $_SESSION['error'] = [
                'type' => $return['type'] ,
                'message' => $return['message'] 
            ];
        }
    } 
    Helper::view('login') ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
