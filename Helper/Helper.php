<?php

class Helper{

    

    public function __construct(){
       //error_reporting(0) ;
    }   
    public static function test($param = "TEST BAŞARILI"){
        if(!is_array($param)){
            echo('<div style="min-height:100px; padding:10px; margin:5px; background-color:#1d1d1d; color:greenyellow; font-size:22px; ">'.$param.'</div>');
        }else{
            echo('<pre style="min-height:100px; padding:10px; margin:5px; background-color:#1d1d1d; color:greenyellow;">') ;
            print_r($param) ;
            echo("</pre>");
        }  
        echo '<div style="margin:20px 5px;"><a style="padding:10px; background-color:#1d1d1d; font-size:22px; text-decoration:none; color:greenyellow;" href="'.
        @$_SERVER['HTTP_REFERER'].'">Geri Dön</a></div>' ;
        die() ;
    }
    public static function sefLink($text){ // SEO uyumlu link
        $text = trim($text) ;
        $tr = ["ç","Ç","ğ","Ğ","ı","I","i","İ","ö","Ö","ş","Ş","ü","Ü"] ;
        $en = ["c","c","g","g","i","i","i","i","o","o","s","s","u","u"] ;
        $text = str_replace($tr, $en, $text) ;
        $text = mb_strtolower($text, "UTF-8") ;
        $text = preg_replace("/[^a-z0-9]/", "-", $text) ; 
        $text = preg_replace("/-+/", "-", $text) ;
        $text = trim($text, "-") ;
        return $text ;
    }    
    public static function convertLetter($text, $case){        
        $lower = ['ç','ğ','ı','i','ö','ş','ü'] ;
        $upper = ['Ç','Ğ','I','İ','Ö','Ş','Ü'] ;
        $lengthText = mb_strlen($text, "utf-8") ;
        $firstLetter = mb_substr($text, 0, 1, 'utf-8') ;
        $otherLetters = mb_substr($text, 1, $lengthText, 'utf-8') ;
        switch($case){
            case "upper" : 
                           $replace = str_replace($lower, $upper, $text) ;
                           $result = strtoupper($replace) ; 
                           return $result ;
                           break ;
            case "lower" : 
                           $replace = str_replace($upper, $lower, $text) ;
                           $result = strtolower($replace) ;
                           return $result ;
                           break ;  
            case "firstUpper" :
                           $replaceFirst = str_replace($lower, $upper, $firstLetter) ;
                           $replaceOthers = str_replace($upper, $lower, $otherLetters) ;
                           $replaceFirst = strtoupper($replaceFirst) ;
                           $replaceOthers = strtolower($replaceOthers) ;
                           return $replaceFirst.$replaceOthers ;
                           break ;
            case "firstLower" : 
                           $replaceFirst = str_replace($upper, $lower, $firstLetter) ;
                           $replaceOthers = str_replace($lower, $upper, $otherLetters) ;
                           $replaceFirst = strtolower($replaceFirst) ;
                           $replaceOthers = strtoupper($replaceOthers) ;
                           return $replaceFirst.$replaceOthers ;
                           break ;
            case "upperWords" : 
                           $arr = explode(" ", $text) ; // boşluk esas alındı - / gibi seperatorler dikkate alınmadı
                           $txt = "" ;
                           foreach($arr as $key => $value){
                                $firstLetter = mb_substr($value, 0, 1, 'utf-8') ;
                                $otherLetters = mb_substr($value, 1, mb_strlen($value, "utf-8"), 'utf-8') ;
                                $replaceFirst = str_replace($lower, $upper, $firstLetter) ;
                                $replaceOthers = str_replace($upper, $lower, $otherLetters) ;
                                $replaceFirst = strtoupper($replaceFirst) ;
                                $replaceOthers = strtolower($replaceOthers) ;
                                $txt .=   $replaceFirst.$replaceOthers." " ;
                           }
                           return $txt ;
                           break ;   
            default      : 
                           return ; 
                           break ;                      
        }
    }
    public static function isLetter($text){
        $regExp = "/[^a-zA-ZçğıöşüÇĞIİÖŞÜ]/u" ;
        $result = preg_match($regExp, Security::security($text)) ? false : true ;
        return $result ;
    }
    public static function isNumber($text){
        $regExp = '/[^0-9]/' ;
        $result = preg_match($regExp, Security::security($text)) ? false : true ;
        return $result ;
    }
    public static function isEmail($text){
        $result = filter_var(Security::security($text), FILTER_VALIDATE_EMAIL) ;
        return $result ;
    }    
    public static function isPhone($text){
        $regExp1 = '/^\s*\+?\s*\d{0,2}\s*\(?5\d{2}\)?\s*-?\s*\d{3}\s*-?\s*[0-9]{2}\s*-?\s*[0-9]{2}\s*$/' ; // for isPhone (mobile phone)
        $regExp2 = '/^\s*\+?\s*\d{0,2}\s*\(?\d{3}\)?\s*-?\s*\d{3}\s*-?\s*[0-9]{2}\s*-?\s*[0-9]{2}\s*$/' ; // for isPhone (home phone)
        $isMobilePhone = preg_match($regExp1, Security::security($text)) ;
        $isHomePhone = preg_match($regExp2, Security::security($text)) ;
        $regExp3 = '/[-\(\) ]/' ; // for to Phone
        $replace = "" ;
        $toPhone = preg_filter($regExp3, $replace, Security::security($text)) ;
        return ['isMobilePhone' => $isMobilePhone, 'isHomePhone' => $isHomePhone,'toPhone' => $toPhone, 'phoneLength' => strlen($toPhone)] ;
    }
    public static function dateConvert($date){
        $date = explode('-', $date) ;
        $result = $date[2].'.'.$date[1].'.'.$date[0] ;
        return $result ;
    }
    public static function weekday($date){
        $days = ["pazar", 'pazartesi', "salı","çarşamba","perşembe","cuma","cumartesi"] ;
        return $days[$date] ;
    }
    public static function setTime($time){
        $seans_time = "" ;
        for($i=0; $i<strlen($time); $i++){
            if($i==2){
                $seans_time .= ":" ; 
            }
            $seans_time.=$time[$i] ;
        } 
        return $seans_time ;
    } 
    public static function setSeans($seansID, $seans_hour, $randevu_day){
        $result  = '<button type="button" id="seans'.$seansID.'" name="seans'.$seansID.'" class="seansBtn btn btn-info m-1" randevu_gunu="'.$randevu_day.'">'.$seans_hour.'</button>' ;
        return $result ;
    }
    ## otomatik olarak mevcut doktorlara randevu oluşturma fonksiyonu
    public static function setRandevu($doctorID, $poliklinikID){
        global $DBConnect ;
        $sayac = 0 ;       
        for($i = 0 ; $i < 15 ; $i++){
            $today = date_create(date('d-m-Y'));
            date_modify($today, '+'.(++$sayac).' day');
            $day = date_format($today, 'Y-m-d') ;
            
            if((date_format($today, 'w') == 6) || (date_format($today, 'w') == 0)){
                continue ;
            }else{
                $randevuExist = $DBConnect->getRow('SELECT * FROM seans WHERE seansPoliklinikID = ? AND seansDoctorID = ? AND seansDate = ?',[$poliklinikID, $doctorID, $day]) ;
                if(!$randevuExist){
                    $DBConnect->addRow('INSERT INTO seans (seansPoliklinikID, seansDoctorID, seansDate) VALUES (?, ?, ?) ',[$poliklinikID, $doctorID, $day]) ;
                }
            }
        }
    }
    public static function deleteOldAppointment($patientID, $appointment_day, $appointment_hour, $doctorID, $poliklinikID){
        global $DBConnect ;   
        $h = str_split($appointment_hour) ; ##  $appointment_hour = 1140  
        $edited_appointment_hour =  $h[0].$h[1].":".$h[2].$h[3] ; ##  $edited_appointment_hour = 11:40 
        if(date("Y-m-d") >= $appointment_day && date("H:i") >= $edited_appointment_hour){ ## şuandan önceye ait randevular ve seanslar varsa
            ## şuandan önceye ait seanslar varsa seans tablosundan silinir
            $DBConnect->deleteRow("DELETE FROM seans WHERE seansPoliklinikID = ? AND seansDoctorID = ? AND seansDate = ?", [$poliklinikID, $doctorID, $appointment_day]) ;   

            ## şuandan önceye ait alınmış randevular varsa randevu tablosundan silinir
            $isDeletedRandevu = $DBConnect->deleteRow("DELETE FROM randevu WHERE randevuPatientID = ? AND randevuBolum = ? AND randevuDoctorID = ? AND randevuDate = ? AND randevuHour = ?", [$patientID, $poliklinikID, $doctorID, $appointment_day, $appointment_hour]) ;   
            if($isDeletedRandevu){
                ## şuandan önceye ait alınmış randevular varsa ve randevu tablosundan silinmiş ise ilgili hastanın randevu alabilmesine engel olmaması için max randevu sayısı düzenlenmeli
               $DBConnect->updateRow('UPDATE patients SET patientRandevuCount = patientRandevuCount - 1 WHERE patientID = ?',[$patientID]) ; 
            }          
        }
    }

}## class Helper END
?>