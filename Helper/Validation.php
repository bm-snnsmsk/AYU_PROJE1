<?php

class Validation{ // Validation START

    public static function extensionValidation($ext){
        if(is_array($ext)){
            foreach($ext as $key => $value){
                return strtolower(pathinfo($value, PATHINFO_EXTENSION)) ;
            }
        }else{
            return strtolower(pathinfo($ext, PATHINFO_EXTENSION)) ;
        }
    }
    public static function required(){ // 0 ve daha fazla parametre alabilir
        $params = func_get_args() ;
        foreach($params as $par){
            if($par == NULL){
                return true ;
            }
        }
        return false ;
    }
    public static function minValue($value, $min){
        if(strlen($value) > $min){
            return true ;
        }        
        return false ;
    }
    public static function maxValue($value, $max){
        if(strlen($value) < $max){
            return true ;
        }        
        return false ;
    }

}// Validation END


