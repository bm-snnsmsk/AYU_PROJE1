<?php

class Validation{
    public static function warningMessage($warningMessage, $warningType = 'warning', $warningTitle = 'Oops! Dikkat', $redirect = "" ){
        $icon = $warningType ;
        $title = $warningTitle ;
        $text = $warningMessage ; 
        if(empty($redirect)){
            return json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
        }else{
           return json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Router::url($redirect)])  ;
        } 
    }
}










?>