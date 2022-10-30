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
    $query0 = $DBConnect->getRow('SELECT * FROM admins WHERE adminTCNumber = ? AND adminPassword = ?', [$data['tckimlikno'], md5($data['password'])]) ;    
    if($query0){
      $_SESSION['adminID'] = $query0['adminID'] ;
      $_SESSION['adminTCNumber'] = $query0['adminTCNumber'] ;
      $_SESSION['adminName'] = $query0['adminName'] ;
      $_SESSION['adminSurname'] = $query0['adminSurname'] ;
      $_SESSION['adminGender'] = $query0['admintGender'] ;
      $_SESSION['adminBirthday'] = $query0['adminBirthday'] ;
      $_SESSION['adminAge'] = $query0['adminAge'] ;
      $_SESSION['adminEmail'] = $query0['adminEmail'] ;
      $_SESSION['adminPhoto'] = $query0['adminPhoto'] ;
      $_SESSION['adminStatus'] = $query0['adminStatus'] ;
      $_SESSION['adminSignupDate'] = $query0['adminSignupDate'] ;
      $_SESSION['adminlogin'] = true ;
      return ['success' => true, 'message' => 'Giriş Başarılı', 'type' => 'success', 'data' => $query0, 'redirect' => 'admin'] ;
    }
    $query1 = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ? AND patientPassword = ?', [$data['tckimlikno'], md5($data['password'])]) ;
    if($query1){                                                                                                                     
     // test($query1);
     $_SESSION['patientID'] = $query1['patientID'] ;
     $_SESSION['patientTCNumber'] = $query1['patientTCNumber'] ;
     $_SESSION['patientName'] = $query1['patientName'] ;
     $_SESSION['patientSurname'] = $query1['patientSurname'] ;
     $_SESSION['patientGender'] = $query1['patientGender'] ;
     $_SESSION['patientBirthCity'] = $query1['patientBirthCity'] ;
     $_SESSION['patientBirthTown'] = $query1['patientBirthTown'] ;
     $_SESSION['patientBirthDay'] = $query1['patientBirthDay'] ;
     $_SESSION['patientAge'] = $query1['patientAge'] ;
     $_SESSION['patientSignUpDate'] = $query1['patientSignUpDate'] ;
     $_SESSION['patientAddressTown'] = $query1['patientAddressTown'] ;
     $_SESSION['patientAddressCity'] = $query1['patientAddressCity'] ;
     $_SESSION['patientAddress'] = $query1['patientAddress'] ;
     $_SESSION['patientIPNumber'] = $query1['patientIPNumber'] ;
     $_SESSION['patientPhoto'] = $query1['patientPhoto'] ;
     $_SESSION['patientStatus'] = $query1['patientStatus'] ;
     $_SESSION['patientlogin'] = true ;
     return ['success' => true, 'message' => 'Giriş Başarılı', 'type' => 'success', 'data' => $query1, 'redirect' => 'patients'] ;
    }
    if(!$query0 || !$query1){
     return ['success' => false, 'message' => 'Kullanıcı adı veya Şifreniz hatalı', 'type' => 'danger' ] ;
    }
     
 } 
 



?>
