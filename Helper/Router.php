<?php

class Router{
    public function __construct(){

    }   
    public static function route($index){
        if(isset($_GET['route'])){
            $route = explode('/', $_GET['route']) ; 
        }
        if(empty($route[0])){
            $route[0] = 'login' ; 
        }
        if(isset($route[$index])){
            return $route[$index] ;
        }else{
            return false ;
        } 
    }
    public static function view($viewName, $pageData = []){
        $data = $pageData ;
        if(file_exists(BASEDIR.'/View/'.$viewName.'.php')){
            require BASEDIR.'/View/'.$viewName.'.php' ;
        }else{
            return false ;
        }
    }
    public static function model($modelName, $pageData = [], $data_process = null){
        global $DBConnect ;
        if($data_process != null){
            $process = $data_process ;
        }
        $data = $pageData ;
        if(file_exists(BASEDIR.'/Model/'.$modelName.'.php')){
            $return = require BASEDIR.'/Model/'.$modelName.'.php' ;
            return $return ;
        }else{
            return false ;
        }
    }
    public static function assets($assetName){
        if(file_exists(BASEDIR.'/Public/'.$assetName)){
            return URL.'/Public/'.$assetName ;
        }else{
            return false ;
        }
    }
    public static function redirect($url, $time = 0){
        $url = URL.$url ;
        if($time != 0){
            header("Refresh:".$time.";url=".$url) ;
        }else{
            header("Location:".$url) ;
        }
    }
    public static function comeBack($time = 0){
        $url = $_SERVER["HTTP_REFERER"] ;
        if($time != 0){
            header("Refresh:".$time.";url=".$url) ;
        }else{
            header("Location:".$url) ;
        }
    }
    public static function url($url){
        return URL.$url ;
    }
}

?>