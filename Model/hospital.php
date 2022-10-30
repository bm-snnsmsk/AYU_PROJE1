<?php

if($process == 'hospitalList'){
    
    $query0 = $DBConnect->getRows('SELECT * FROM hospitals') ;
    $query1 = $DBConnect->getRows('SELECT * FROM cities') ;
    
    if($query0 && $query1){
     return ['success' => true, 'type' => 'success', 'data' => array_merge(['hospitals' => $query0], ['cities' => $query1])] ;
    }else{
      return ['success' => true, 'type' => 'success', 'data' =>[] ] ;
    }    
}
?>





