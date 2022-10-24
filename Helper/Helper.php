<?php

class Helper{

    public function __construct(){
       error_reporting(0) ;
    }
   
    public static function test($param = "TEST BAŞARILI"){
        if(!is_array($param)){
            echo('<div style="min-height:100px; padding:10px; margin:5px; background-color:#1d1d1d; color:greenyellow; font-size:22px; ">'.$param.'</div>');
        }else{
            echo('<pre style="min-height:100px; padding:10px; margin:5px; background-color:#1d1d1d; color:greenyellow;">') ;
            print_r($param) ;
            echo("</pre>");
        }  
        echo '<div style="margin:20px 5px;"><a style="padding:10px; background-color:#1d1d1d; font-size:22px; text-decoration:none; color:greenyellow;" href="'.
        @$_SERVER['HTTP_REFERER'].'">Geri Dön</a></div>' ;
        die() ;
    }
    public static function route($index){
        global $route ;
        if(isset($route['route'][$index])){
            return $route['route'][$index] ;
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
    public static function sefLink($text){ // SEO uyumlu link
        $text = trim($text) ;
        $tr = ["ç","Ç","ğ","Ğ","ı","I","i","İ","ö","Ö","ş","Ş","ü","Ü"] ;
        $en = ["c","c","g","g","i","i","i","i","o","o","s","s","u","u"] ;
        $text = str_replace($tr, $en, $text) ;
        $text = mb_strtolower($text, "UTF-8") ;
        $text = preg_replace("/[^a-z0-9]/", "-", $text) ; 
        $text = preg_replace("/-+/", "-", $text) ;
        $text = trim($text, "-") ;
        return $text ;
    }
    public static function go($url, $time = 0){
        if($time != 0){
            header("Refresh:".$time.";url=".$url) ;
        }else{
            header("Location:".$url) ;
        }
    }
    public static function comeBack($time = 0){
        if($time != 0){
            header("Refresh:".$time.";url=".$url) ;
        }else{
            header("Location:".$_SERVER["HTTP_REFERER"]) ;
        }
    }
    public static function redirect($link){
        header('Location:'.$link) ;
    }
    public static function url($url){
        return URL.$url ;
    }
    public static function convertLetter($text, $case){        
        $lower = ['ç','ğ','ı','i','ö','ş','ü'] ;
        $upper = ['Ç','Ğ','I','İ','Ö','Ş','Ü'] ;
        $lengthText = mb_strlen($text, "utf-8") ;
        $firstLetter = mb_substr($text, 0, 1, 'utf-8') ;
        $otherLetters = mb_substr($text, 1, $lengthText, 'utf-8') ;
        switch($case){
            case "upper" : 
                           $replace = str_replace($lower, $upper, $text) ;
                           $result = strtoupper($replace) ; 
                           return $result ;
                           break ;
            case "lower" : 
                           $replace = str_replace($upper, $lower, $text) ;
                           $result = strtolower($replace) ;
                           return $result ;
                           break ;  
            case "firstUpper" :
                           $replaceFirst = str_replace($lower, $upper, $firstLetter) ;
                           $replaceOthers = str_replace($upper, $lower, $otherLetters) ;
                           $replaceFirst = strtoupper($replaceFirst) ;
                           $replaceOthers = strtolower($replaceOthers) ;
                           return $replaceFirst.$replaceOthers ;
                           break ;
            case "firstLower" : 
                           $replaceFirst = str_replace($upper, $lower, $firstLetter) ;
                           $replaceOthers = str_replace($lower, $upper, $otherLetters) ;
                           $replaceFirst = strtolower($replaceFirst) ;
                           $replaceOthers = strtoupper($replaceOthers) ;
                           return $replaceFirst.$replaceOthers ;
                           break ;
            case "upperWords" : 
                           $arr = explode(" ", $text) ; // boşluk esas alındı - / gibi seperatorler dikkate alınmadı
                           $txt = "" ;
                           foreach($arr as $key => $value){
                                $firstLetter = mb_substr($value, 0, 1, 'utf-8') ;
                                $otherLetters = mb_substr($value, 1, mb_strlen($value, "utf-8"), 'utf-8') ;
                                $replaceFirst = str_replace($lower, $upper, $firstLetter) ;
                                $replaceOthers = str_replace($upper, $lower, $otherLetters) ;
                                $replaceFirst = strtoupper($replaceFirst) ;
                                $replaceOthers = strtolower($replaceOthers) ;
                                $txt .=   $replaceFirst.$replaceOthers." " ;
                           }
                           return $txt ;
                           break ;   
            default      : 
                           return ; 
                           break ;                      
        }
    }
    public static function isLetter($text){
        $regExp = "/[^a-zA-ZçğıöşüÇĞIİÖŞÜ]/u" ;
        $result = preg_match($regExp, Security::security($text)) ? false : true ;
        return $result ;
    }
    public static function isNumber($text){
        $regExp = '/[^0-9]/' ;
        $result = preg_match($regExp, Security::security($text)) ? false : true ;
        return $result ;
    }
    public static function isEmail($text){
        $result = filter_var(Security::security($text), FILTER_VALIDATE_EMAIL) ;
        return $result ;
    }    
    public static function isPhone($text){
        $regExp1 = '/^\s*\+?\s*\d{0,2}\s*\(?5\d{2}\)?\s*-?\s*\d{3}\s*-?\s*[0-9]{2}\s*-?\s*[0-9]{2}\s*$/' ; // for isPhone (mobile phone)
        $regExp2 = '/^\s*\+?\s*\d{0,2}\s*\(?\d{3}\)?\s*-?\s*\d{3}\s*-?\s*[0-9]{2}\s*-?\s*[0-9]{2}\s*$/' ; // for isPhone (home phone)
        $isMobilePhone = preg_match($regExp1, Security::security($text)) ;
        $isHomePhone = preg_match($regExp2, Security::security($text)) ;
        $regExp3 = '/[-\(\) ]/' ; // for to Phone
        $replace = "" ;
        $toPhone = preg_filter($regExp3, $replace, Security::security($text)) ;
        return ['isMobilePhone' => $isMobilePhone, 'isHomePhone' => $isHomePhone,'toPhone' => $toPhone, 'phoneLength' => strlen($toPhone)] ;
    }
}

?>