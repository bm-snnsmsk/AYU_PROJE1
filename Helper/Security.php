<?php


class Security{

    public static function security($text){
        $text = trim($text) ;
        $text = strip_tags($text) ;
        $text = htmlspecialchars($text, ENT_QUOTES) ;            
        $text = str_replace('INSERT',"",$text) ;           
        $text = str_replace('insert',"",$text) ;           
        $text = str_replace('SELECT',"",$text) ;           
        $text = str_replace('select',"",$text) ;           
        $text = str_replace('exec',"",$text) ;           
        $text = str_replace('EXEC',"",$text) ;           
        $text = str_replace('DROP',"",$text) ;           
        $text = str_replace('drop',"",$text) ;           
        $text = str_replace('UNION',"",$text) ;           
        $text = str_replace('union',"",$text) ;   
        return $text ;        
    }
    public static function filter($field){
        return is_array($field) ? array_map('filter',$field) : self::security($field) ;
    }
    public static function post($name){
        if(isset($_POST[$name])){
         return self::filter($_POST[$name]) ;
        }else{
         return false ;
        }
    }
    public static function get($name){
        if(isset($_GET[$name])){
         return $this->filter($_GET[$name]) ;
        }else{
         return false ;
        }
    }
}
?>