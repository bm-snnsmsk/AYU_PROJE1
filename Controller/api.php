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
            $doctorFullName = Helper::convertLetter($value['doctorName'], 'upperWords').' '.Helper::convertLetter($value['doctorSurname'], 'upper') ;
            $myOption .= '<option value="'.$value['doctorID'].'">'.$doctorFullName.'</option>'  ; 
        }
        echo $myOption ;
    break ; 
    // list getDoctors END

    // list getAvailableAppointments START
    case 'getAvailableAppointments' :             
        $ID = Security::post('doctorID') ;  
        
        $result = ''  ;  
        
        $sayac = 0 ;
       
        for($i = 0 ; $i < 15 ; $i++){

            $today = date_create(date('d-m-Y'));
            date_modify($today, '+'.(++$sayac).' day');
            $day = date_format($today, 'd-m-Y')." - ".mb_strtoupper(Helper::weekday(date_format($today, 'w'))) ;
            $seans = $DBConnect->getRow('SELECT * FROM seans WHERE seansDoctorID = ? AND seansDate = ? AND seansStatus = ?',[$ID, date_format($today, 'Y-m-d'),1]) ;

            if($seans > 0){ ## seans tablosunda kayıt varsa kayıt varsa
                if((date_format($today, 'w') == 6) || (date_format($today, 'w') == 0)){
                    continue ;
                }else{
                    $result.='<div class="alert alert-primary mt-2" role="alert">'.$day.'</div> <div>' ;
    
                    if($seans && $seans['seans0900'] == 'B'){
                        $result.= Helper::setSeans(1,"09.00", $day) ;
                    }    
                             
                    if($seans && $seans['seans0920'] == 'B'){
                        $result.= Helper::setSeans(2,"09.20", $day) ;
                    } 
            
                    if($seans && $seans['seans0940'] == 'B'){
                        $result.= Helper::setSeans(3,"09.40", $day) ;
                    } 
            
                    if($seans && $seans['seans1000'] == 'B'){
                        $result.= Helper::setSeans(4,"10.00", $day) ;
                    }    
            
                    if($seans && $seans['seans1020'] == 'B'){
                        $result.= Helper::setSeans(5,"10.20", $day) ;
                    }
                            
                    if($seans && $seans['seans1040'] == 'B'){
                        $result.= Helper::setSeans(6,"10.40", $day) ;
                    }
                             
                    if($seans && $seans['seans1100'] == 'B'){
                        $result.= Helper::setSeans(7,"11.00", $day) ;
                    }   
            
                    if($seans && $seans['seans1120'] == 'B'){
                        $result.= Helper::setSeans(8,"11.20", $day) ;
                    }          
                    if($seans && $seans['seans1140'] == 'B'){
                        $result.= Helper::setSeans(9,"11.40", $day) ;
                    }          
                    if($seans && $seans['seans1330'] == 'B'){
                        $result.= Helper::setSeans(10,"13.30", $day) ;
                    }          
                    if($seans && $seans['seans1350'] == 'B'){
                        $result.= Helper::setSeans(11,"13.50", $day) ;
                    }          
                    if($seans && $seans['seans1410'] == 'B'){
                        $result.= Helper::setSeans(12,"14.10", $day) ;
                    }          
                    if($seans && $seans['seans1430'] == 'B'){
                        $result.= Helper::setSeans(13,"14.30", $day) ;
                    }   
            
                    if($seans && $seans['seans1450'] == 'B'){
                        $result.= Helper::setSeans(14,"14.50", $day) ;
                    }          
                    if($seans && $seans['seans1510'] == 'B'){
                        $result.= Helper::setSeans(15,"15.10", $day) ;
                    }          
                    if($seans && $seans['seans1530'] == 'B'){
                        $result.= Helper::setSeans(16,"15.30", $day) ;
                    }  
            
                    if($seans && $seans['seans1550'] == 'B'){
                        $result.= Helper::setSeans(17,"15.50", $day) ;
                    }          
                    if($seans && $seans['seans1610'] == 'B'){
                        $result.= Helper::setSeans(18,"16.10", $day) ;
                    }          
                    if($seans && $seans['seans1630'] == 'B'){
                        $result.= Helper::setSeans(19,"16.30", $day) ;
                    }    
                    if($seans && $seans['seans1650'] == 'B'){
                        $result.= Helper::setSeans(20,"16.50", $day) ;
                    }   
                    $result.="</div>" ;  
                }
            }
            
            
        }
         
              
        echo $result ;
    break ; 
