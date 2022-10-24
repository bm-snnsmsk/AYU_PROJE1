<?php

if($process == 'login'){
    if(!$data['tckimlikno']){
       return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen TC kimlik no giriniz !'] ;
    }
    if(!Helper::isNumber($data['tckimlikno']) || strlen($data['tckimlikno'])!=11){
      return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen geçerli bir TC kimlik no giriniz !'] ;
   }
    if(!$data['password']){
       return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen parolanızı giriniz !'] ;
    }
    $query = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ? AND patientPassword = ?', [$data['tckimlikno'], md5($data['password'])]) ;
    if($query){                                                                                                                     
     // test($query);
     $_SESSION['patientID'] = $query['patientID '] ;
     $_SESSION['patientTCNumber'] = $query['patientTCNumber'] ;
     $_SESSION['patientName'] = $query['patientName'] ;
     $_SESSION['patientSurname'] = $query['patientSurname'] ;
     $_SESSION['patientGender'] = $query['patientGender'] ;
     $_SESSION['patientBirthCity'] = $query['patientBirthCity'] ;
     $_SESSION['patientBirthTown'] = $query['patientBirthTown'] ;
     $_SESSION['patientBirthDay'] = $query['patientBirthDay'] ;
     $_SESSION['patientAge'] = $query['patientAge'] ;
     $_SESSION['patientSignUpDate'] = $query['patientSignUpDate'] ;
     $_SESSION['patientAddressTown'] = $query['patientAddressTown'] ;
     $_SESSION['patientAddressCity'] = $query['patientAddressCity'] ;
     $_SESSION['patientAddress'] = $query['patientAddress'] ;
     $_SESSION['patientIPNumber'] = $query['patientIPNumber'] ;
     $_SESSION['patientPhoto'] = $query['patientPhoto'] ;
     $_SESSION['patientStatus'] = $query['patientStatus'] ;
     $_SESSION['patientlogin'] = true ;
     return ['success' => true, 'message' => 'Giriş Başarılı', 'data' => $query, 'type' => 'success', 'redirect' => 'patients'] ;
    }else{
     return ['success' => false, 'message' => 'Kullanıcı adı veya Şifreniz hatalı', 'type' => 'danger' ] ;
    }
     
 } 
 











?>


<?php




?>