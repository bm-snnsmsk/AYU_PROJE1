<?php


if(Router::route(0) == 'login' && !Router::route(1)){
    if(isset($_POST['oturumac'])){          
        $tckimlikno = Security::post('tcnumber') ;
        $password = Security::post('password') ;
        $_SESSION['tckimlikno'] = $tckimlikno ;

        $return = Router::model('login',['tckimlikno' => $tckimlikno,'password' => $password], 'login') ;
        //Helper::test($return) ;
        if($return['success']){            
            if(isset($return['redirect'])){         
                Router::redirect($return['redirect']) ; 
            }
        }else{
            $_SESSION['error'] = [
                'type' => $return['type'] ,
                'message' => $return['message'] 
            ];
        }
    } 
    Router::view('login') ;
}else{
    require BASEDIR.'/View/static/404.php' ;
}




?>