// list getAvailableAppointments END

     
// randevualt START
case 'randevual' :        
        
        $poliklinik = Security::post('poliklinik') ;
        $doctors = Security::post('doctors') ;
        $seans = Security::post('selected_seans') ;

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

        // $seans = "19-12-2022 - PAZARTESI - 09.40"
        $seans_hour = explode('.',substr($seans,-5)) ; // $seans = ["09","00"]
        $seans_hour = join($seans_hour) ; // $seans = "0900"

        // $seans = "19-12-2022 - PAZARTESI - 09.40"
        $seans_day = explode('-',$seans) ; // $seans_day = ["19","12","2022","PAZARTESİ","09.00"]
        $seans_day = $seans_day[3] ; // $seans_day = "PAZARTESI"

        // $seans = "19-12-2022 - PAZARTESI - 09.40"
        $seans_date = substr($seans,0, 10) ;
        $seans_date = date_create($seans_date);
        $seans_date = date_format($seans_date, 'Y-m-d') ;;



       
      
        ## randevu sayısı controlü // bir kişi en fazla 3 farklı randevu alabilir
        $randevu_count = $DBConnect->getColumn('SELECT patientRandevuCount FROM patients WHERE patientID = ? ',[$_SESSION['patientID']]) ; 
        if($randevu_count < 3){
            
            ## randevu doktor controlü // bir kişi bir doktordan veya bir bölümden farklı zamanlarda bile olsa en fazla 1 randevu alabilir
            $randevu_doctor = $DBConnect->getRows('SELECT randevuDoctorID, randevuBolum FROM randevu WHERE randevuPatientID = ? ',[$_SESSION['patientID']]) ; 
            if($randevu_doctor > 0){
                foreach($randevu_doctor as $val){
                    if(($val["randevuDoctorID"] == $doctors) || ($val["randevuBolum"] == $poliklinik)){
                        echo Validation::warningMessage("Aynı doktordan veya aynı bölümden randevunuz bulunmaktadır. Bu randevuyu almak istiyorsanız lütfen mevcut randevunuzu iptal edip tekrar deneyiniz.", "error") ;
                        die() ;
                    }
                }
            }

            ## randevu oluşturma
            $query0 = $DBConnect->addRow('INSERT INTO randevu (randevuPatientID, randevuBolum, randevuDay, randevuDoctorID,randevuDate, randevuHour) VALUES (?,?,?,?,?,?)',[$_SESSION['patientID'],$poliklinik,$seans_day, $doctors, $seans_date, $seans_hour]) ; 
            ## belirlene doktora ait alınan randevu günü ve saatini seans tablosundan pasifleştirme
            $query1 = $DBConnect->updateRow('UPDATE seans SET seans'.$seans_hour.' = ? WHERE seansDoctorID = ? AND seansPoliklinikID = ? AND seansDate = ?',['D', $doctors, $poliklinik, $seans_date]) ; 
            if($query0 && $query1){
                echo Validation::warningMessage("Randevunuz başarılı bir şekilde oluşturuldu." ,"success",'','patients') ;
                $randevu_count++ ;
                $DBConnect->updateRow('UPDATE patients SET patientRandevuCount = ? WHERE patientID = ? ',[$randevu_count, $_SESSION['patientID']]) ; 
                die() ;
            }else{
                echo Validation::warningMessage("Randevu alma sırasında beklenmeyen bir hata meydana geldi.", "error") ;
                die() ;
            }

        }else{
            echo Validation::warningMessage("Randevu sayısını aştınız. Öncelikle bir tane randevunuzu iptal ediniz. Sonra tekrar deneyiniz.", "error") ;
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
    $doctorUnvan = Security::post('doctorUnvan') ;
    $doctorName = Security::post('doctorName') ;
    $doctorSurname = Security::post('doctorSurname') ;
    $doctorTCNumber = Security::post('doctorTCNumber') ;
    $doctorPhoneNumber = Security::post('doctorPhoneNumber') ;

    $cityName = Security::post('cityName') ;
    $townName = Security::post('townName') ;
    $birthday = Security::post('birthday') ;
    $doctorGender = Security::post('doctorGender') ;

    $doctorPhoto = ($doctorGender == 'K') ? 'kadin_avatar.png' : 'erkek_avatar.png' ;

  
    if(!$poliklinikName){
        echo Validation::warningMessage("Lütfen poliklinik adı giriniz.") ;
        die() ;
    }
    if(!$doctorUnvan){
        $doctorUnvan = "uzm. dr. " ;
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


   
    if(!$cityName){
        echo Validation::warningMessage("Lütfen il alanını boş bırakmayınız !") ;
        die() ;
    }
    if(!$townName){
        echo Validation::warningMessage("Lütfen ilçe alanını boş bırakmayınız !") ;
        die() ;
    }
    if(!$birthday){
        echo Validation::warningMessage("Lütfen doğum tarihi alanını boş bırakmayınız !") ;
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

    $firstpassword = md5($doctorTCNumber) ;
    
    $query = $DBConnect->addRow('INSERT INTO doctors (doctorGender,doctorBirthDay, doctorBirthCity, doctorBirthTown,  doctorUnvan, doctorName, doctorSurname, doctorTCNumber, doctorPassword, doctorPhoneNumber,doctorPoliklinikID, doctorPhoto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ',[$doctorGender, $birthday, $cityName, $townName, $doctorUnvan, $doctorName, $doctorSurname, $doctorTCNumber, $firstpassword, $doctorPhoneNumber, $poliklinikName, $doctorPhoto]) ;
     
    if($query){          
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

    // editSetting START
    case 'editSetting' : 
       
        $pageTitle = Security::post('pageTitle') ;
        $pageHospitalName = Security::post('pageHospitalName') ;
        $pageDescription = Security::post('pageDescription') ;
        $pageKeyword = Security::post('pageKeyword') ;
        $pageUrl = Security::post('pageUrl') ;
        $pageHosting = Security::post('pageHosting') ;
                
        if(!$pageTitle){
            $text = "Lütfen başlık bilgisini giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        } 

        if(!$pageHospitalName){
            $text = "Lütfen hastane adı bilgisini giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        } 

        if(!$pageDescription){
            $text = "Lütfen site açıklama bilgisini giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }              
        if(!$pageKeyword){
            $text = "Lütfen site anahtar kelime bilgisini giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        if(!$pageUrl){
            $text = "Lütfen sayfa URL bilgisini giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
        if(!$pageHosting){
            $text = "Lütfen sayfa Hosting bilgisini giriniz" ;
            echo Validation::warningMessage($text) ;
            die() ;  
        }
           
       
        $settings = $DBConnect->updateRow('UPDATE settings SET 
        settingTitle = ?, 
        settingHospitalName = ?, 
        settingDescription = ?,
        settingKeyword = ?,
        settingUrl = ?,
        settingHost = ?
        WHERE settingID = ?', [$pageTitle, $pageHospitalName, $pageDescription, $pageKeyword, $pageUrl, $pageHosting, 1]) ; 
        if($settings){           
                echo Validation::warningMessage("Site Ayarlarınız başarılı bir şekilde güncellenmiştir.", 'success', '', 'pagesettings') ;
                die() ;                 
            }else{
                echo Validation::warningMessage("Site ayarlama sırasında beklenmeyen bir hata meydana geldi.", 'error') ;
                die() ;   
        } 

       
    break ;    
// editSetting END


    // changeSeans START
    case 'changeSeans' :             
        $doctorID = Security::post('doctorID') ;  
        $seansTime = Security::post('seansTime') ;  
        $seansDate = Security::post('seansDate') ;  
        $seansVal = Security::post('seansVal') ;  

        $changeVal = ($seansVal == 'D') ? 'B' : 'D' ;

        $seansArr = ['seans0900', 'seans0920','seans0940','seans1000', 'seans1020','seans1040','seans1100', 'seans1120','seans1140','seans1330', 'seans1350','seans1410','seans1430', 'seans1450','seans1510','seans1530', 'seans1550','seans1610','seans1630', 'seans1650'] ;

        $seanstime = substr($seansArr[$seansTime], -4) ;

        $changeSeans = $DBConnect->updateRow('UPDATE seans SET seans'.$seanstime.' = ? WHERE seansDoctorID = ? AND seansDate = ?',[$changeVal, $doctorID, $seansDate]) ;
        $deleteRandevu = $DBConnect->updateRow('UPDATE randevu SET randevuStatus = ? WHERE randevuHour = ? AND randevuDoctorID = ? AND randevuDate = ?',[0, $seanstime, $doctorID, $seansDate]) ;

       
       echo 'sonuc: '.$changeSeans.' - randevusonuc : '.$deleteRandevu.'- gelen değer : '.$seansVal.', chenge değer :  '.$changeVal.',  seanstime'.$seanstime.',doktorID '.$doctorID.' - seansDate : '.$seansDate;
        break ; 
    // changeSeans END



// addSeans START
    case 'addSeans' :
        $poliklinikName = Security::post('poliklinikName') ;
        $doctor = Security::post('doctor') ;
        $seansdate = Security::post('seansdate') ;


        if(!$poliklinikName){
            echo Validation::warningMessage("Lütfen bir poliklinik seçiniz.") ;
            die() ;
        }
        if(!$doctor){
            echo Validation::warningMessage("Lütfen bir doktor seçiniz.") ;
            die() ;
        }
        if(!$seansdate){
            echo Validation::warningMessage("Lütfen bir tarih seçiniz.") ;
            die() ;
        }
  
        $addSeans = $DBConnect->addRow('INSERT INTO seans (seansPoliklinikID, seansDoctorID, seansDate) VALUES (?, ?, ?) ',[$poliklinikName, $doctor, $seansdate]) ;

        if($addSeans){  
            echo Validation::warningMessage("Seans tanımlama işlemi başarılı bir şekilde gerçekleştirildi.","success",'','seans') ;
            die() ;
        }else{
            echo Validation::warningMessage("Seans tanımlama sırasında beklenmeyen bir hata meydana geldi.","error") ;
            die() ;
        }  
    break ; 
// addSeans END



    // doctorEditProfile START
    case 'doctorEditProfile' :         
        
       
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
        
        $editProfile = $DBConnect->updateRow('UPDATE doctors SET
            doctorName = ?,
            doctorSurname = ?,
            doctorAddressTown = ?,
            doctorAddressCity = ?,
            doctorAddress = ? WHERE doctorID  = ? AND doctorTCNumber = ?
        ',[
            Helper::convertLetter($name,'lower'),
            Helper::convertLetter($surname,'lower'),
            $townAddress,
            $cityAddress,
            Helper::convertLetter($address,'lower'),
            $_SESSION['doctorID'],
            $_SESSION['doctorTCNumber']
        ]) ;
        if($editProfile){           
             echo Validation::warningMessage("Bilgileriniz başarılı bir şekilde güncellenmiştir.", 'success', '', 'profiledoctor') ;
             die() ;                 
        }else{
            echo Validation::warningMessage("Kayıt sırasında beklenmeyen bir hata meydana geldi.", 'error') ;
             die() ;   
        } 
        

       
    break ;    
// doctorEditProfile END

    // doctorEditPassword START
    case 'doctorEditPassword' : 
       
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

        $issetDoctor = $DBConnect->getRow('SELECT * FROM doctors WHERE doctorPassword  = ? AND doctorID = ? AND doctorTCNumber = ?',[$expassword, $_SESSION['doctorID'], $_SESSION['doctorTCNumber']]) ;
        if($issetDoctor){           
            $editPassword = $DBConnect->updateRow('UPDATE doctors SET doctorPassword = ? WHERE doctorID  = ? AND doctorTCNumber = ?',[$newpassword, $_SESSION['doctorID'], $_SESSION['doctorTCNumber']]) ;
            if($editPassword){           
                 echo Validation::warningMessage("Bilgileriniz başarılı bir şekilde güncellenmiştir.", 'success', '', 'profiledoctor') ;
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
// doctorEditPassword END





}//swtich END





?>
    
