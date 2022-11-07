<?php
if($process == 'getSettings'){
    $settings = $DBConnect->getRow('SELECT * FROM settings') ;
    if($settings){
      return ['success' => true, 'type' => 'success', 'data' => $settings] ;
    }else{
      return ['success' => false, 'type' => 'warning', 'data' => [] ] ;
    }    
}

?>