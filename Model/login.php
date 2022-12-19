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
    $admin = $DBConnect->getRow('SELECT * FROM admins WHERE adminTCNumber = ? AND adminPassword = ?', [$data['tckimlikno'], md5($data['password'])]) ;    
    if($admin){
      $_SESSION['adminID'] = $admin['adminID'] ;
      $_SESSION['adminTCNumber'] = $admin['adminTCNumber'] ;
      $_SESSION['adminName'] = $admin['adminName'] ;
      $_SESSION['adminSurname'] = $admin['adminSurname'] ;
      $_SESSION['adminGender'] = $admin['adminGender'] ;
      $_SESSION['adminBirthday'] = $admin['adminBirthday'] ;
      $_SESSION['adminAge'] = $admin['adminAge'] ;
      $_SESSION['adminEmail'] = $admin['adminEmail'] ;
      $_SESSION['adminPhoto'] = $admin['adminPhoto'] ;
      $_SESSION['adminStatus'] = $admin['adminStatus'] ;
      $_SESSION['adminSignupDate'] = $admin['adminSignupDate'] ;
      $_SESSION['adminlogin'] = true ;
      return ['success' => true, 'message' => 'Giriş Başarılı', 'type' => 'success', 'data' => $admin, 'redirect' => 'admin'] ;
    }
    $doctor = $DBConnect->getRow('SELECT * FROM doctors WHERE doctorTCNumber = ? AND doctorPassword = ?', [$data['tckimlikno'], md5($data['password'])]) ; 
    if($doctor){
      $_SESSION['doctorID'] = $doctor['doctorID'] ;
      $_SESSION['doctorTCNumber'] = $doctor['doctorTCNumber'] ;
      $_SESSION['doctorName'] = $doctor['doctorName'] ;
      $_SESSION['doctorSurname'] = $doctor['doctorSurname'] ;
      $_SESSION['doctorBirthday'] = $doctor['doctorBirthday'] ;
      $_SESSION['doctorPhoto'] = $doctor['doctorPhoto'] ;
      $_SESSION['doctorlogin'] = true ;
      return ['success' => true, 'message' => 'Giriş Başarılı', 'type' => 'success', 'data' => $doctor, 'redirect' => 'doctorpanel'] ;
    }
    $patient = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ? AND patientPassword = ?', [$data['tckimlikno'], md5($data['password'])]) ;
    if($patient){                                                                                                                     
     // test($patient);
     $_SESSION['patientID'] = $patient['patientID'] ;
     $_SESSION['patientTCNumber'] = $patient['patientTCNumber'] ;
     $_SESSION['patientName'] = $patient['patientName'] ;
     $_SESSION['patientSurname'] = $patient['patientSurname'] ;
     $_SESSION['patientGender'] = $patient['patientGender'] ;
     $_SESSION['patientBirthCity'] = $patient['patientBirthCity'] ;
     $_SESSION['patientBirthTown'] = $patient['patientBirthTown'] ;
     $_SESSION['patientBirthDay'] = $patient['patientBirthDay'] ;
     $_SESSION['patientAge'] = $patient['patientAge'] ;
     $_SESSION['patientSignUpDate'] = $patient['patientSignUpDate'] ;
     $_SESSION['patientAddressTown'] = $patient['patientAddressTown'] ;
     $_SESSION['patientAddressCity'] = $patient['patientAddressCity'] ;
     $_SESSION['patientAddress'] = $patient['patientAddress'] ;
     $_SESSION['patientIPNumber'] = $patient['patientIPNumber'] ;
     $_SESSION['patientPhoto'] = $patient['patientPhoto'] ;
     $_SESSION['patientStatus'] = $patient['patientStatus'] ;
     $_SESSION['patientlogin'] = true ;
     return ['success' => true, 'message' => 'Giriş Başarılı', 'type' => 'success', 'data' => $patient, 'redirect' => 'patients'] ;
    }
    if(!$admin || !$patient){
     return ['success' => false, 'message' => 'Kullanıcı adı veya Şifreniz hatalı', 'type' => 'danger' ] ;
    }
     
 } 
 



?>
