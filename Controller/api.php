<?php
require_once "../Config/init.php" ;
$process = Security::get('process') ;


switch($process){

    // list towns START
    case 'getTowns' :             
        $ID = Security::post('cityID') ;  
        $myOption = '<option value="0">İlçe</option>'  ;  
        $towns = $DBConnect->getRows('SELECT * FROM towns WHERE cityID = ?',[$ID]) ;
        foreach($towns as $key => $value){
            $myOption .= '<option value="'.$value['townID'].'">'.$value['townName'].'</option>'  ; 
        }
        echo $myOption ;
        break ; 
    // list towns END

// add patient START
case 'addPatient' :         
    
            $tcnumber = Security::post('tcnumber') ;
            $name = Security::post('name') ;
            $surname = Security::post('surname') ;
            $password = Security::post('password') ;
            $passwordagain = Security::post('passwordagain') ;
            $patientGender = Security::post('patientGender') ;
            $cityName = Security::post('cityName') ;
            $townName = Security::post('townName') ;
            $birthday = Security::post('birthday') ;
            $cityAddress = Security::post('cityAddress') ;
            $townAddress = Security::post('townAddress') ;
            $address = Security::post('address') ;
            $profilephoto = Security::post('profilephoto') ; 

            // tc kimlik no validation START
            if(!$tcnumber){
                $text = "Lütfen TC Kimlik Numaranızı giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!Helper::isNumber($tcnumber) || strlen($tcnumber)!=11){
                $text = "Lütfen Geçerli bir TC Kimlik Numarası giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            // tc kimlik no validation END

            // isim validation START           
            if(!$name){
                $text = "Lütfen Adınızı giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            } 
            if(!Helper::isLetter($name) || strlen($name) < 3){
                $text = "Lütfen Geçerli bir isim giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            // isim validation END

            // soyisim validation START           
            if(!$surname){
                $text = "Lütfen Soyadınızı giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!Helper::isLetter($surname) || strlen($surname) < 3){
                $text = "Lütfen Geçerli bir soyisim giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            // soyisim validation END
            
            // password validation START 
            if(!$password){
                $text = "Lütfen şifrenizi giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!$passwordagain){
                $text = "Lütfen şifrenizi tekrar giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!($passwordagain == $password)){
                $text = "Şifreleriniz uyuşmuyor. Lütfen tekrar deneyiniz." ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            // password validation END

            if(!$patientGender){
                $text = "Lütfen cinsiyet giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!$cityName){
                $text = "Lütfen doğum yerinizi il olarak  giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!$townName){
                $text = "Lütfen doğum yerinizi ilçe olarak giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!$birthday){
                $text = "Lütfen doğum tarihinizi giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!$cityAddress){
                $text = "Lütfen adresinizi il olarak giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;  
            }
            if(!$townAddress){
                $text = "Lütfen adresinizi ilçe olarak giriniz" ;
                echo Validation::warningMessage($text) ;
                die() ;   
            }
            if(!$address){
                echo Validation::warningMessage("Lütfen adresinizi tam olarak giriniz") ;
                die() ;   
            }
    
            $patientPhoto = ($patientGender == 'K') ? 'kadin_avatar.png' : 'erkek_avatar.png' ;
            $password = md5($password) ;
            $patientAge = date('Y') - explode('-', $birthday)[0] ;
            $patientIPNumber = $_SERVER['REMOTE_ADDR'] ;
            $signupDate = date('Y-m-d') ;

            $signup = $DBConnect->addRow('INSERT INTO patients 
            (
                patientTCNumber,
                patientName,
                patientSurname,
                patientGender,
                patientPassword,
                patientBirthCity,
                patientBirthTown,
                patientBirthDay,
                patientAge,
                patientSignUpDate,
                patientAddressTown,
                patientAddressCity,
                patientAddress,
                patientIPNumber,
                patientPhoto
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
                $tcnumber,
                $name,
                $surname,
                $patientGender,
                $password ,
                $cityName,
                $townName,
                $birthday,
                $patientAge,
                $signupDate,
                $townAddress,
                $cityAddress,
                $address,
                $patientIPNumber,
                $patientPhoto
            ]) ;
            if($signup){
                // setsession START
                // $_SESSION['patientID'] = ... ; ID yeni verildi
                $_SESSION['patientTCNumber'] = $tcnumber ;
                $_SESSION['patientName'] = $name ;
                $_SESSION['patientSurname'] = $surname ;
                $_SESSION['patientGender'] = $patientGender ;
                $_SESSION['patientBirthCity'] = $cityName ;
                $_SESSION['patientBirthTown'] = $townName ;
                $_SESSION['patientBirthDay'] = $birthday ;
                $_SESSION['patientAge'] = $patientAge ;
                $_SESSION['patientSignUpDate'] = $signupDate ;
                $_SESSION['patientAddressTown'] = $townAddress ;
                $_SESSION['patientAddressCity'] = $cityAddress ;
                $_SESSION['patientAddress'] = $address ;
                $_SESSION['patientIPNumber'] = $patientIPNumber ;
                $_SESSION['patientPhoto'] = $patientPhoto ;
                $_SESSION['patientStatus'] = 1 ;
                $_SESSION['patientlogin'] = true ;  
                 // setsession END
                 echo Validation::warningMessage("Kaydınız başarılı bir şekilde gerçekleştirildi.", 'success', '', 'patients') ;
                 die() ;                 
            }else{
                echo Validation::warningMessage("Kayıt sırasında beklenmeyen bir hata meydana geldi.", 'error') ;
                 die() ;   
            } 
            

           
break ;    
    // add patient END

    // list getDoctors START
    case 'getDoctors' :             
        $ID = Security::post('poliklinikID') ;  
        $myOption = '<option value="0">Doktor Seç</option>'  ;  
        $doctors = $DBConnect->getRows('SELECT * FROM doctors WHERE doctorPoliklinikID = ? ORDER BY doctorName, doctorSurname ASC',[$ID]) ;
        foreach($doctors as $key => $value){
            $doctorFullName = $value['doctorName'].' '.$value['doctorSurname'] ;
            $myOption .= '<option value="'.$value['doctorID'].'">'.$doctorFullName.'</option>'  ; 
        }
        echo $myOption ;
    break ; 
    // list getDoctors END

    // list getAvailableAppointments START
    case 'getAvailableAppointments' :             
        $ID = Security::post('doctorID') ;  
        
        $result = ''  ;  
        $seans = $DBConnect->getRow('SELECT * FROM seans WHERE seansDoctorID = ?',[$ID]) ;
       
        if($seans && $seans['seans0900'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio"  name="seans" value="seans0900" id="seans1" disabled><label class="form-check-label" for="seans1">09.00</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio"  name="seans" value="seans0900" id="seans1"><label class="form-check-label" for="seans1">09.00</label></div>' ;
        }       
                 
        if($seans && $seans['seans0920'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans0920" id="seans2" disabled><label class="form-check-label" for="seans2">09.20</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans0920" id="seans2"><label class="form-check-label" for="seans2">09.20</label></div>' ;
        }    

        if($seans && $seans['seans0940'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans0940" id="seans3" disabled><label class="form-check-label" for="seans3">09.40</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans0940" id="seans3"><label class="form-check-label" for="seans3">09.40</label></div>' ;
        }      

        if($seans && $seans['seans1000'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1000" id="seans4" disabled><label class="form-check-label" for="seans4">10.00</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1000" id="seans4"><label class="form-check-label" for="seans4">10.00</label></div>' ;
        }          
        if($seans && $seans['seans1020'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1020" id="seans5" disabled><label class="form-check-label" for="seans5">10.20</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1020" id="seans5"><label class="form-check-label" for="seans5">10.20</label></div>' ;
        }          
        if($seans && $seans['seans1040'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1040" id="seans6" disabled><label class="form-check-label" for="seans6">10.40</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1040" id="seans6"><label class="form-check-label" for="seans6">10.40</label></div>' ;
        }          
        if($seans && $seans['seans1100'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1100" id="seans7" disabled><label class="form-check-label" for="seans7">11.00</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1100" id="seans7"><label class="form-check-label" for="seans7">11.00</label></div>' ;
        }          
        if($seans && $seans['seans1120'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1120" id="seans8" disabled><label class="form-check-label" for="seans8">11.20</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1120" id="seans8"><label class="form-check-label" for="seans8">11.20</label></div>' ;
        }          
        if($seans && $seans['seans1140'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1140" id="seans9" disabled><label class="form-check-label" for="seans9">11.40</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1140" id="seans9"><label class="form-check-label" for="seans9">11.40</label></div>' ;
        }          
        if($seans && $seans['seans1330'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1330" id="seans10" disabled><label class="form-check-label" for="seans10">13.30</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1330" id="seans10"><label class="form-check-label" for="seans10">13.30</label></div>' ;
        }          
        if($seans && $seans['seans1350'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1350" id="seans11" disabled><label class="form-check-label" for="seans11">13.50</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1350" id="seans11"><label class="form-check-label" for="seans11">13.50</label></div>' ;
        }          
        if($seans && $seans['seans1410'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1410" id="seans12" disabled><label class="form-check-label" for="seans12">14.10</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1410" id="seans12"><label class="form-check-label" for="seans12">14.10</label></div>' ;
        }          
        if($seans && $seans['seans1430'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1430" id="seans13" disabled><label class="form-check-label" for="seans13">14.30</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1430" id="seans13"><label class="form-check-label" for="seans13">14.30</label></div>' ;
        }   

        if($seans && $seans['seans1450'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1450" id="seans14" disabled><label class="form-check-label" for="seans14">14.50</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1450" id="seans14"><label class="form-check-label" for="seans14">14.50</label></div>' ;
        }          
        if($seans && $seans['seans1510'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1510" id="seans15" disabled><label class="form-check-label" for="seans15">15.10</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1510" id="seans15"><label class="form-check-label" for="seans15">15.10</label></div>' ;
        }          
        if($seans && $seans['seans1530'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1530" id="seans16" disabled><label class="form-check-label" for="seans16">15.30</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1530" id="seans16"><label class="form-check-label" for="seans16">15.30</label></div>' ;
        }  

        if($seans && $seans['seans1550'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1550" id="seans17" disabled><label class="form-check-label" for="seans17">15.50</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1550" id="seans17"><label class="form-check-label" for="seans17">15.50</label></div>' ;
        }          
        if($seans && $seans['seans1610'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1610" id="seans18" disabled><label class="form-check-label" for="seans18">16.10</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1610" id="seans18"><label class="form-check-label" for="seans18">16.10</label></div>' ;
        }          
        if($seans && $seans['seans1630'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1630" id="seans19" disabled><label class="form-check-label" for="seans19">16.30</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1630" id="seans19"><label class="form-check-label" for="seans19">16.30</label></div>' ;
        }          
        if($seans && $seans['seans1650'] == 'D'){
            $result.='<div class="form-check m-2 d-none"><input class="form-check-input" type="radio" name="seans" value="seans1650" id="seans20" disabled><label class="form-check-label" for="seans20">16.50</label></div>' ;
        }else{
            $result.='<div class="form-check m-2"><input class="form-check-input" type="radio" name="seans" value="seans1650" id="seans20"><label class="form-check-label" for="seans20">16.50</label></div>' ;
        }     
         /*   
          $rr = "<pre>" ;
          $rr.= print_r(var_dump($seans)) ;
          $rr.="</pre>" ; */
          
    // }      
        echo $result ;
    break ; 
// list getAvailableAppointments END

     
// randevualt START
case 'randevual' :        
        
        $poliklinik = Security::post('poliklinik') ;
        $doctors = Security::post('doctors') ;
        $seans = Security::post('seans') ;

         // poliklinik validation START           
         if(!$poliklinik){
            echo Validation::warningMessage("Poliklinik seçiniz") ;
            die() ;
        }        
        // poliklinik validation END

         // doctor validation START           
         if(!$doctors){
            $text = "Doktor seçiniz" ;
            echo Validation::warningMessage($text) ;
            die() ;
        }        
        // doktor validation END

         // seans validation START           
         if(!$seans){
            $text = "Seans seçiniz" ;
            echo Validation::warningMessage($text) ;
            die() ;
        }        
        // seans validation END
        $seansArr = ['seans0900', 'seans0920','seans0940','seans1000', 'seans1020','seans1040','seans1100', 'seans1120','seans1140','seans1330', 'seans1350','seans1410','seans1430', 'seans1450','seans1510','seans1530', 'seans1550','seans1610','seans1630', 'seans1650'] ;

        $s = $seansArr[array_search($seans, $seansArr)] ;
        
        $time = substr($s, -4) ;
      
        $seansDate = date('Y-m-d') ;
        $randevuDay = Helper::weekday(date('w')) ;

      $query0 = $DBConnect->addRow('INSERT INTO randevu (randevuPatientID, randevuBolum, randevuDay, randevuDoctorID,randevuDate, randevuHour,randevuAddTime) VALUES (?,?,?,?,?,?,?)',[$_SESSION['patientID'],$poliklinik,$randevuDay, $doctors, $seansDate, $time, $seansDate]) ; 
       $query1 = $DBConnect->updateRow('UPDATE seans SET '.$s.' = ? WHERE seansDoctorID = ? AND seansPoliklinikID = ?',['D', $doctors, $poliklinik]) ; 
        if($query0 && $query1){
            echo Validation::warningMessage("Randevunuz başarılı bir şekilde oluşturuldu." ,"success",'','patients') ;
            die() ;
        }else{
            echo Validation::warningMessage("Randevu alma sırasında beklenmeyen bir hata meydana geldi.", "error") ;
            die() ;
        }  
break ;    
// randevual END

// add polikilinik START
case 'addPoliklinik' :         
        
        $poliklinikname = Security::post('poliklinikname') ;

        // poliklinikname  START
        if(!$poliklinikname){
            echo Validation::warningMessage("Lütfen poliklinik adı giriniz.") ;
            die() ;
        } 
        // poliklinikname  END
      
        $query = $DBConnect->addRow('INSERT INTO poliklinik (poliklinikName) VALUES (?)',[$poliklinikname]) ;
       
        if($query){
            echo Validation::warningMessage("Poliklinik adı başarılı bir şekilde eklendi.","success",'','polikliniks') ;
            die() ;
        }else{
            echo Validation::warningMessage("Poliklinik ekleme sırasında beklenmeyen bir hata meydana geldi.", "error") ;
            die() ;
        }  
        

       
break ;    
// add polikilinik END


// editpoliklinik START
case 'editPoliklinik' : 
    $poliklinikname = Security::post('poliklinikname') ;
    $editID = Security::post('editID') ;

    if(!$poliklinikname){
        echo Validation::warningMessage("Lütfen poliklinik adı giriniz.") ;
        die() ;
    }
    
    $query = $DBConnect->updateRow('UPDATE poliklinik SET poliklinikname = ? WHERE poliklinikID = ?',[$poliklinikname, $editID]) ;
  
            
    if($query){ 
        echo Validation::warningMessage("Poliklinik adı başarılı bir şekilde düzenlendi.","success",'','polikliniks') ;
        die() ;
    }else{
        echo Validation::warningMessage("Poliklinik düzenleme sırasında beklenmeyen bir hata meydana geldi.", "error") ;
        die() ;
    } 
break ; 
// editpoliklinik END

// addDoctor START
case 'addDoctor' :
    $poliklinikName = Security::post('poliklinikName') ;
    $doctorName = Security::post('doctorName') ;
    $doctorSurname = Security::post('doctorSurname') ;
    $doctorTCNumber = Security::post('doctorTCNumber') ;
    $doctorPhoneNumber = Security::post('doctorPhoneNumber') ;

  
    if(!$poliklinikName){
        echo Validation::warningMessage("Lütfen poliklinik adı giriniz.") ;
        die() ;
    }

    if(!$doctorName){
        echo Validation::warningMessage("Lütfen doktor adı giriniz") ;
        die() ;
    }

    if(!$doctorSurname){
        echo Validation::warningMessage("Lütfen doktor soyadı giriniz") ;
        die() ;
    }
    if(!$doctorTCNumber){
        echo Validation::warningMessage("Lütfen doktor TC numarası giriniz") ;
        die() ;
    }
    if(!Helper::isNumber($doctorTCNumber) || strlen($doctorTCNumber) != 11){
        echo Validation::warningMessage("Lütfen geçerli bir doktor TC numarası giriniz") ;
        die() ;
    }
    if(!$doctorPhoneNumber){
        echo Validation::warningMessage("Lütfen telefon numarası giriniz") ;
        die() ;
    }
    if(!Helper::isPhone($doctorPhoneNumber)['isMobilePhone']){
        echo Validation::warningMessage("Lütfen geçerli bir telefon numarası giriniz") ;
        die() ;
    }
    
    $query = $DBConnect->addRow('INSERT INTO doctors (doctorName, doctorSurname, doctorTCNumber, doctorPhoneNumber, doctorCityID, doctorHospitalID, doctorPoliklinikID) VALUES (?, ?, ?, ?, ?, ?, ?) ',[$doctorName, $doctorSurname, $doctorTCNumber, $doctorPhoneNumber, 73, 1, $poliklinikName]) ;
    $query2 = $DBConnect->getRow('SELECT * FROM doctors WHERE doctorTCNumber = ?',[$doctorTCNumber]) ;
    $doctorID = $query2['doctorID'] ;
    $seansDate = date('Y-m-d') ;        
    if($query){          
        $DBConnect->addRow('INSERT INTO seans (seansPoliklinikID, seansDoctorID, seansDate) VALUES (?, ?, ?)', [$poliklinikName, $doctorID, $seansDate]) ;
        echo Validation::warningMessage("Doktor ekleme işlemi başarılı bir şekilde gerçekleştirildi.","success",'','doctors') ;
        die() ;
    }else{
        echo Validation::warningMessage("Doktor ekleme sırasında beklenmeyen bir hata meydana geldi.","error") ;
        die() ;
    } 
break ; 
// addDoctor END
// editDoctor START
  case 'editDoctor' : 
    $poliklinikname = Security::post('poliklinikname') ;
    $doctorName = Security::post('doctorName') ;
    $doctorSurname = Security::post('doctorSurname') ;
    $editID = Security::post('editID') ;

    if(!$poliklinikname){
        echo Validation::warningMessage("Lütfen poliklinik ismini giriniz.") ;
        die() ;
    }
    if(!$doctorName){
        echo Validation::warningMessage("Lütfen doktor adını giriniz") ;
        die() ;
    }
    if(!$doctorSurname){
        echo Validation::warningMessage("Lütfen doktor soyadını giriniz") ;
        die() ;
    }
    
    $query = $DBConnect->updateRow('UPDATE doctors SET doctorName = ?, doctorSurname = ?, doctorPoliklinikID = ? WHERE doctorID = ?',[$doctorName, $doctorSurname, $poliklinikname, $editID]) ;
  
            
    if($query){
        echo Validation::warningMessage("Doktor adı başarılı bir şekilde düzenlendi.","success",'','doctors') ;
        die() ;
    }else{
        echo Validation::warningMessage("LDoktor düzenleme sırasında beklenmeyen bir hata meydana geldi.") ;
        die() ;
    } 
  break ; 
// editDoctor END

// parolaSifirla START
case 'parolaSifirla' :         
        
    $tcnumber = Security::post('tcnumber') ;
    $name = Security::post('name') ;
    $surname = Security::post('surname') ;
    $patientGender = Security::post('patientGender') ;
    $cityName = Security::post('cityName') ;
    $townName = Security::post('townName') ;
    $birthday = Security::post('birthday') ;

    // tc kimlik no validation START
    if(!$tcnumber){
        $text = "Lütfen TC Kimlik Numaranızı giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    if(!Helper::isNumber($tcnumber) || strlen($tcnumber)!=11){
        $text = "Lütfen Geçerli bir TC Kimlik Numarası giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    // tc kimlik no validation END

    // isim validation START           
    if(!$name){
        $text = "Lütfen Adınızı giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    } 
    if(!Helper::isLetter($name) || strlen($name) < 3){
        $text = "Lütfen Geçerli bir isim giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    // isim validation END

    // soyisim validation START           
    if(!$surname){
        $text = "Lütfen Soyadınızı giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    if(!Helper::isLetter($surname) || strlen($surname) < 3){
        $text = "Lütfen Geçerli bir soyisim giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    // soyisim validation END    

    if(!$patientGender){
        $text = "Lütfen cinsiyet giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    if(!$cityName){
        $text = "Lütfen doğum yerinizi il olarak  giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    if(!$townName){
        $text = "Lütfen doğum yerinizi ilçe olarak giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    if(!$birthday){
        $text = "Lütfen doğum tarihinizi giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    
    $isset = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ? AND patientName = ? AND patientSurname = ? AND patientGender = ? AND patientBirthCity = ? AND patientBirthTown = ? AND patientBirthDay = ?', [$tcnumber, $name, $surname, $patientGender, $cityName, $townName, $birthday]) ;

    if($isset){
        @$parolaSifirla = $DBConnect->updateRow('UPDATE patients SET patientPassword = ? WHERE patientID = ?', [NULL, $isset['patientID']]) ;
        if($parolaSifirla){
            $_SESSION['patientID'] = $isset['patientID'] ;
            $_SESSION['patientTCNumber'] = $isset['patientTCNumber'] ;
            $_SESSION['patientName'] = $isset['patientName'] ;
            $_SESSION['patientSurname'] = $isset['patientSurname'] ;
            $_SESSION['patientGender'] = $isset['patientGender'] ;
            $_SESSION['patientBirthCity'] = $isset['patientBirthCity'] ;
            $_SESSION['patientBirthTown'] = $isset['patientBirthTown'] ;
            $_SESSION['patientBirthDay'] = $isset['patientBirthDay'] ;
            $_SESSION['patientAge'] = $isset['patientAge'] ;
            $_SESSION['patientSignUpDate'] = $isset['patientSignUpDate'] ;
            $_SESSION['patientAddressTown'] = $isset['patientAddressTown'] ;
            $_SESSION['patientAddressCity'] = $isset['patientAddressCity'] ;
            $_SESSION['patientAddress'] = $isset['patientAddress'] ;
            $_SESSION['patientIPNumber'] = $isset['patientIPNumber'] ;
            $_SESSION['patientPhoto'] = $isset['patientPhoto'] ;
            $_SESSION['patientStatus'] = $isset['patientStatus'] ;
            $_SESSION['patientlogin'] = true ;
            echo Validation::warningMessage("Parola başarılı bir şekilde sıfırlanmıştır.", 'success',"","parolaGuncelle") ;
        }else{
            echo Validation::warningMessage("Parola sıfırlanma sırasında beklenmeyen bir hata meydana geldi. Daha sonra tekrar deneyiniz.", 'error') ;
            die() ; 
        }
    }else{
        echo Validation::warningMessage("Parola sıfırlanamadı. Lütfen bilgilerinizi kontrol edip tekrar giriniz.", 'error') ;
        die() ;                 
    }
    

   
break ;    
// parolaSifirla END

// parolaGuncelle START
case 'parolaGuncelle' :        
     
    $newpassword = Security::post('newpassword') ;
    $newpasswordagain = Security::post('newpasswordagain') ;
   
    if(!$newpassword){
        $text = "Lütfen yeni bir şifre giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    if(!$newpasswordagain){
        $text = "Lütfen şifrenizi tekrar giriniz" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    if(!($newpassword == $newpasswordagain)){
        $text = "Şifreleriniz eşleşmiyor" ;
        echo Validation::warningMessage($text) ;
        die() ;  
    }
    
    $newpassword = md5($newpassword) ;

    @$parolaGuncelle = $DBConnect->updateRow('UPDATE patients SET patientPassword = ? WHERE patientID = ? AND patientTCNumber = ?', [$newpassword, $_SESSION['patientID'], $_SESSION['patientTCNumber']]) ;
    if($parolaGuncelle){   
        $_SESSION['patientlogin'] = true ;    
        echo Validation::warningMessage("Parolanız başarılı bir şekilde güncellenmiştir.", 'success',"","patients") ;
    }else{
        echo Validation::warningMessage("Parola sıfırlanma sırasında beklenmeyen bir hata meydana geldi. Daha sonra tekrar deneyiniz.", 'error') ;
        die() ; 
    }
        

   
break ;    
// parolaGuncelle END

    // editProfile START
    case 'editProfile' :         
        
       
        $name = Security::post('name') ;
        $surname = Security::post('surname') ;
        $cityAddress = Security::post('cityAddress') ;
        $townAddress = Security::post('townAddress') ;
        $address = Security::post('address') ;      

        // isim validation START           
        if(!$name){
            $text = "Lütfen Adınızı giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        } 
        if(!Helper::isLetter($name) || strlen($name) < 3){
            $text = "Lütfen Geçerli bir isim giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        // isim validation END

        // soyisim validation START           
        if(!$surname){
            $text = "Lütfen Soyadınızı giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        if(!Helper::isLetter($surname) || strlen($surname) < 3){
            $text = "Lütfen Geçerli bir soyisim giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        // soyisim validation END       
      
      
        if(!$cityAddress){
            $text = "Lütfen adresinizi il olarak giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        if(!$townAddress){
            $text = "Lütfen adresinizi ilçe olarak giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;   
        }
        if(!$address){
            $text = "Lütfen adresinizi ilçe olarak giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;   
        }
        
        $editProfile = $DBConnect->updateRow('UPDATE patients SET
            patientName = ?,
            patientSurname = ?,
            patientAddressTown = ?,
            patientAddressCity = ?,
            patientAddress = ? WHERE patientID  = ? AND patientTCNumber = ?
        ',[
            Helper::convertLetter($name,'lower'),
            Helper::convertLetter($surname,'lower'),
            $townAddress,
            $cityAddress,
            Helper::convertLetter($address,'lower'),
            $_SESSION['patientID'],
            $_SESSION['patientTCNumber']
        ]) ;
        if($editProfile){           
             echo Validation::warningMessage("Bilgileriniz başarılı bir şekilde güncellenmiştir.", 'success', '', 'patients') ;
             die() ;                 
        }else{
            echo Validation::warningMessage("Kayıt sırasında beklenmeyen bir hata meydana geldi.", 'error') ;
             die() ;   
        } 
        

       
    break ;    
// editProfile END

    // editPassword START
    case 'editPassword' : 
       
        $expassword = Security::post('expassword') ;
        $newpassword = Security::post('newpassword') ;
        $newpasswordagain = Security::post('newpasswordagain') ;
                
        if(!$expassword){
            $text = "Lütfen eski parolanızı giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        } 
        if(!$newpassword){
            $text = "Lütfen yeni bir parola giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }              
        if(!$newpasswordagain){
            $text = "Lütfen yeni parolayı tekrar giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        if(!($newpasswordagain == $newpassword)){
            $text = "Şifreleriniz eşleşmiyor" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
           
        $expassword = md5($expassword) ;
        $newpassword = md5($newpassword) ;

        $issetPatient = $DBConnect->getRow('SELECT * FROM patients WHERE patientPassword  = ? AND patientID = ? AND patientTCNumber = ?',[$expassword, $_SESSION['patientID'], $_SESSION['patientTCNumber']]) ;
        if($issetPatient){           
            $editPassword = $DBConnect->updateRow('UPDATE patients SET patientPassword = ? WHERE patientID  = ? AND patientTCNumber = ?',[$newpassword, $_SESSION['patientID'], $_SESSION['patientTCNumber']]) ;
            if($editPassword){           
                 echo Validation::warningMessage("Bilgileriniz başarılı bir şekilde güncellenmiştir.", 'success', '', 'patients') ;
                 die() ;                 
            }else{
                echo Validation::warningMessage("Kayıt sırasında beklenmeyen bir hata meydana geldi.", 'error') ;
                 die() ;   
            }                
       }else{
           echo Validation::warningMessage("Böyle bir kullanıcı bulunamadı", 'error') ;
           die() ;   
       } 

       
    break ;    
// editPassword END

    // editProfile START
    case 'adminEditProfile' :         
        
       
        $name = Security::post('name') ;
        $surname = Security::post('surname') ; 

        // isim validation START           
        if(!$name){
            $text = "Lütfen Adınızı giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        } 
        if(!Helper::isLetter($name) || strlen($name) < 3){
            $text = "Lütfen Geçerli bir isim giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        // isim validation END

        // soyisim validation START           
        if(!$surname){
            $text = "Lütfen Soyadınızı giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        if(!Helper::isLetter($surname) || strlen($surname) < 3){
            $text = "Lütfen Geçerli bir soyisim giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        // soyisim validation END       
      

        $editProfile = $DBConnect->updateRow('UPDATE admins SET
            adminName = ?,
            adminSurname = ? WHERE adminID  = ? AND adminTCNumber = ?
        ',[
            Helper::convertLetter($name,'lower'),
            Helper::convertLetter($surname,'lower'),
            $_SESSION['adminID'],
            $_SESSION['adminTCNumber']
        ]) ;
        if($editProfile){           
             echo Validation::warningMessage("Bilgileriniz başarılı bir şekilde güncellenmiştir.", 'success', '', 'admin') ;
             die() ;                 
        }else{
            echo Validation::warningMessage("Kayıt sırasında beklenmeyen bir hata meydana geldi.", 'error') ;
             die() ;   
        } 
        

       
    break ;    
// editProfile END

    // editPassword START
    case 'adminEditPassword' : 
       
        $expassword = Security::post('expassword') ;
        $newpassword = Security::post('newpassword') ;
        $newpasswordagain = Security::post('newpasswordagain') ;
                
        if(!$expassword){
            $text = "Lütfen eski parolanızı giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        } 
        if(!$newpassword){
            $text = "Lütfen yeni bir parola giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }              
        if(!$newpasswordagain){
            $text = "Lütfen yeni parolayı tekrar giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        if(!($newpasswordagain == $newpassword)){
            $text = "Şifreleriniz eşleşmiyor" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
           
        $expassword = md5($expassword) ;
        $newpassword = md5($newpassword) ;

        $issetAdmin = $DBConnect->getRow('SELECT * FROM admins WHERE adminPassword  = ? AND adminID = ? AND adminTCNumber = ?',[$expassword, $_SESSION['adminID'], $_SESSION['adminTCNumber']]) ;
        if($issetAdmin){           
            $editPassword = $DBConnect->updateRow('UPDATE admins SET adminPassword = ? WHERE adminID  = ? AND adminTCNumber = ?',[$newpassword, $_SESSION['adminID'], $_SESSION['adminTCNumber']]) ;
            if($editPassword){           
                 echo Validation::warningMessage("Bilgileriniz başarılı bir şekilde güncellenmiştir.", 'success', '', 'admin') ;
                 die() ;                 
            }else{
                echo Validation::warningMessage("Kayıt sırasında beklenmeyen bir hata meydana geldi.", 'error') ;
                 die() ;   
            }                
       }else{
           echo Validation::warningMessage("Böyle bir kullanıcı bulunamadı", 'error') ;
           die() ;   
       } 

       
    break ;    
// editPassword END



}//swtich END





?>
    
