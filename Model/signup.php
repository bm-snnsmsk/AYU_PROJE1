<?php

if($process == 'getCities'){

    $cities = $DBConnect->getRows('SELECT * FROM cities') ;
    if($cities){
     return ['success' => true, 'type' => 'success', 'data' => $cities] ;
    }else{
      return ['success' => false, 'type' => 'danger', 'data' =>[] ] ;
    }    
}
?>