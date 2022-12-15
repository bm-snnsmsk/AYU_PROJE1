<?php

  $seans = "19-12-2022 - PAZARTESI - 09.40" ;
  $seans_date = substr($seans,0, 10) ;

print_r($seans_date) ;
echo "<br/>";


$today = date_create($seans_date);

   $rr = date_format($today, 'Y-m-d') ;


 echo($rr) ;
  



// for($i = 0 ; $i < 7 ; $i++){
//     $today = date_create(date('d-m-Y'));
// date_modify($today, '+'.$i.' day');
// echo date_format($today, 'd-m-Y w')."<br/>";

// }

?>