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
                $icon = "success" ;
                $title = 'Oops! Dikkat' ;
                $text = "Kaydınız başarılı bir şekilde gerçekleştirildi." ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Router::url('patients')]) ;
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
                //Router::test($query);
                $_SESSION['patienttckimlikno'] = $query['patientTCNumber'] ;
                $_SESSION['patientname'] = $query['patientName'] ;
                $_SESSION['patientsurname'] = $query['patientSurname'] ;
                $_SESSION['patientlogin'] = true ;

                $icon = "success" ;
                $title = 'Oops! Dikkat' ;
                $text = "Lütfen tc kimlik no giriniz" ;
                echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Router::url('patients')]) ;
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
    
    // list hospital START
    case 'getHospitals' :             
        $ID = Security::post('cityID') ;  
        $myOption = '<option value="0">Hastane</option>'  ;  
        $hospitals = $DBConnect->getRows('SELECT * FROM hospitals WHERE hospitalCityID = ? ORDER BY hospitalName',[$ID]) ;
        foreach($hospitals as $key => $value){
            $myOption .= '<option value="'.$value['hospitalID'].'">'.$value['hospitalName'].'</option>'  ; 
        }
        echo $myOption ;
    break ; 
    // list hospital END

    // list poliklinik START
    case 'getPoliklinik' :             
        $ID = Security::post('hospitalID') ;  
        $myOption = '<option value="0">Poliklinikler</option>'  ;  
        $poliklinik = $DBConnect->getRows('SELECT * FROM poliklinik WHERE poliklinikHospitalID = ? ORDER BY poliklinikName ASC',[$ID]) ;
        foreach($poliklinik as $key => $value){
            $myOption .= '<option value="'.$value['poliklinikID'].'">'.$value['poliklinikName'].'</option>'  ; 
        }
        echo $myOption ;
    break ; 
    // list poliklinik END

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

     
    // add patient START
    case 'randevual' :         
        
        $cityHospital = Security::post('cityHospital') ;
        $hospitals = Security::post('hospitals') ;
        $poliklinik = Security::post('poliklinik') ;
        $doctors = Security::post('doctors') ;
        $seans = Security::post('seans') ;

        // cityHospital validation START
        if(!$cityHospital){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Lütfen bir şehir seçin" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }       
        // tc kimlik no validation END

        // hospital validation START           
        if(!$hospitals){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Hastane seçiniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }        
        // hospital validation END

         // poliklinik validation START           
         if(!$poliklinik){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Poliklinik seçiniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }        
        // poliklinik validation END

         // doctor validation START           
         if(!$doctors){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Doktor seçiniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }        
        // doktor validation END

         // seans validation START           
         if(!$seans){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Seans seçiniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }        
        // seans validation END
        $seansArr = ['seans0900', 'seans0920','seans0940','seans1000', 'seans1020','seans1040','seans1100', 'seans1120','seans1140','seans1330', 'seans1350','seans1410','seans1430', 'seans1450','seans1510','seans1530', 'seans1550','seans1610','seans1630', 'seans1650'] ;

        $s = "" ;
        if(array_search($seans, $seansArr)){
            $s = $seansArr[array_search($seans, $seansArr)] ;
        }

        $seansDate = date('Y-m-d') ;

      $query0 = $DBConnect->addRow('INSERT INTO randevu (randevuPatientID, randevuHospital, randevuBolum, randevuDoctor,randevuDate,randevuHour,randevuAddTime) VALUES (?,?,?,?,?,?,?)',[$_SESSION['patientID'], $hospitals, $poliklinik, $doctors, $seansDate, $s, $seansDate]) ; 
       $query1 = $DBConnect->updateRow('UPDATE seans SET '.$s.' = ? WHERE seansDoctorID = ? AND seansPoliklinikID = ?',['D', $doctors, $poliklinik]) ; 
        if($query0 && $query1){
            $icon = "success" ;
            $title = 'Oops! Dikkat' ;
            $text = "Randevunuz başarılı bir şekilde oluşturuldu." ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Router::url('patients')]) ;
            die() ;
        }else{
            $icon = "error" ;
            $title = 'Oops! Dikkat' ;
            $text = "Randevu alma sırasında beklenmeyen bir hata meydana geldi." ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }  
        

       
    break ;    
// add patient END


  // gethospitals START
    case 'listHospital' :             
        $ID = Security::post('cityID') ;  
        $result = '<option value="0">Hastaneler</option>'  ;  
        $query = $DBConnect->getRows('SELECT * FROM hospitals WHERE hospitalCityID = ? ORDER BY hospitalName',[$ID]) ;
      
        foreach($query as $key => $value){
            $result .= '<option value="'.$value['hospitalID'].'">'.$value['hospitalName'].'</option>'  ; 
        }
        echo $result ;
    break ; 
// gethospitals END

  // addhospital START
    case 'addHospital' :             
        $ID = Security::post('cityHospital') ;  
        $hospitalname = Security::post('hospitalname') ;

        if(!$ID){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Lütfen şehir seçiniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }

        if(!$hospitalname){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Lütfen hastane ismini giriniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }
        
        $query = $DBConnect->addRow('INSERT INTO hospitals (hospitalName, hospitalCityID) VALUES (?, ?) ',[$hospitalname, $ID]) ;
      
                
        if($query){          
            $icon = "success" ;
            $title = 'Oops! Dikkat' ;
            $text = "Hastane ekleme işlemi başarılı bir şekilde gerçekleştirildi." ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Router::url('hospitals')]) ;
            die() ;
        }else{
            $icon = "error" ;
            $title = 'Oops! Dikkat' ;
            $text = "Kayıt sırasında beklenmeyen bir hata meydana geldi." ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        } 
    break ; 
// addhospital END


  // editHospital START
    case 'editHospital' :             
        $cityID = Security::post('cityID') ;  
        $hospitalname = Security::post('hospitalname') ;
        $editID = Security::post('editID') ;

        if(!$cityID){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Lütfen şehir seçiniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }

        if(!$hospitalname){
            $icon = "warning" ;
            $title = 'Oops! Dikkat' ;
            $text = "Lütfen hastane ismini giriniz" ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        }
        
        $query = $DBConnect->updateRow('UPDATE hospitals SET hospitalName = ?, hospitalCityID = ? WHERE hospitalID = ?',[$hospitalname, $cityID, $editID]) ;
      
                
        if($query){          
            $icon = "success" ;
            $title = 'Oops! Dikkat' ;
            $text = "Hastane ekleme işlemi başarılı bir şekilde gerçekleştirildi." ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text, 'redirect' => Router::url('hospitals')]) ;
            die() ;
        }else{
            $icon = "error" ;
            $title = 'Oops! Dikkat' ;
            $text = "Kayıt sırasında beklenmeyen bir hata meydana geldi." ;
            echo json_encode(['icon' => $icon, 'title' => $title, 'text' => $text]) ;
            die() ;
        } 
    break ; 
// editHospital END

}//swtich END





?>
            



            




