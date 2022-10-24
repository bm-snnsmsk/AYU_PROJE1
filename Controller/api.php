<?php
require_once "../Config/init.php" ;
$process = $_GET['process'] ;
session_start() ;

switch($process){

    // list towns START
    case 'getTowns' :             
        $ID = $_POST['cityID'] ;  
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
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen TC Kimlik Numaranızı giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!Helper::isNumber($tcnumber) || strlen($tcnumber)!=11){
                $icon = "warning" ;
                $title ='Oops! Dikkat' ;
                $text = "Lütfen Geçerli bir TC Kimlik Numarası giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            // tc kimlik no validation END

            // isim validation START           
            if(!$name){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen Adınızı giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            } 
            if(!Helper::isLetter($name) || strlen($name) < 3){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen Geçerli bir isim giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            // isim validation END

            // soyisim validation START           
            if(!$surname){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen Soyadınızı giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!Helper::isLetter($surname) || strlen($surname) < 3){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen Geçerli bir soyisim giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            // soyisim validation END
            
            // password validation START 
            if(!$password){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen şifrenizi giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$passwordagain){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen şifrenizi tekrar giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!($passwordagain == $password)){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Şifreleriniz uyuşmuyor. Lütfen tekrar deneyiniz." ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            // password validation END

            if(!$patientGender){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen cinsiyet giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$cityName){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen doğum yerinizi il olarak  giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$townName){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen doğum yerinizi ilçe olarak giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$birthday){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen doğum tarihinizi giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$cityAddress){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen adresinizi il olarak giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$townAddress){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen adresinizi ilçe olarak giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$address){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen adresinizi tam olarak giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
    
            $patientPhoto = ($patientGender == 'K') ? 'kadin_avatar.png' : 'erkek_avatar.png' ;
            $password = md5(uniqid(md5($password))) ;
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
                $icon = "success" ;
                $title = 'Oops! Dikkat' ;
                $text = "Kaydınız başarılı bir şekilde gerçekleştirildi." ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Helper::url('patients')]) ;
                die() ;
            }else{
                $icon = "error" ;
                $title = 'Oops! Dikkat' ;
                $text = "Kayıt sırasında beklenmeyen bir hata meydana geldi." ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            } 
            

           
        break ;    
    // add patient END

    case 'login' :
        $tcnumber = Security::post('tcnumber') ;
        $password = Security::post('password') ;

            if(!$tcnumber){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen tc kimlik no giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
            if(!$password){
                $icon = "warning" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen şifrenizi giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                die() ;
            }
          
            $query = $DBConnect->getRow('SELECT * FROM patients WHERE patientTCNumber = ?', [$tcnumber]) ;
            if($query){
                //Helper::test($query);
                $_SESSION['patienttckimlikno'] = $query['patientTCNumber'] ;
                $_SESSION['patientname'] = $query['patientName'] ;
                $_SESSION['patientsurname'] = $query['patientSurname'] ;
                $_SESSION['patientlogin'] = true ;

                $icon = "success" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen tc kimlik no giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Helper::url('patients')]) ;
                die() ;
            }else{
                if(!$data['tckimlikno']){
                    $icon = "error" ;
                    $title = 'Oops! Dikkat' ;
                    $text = "Giriş esnasında bir hata meydana geldi" ;
                    echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
                    die() ;
                }
            }    
       
    break ;       

}




?>