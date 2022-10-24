<?php

class FileUpload{
    private $inputName ;          // gelen input['type=file']'in name
    private $fileUploadPathName ; // gelen dosyanın yükleneceği klasor adı 
    private $fileUploadPath ;     // dosyanın yükleneceği path'i 
    private $fileName ; 
    private $filePath ; 
    private $fileType ; 
    private $fileTmpName ; 
    private $fileError ; 
    private $fileSize ; 
    private $maxFileSize = 100000 ;
    private $fileExtension ;
    private $allowedExtension = ["pdf", "jpg", "png", "jpeg"] ;
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // tek dosya yüklemesi için html tarafı
    /*  
        <form action="<?= Security::security($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3 form-group">
        <input type="file" class="form-control" id="myFile" name="myFile">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
    */
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // multiple dosya yüklemesi için html tarafı
    /*  
        <form action="<?= Security::security($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3 form-group">
        <input type="file" class="form-control" id="myFile" name="myFile[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
    */
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // fileUploadedPath => chmod = "0755" = max 
    public function __construct($inputName, $fileUploadPath){
        $this->inputName = $inputName ;
        $this->fileUploadPathName = $fileUploadPath ;
        if(is_array($_FILES[$this->inputName]['name'])){           
            return false;
        }else{                     
            $this->fileOldName = $_FILES[$inputName]['name'] ;
            $this->filePath = $_FILES[$inputName]['full_path'] ;
            $this->fileType = $_FILES[$inputName]['type'] ;
            $this->fileTmpName = $_FILES[$inputName]['tmp_name'] ;
            $this->fileError = $_FILES[$inputName]['error'] ;
            $this->fileSize = $_FILES[$inputName]['size'] ;
            $this->fileExtension = Validation::extensionValidation($this->filePath) ;
            $this->fileName = md5(uniqid(time())).".".$this->fileExtension ;
            $this->fileUploadPath = $this->fileUploadPathName."/".$this->fileName ;
        }
    } 
    public function getFileName(){
        return $this->fileName ;
    }
    public function fileLoad(){ 
        if($this->fileError == 4 ){
            return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen bir dosya seçiniz!', 'fileError' => $this->fileError] ;
        }   
        if($this->fileError != 4 && $this->fileError != 0){
            return ['success' => false, 'type' => 'danger', 'message' => 'Yüklediğiniz dosyada bir hata var. Lütfen dosyanızı kontrol edip yeniden yükleyiniz.', 'fileError' => $this->fileError] ;
        }   
        if(file_exists($this->fileUploadPath)){ // uniqid()."_".$_FILES[$name]['name'] benzersiz olması beklenir ama her ihtimale karşın bu kod yine de yazıldı.
            return ['success' => false, 'type' => 'warning', 'message' => 'Yüklediğiniz dosya sistemimizde mevcuttur. Lütfen başka bir dosya seçiniz.', 'fileError' => $this->fileError] ;
        }
        if(!$this->sizeValidation($this->maxFileSize)){
            return ['success' => false, 'type' => 'warning', 'message' => 'Dosya boyutu '.$this->maxFileSize." byte'tan fazla olamaz!", 'fileError' => $this->fileError] ;
        }
        if(!in_array($this->fileExtension,$this->allowedExtension)){
            return ['success' => false, 'type' => 'warning', 'message' => 'Geçersiz dosya. Geçerli dosya uzantıları : '.join(", ",$this->allowedExtension), 'fileError' => $this->fileError] ;
        }
        // sadece resim dosyası yüklenecekse resim doğrulaması için
        /* if(!getimagesize($this->fileTmpName)){
            return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen bir resim yükleyiniz.', 'fileError' => $this->fileError] ;
        } */
         if(move_uploaded_file($this->fileTmpName, $this->fileUploadPath)){
            return ['success' => true, 'type' => 'success', 'message' => 'Dosya yükleme başarılı', 'fileError' => $this->fileError, 'filePath' => $this->fileUploadPath, 'fileSize' => $this->fileSize, 'fileName' => $this->fileName] ;
        }else{
            return ['success' => false, 'type' => 'danger', 'message' => 'Dosya yüklenirken bir hata meydana geldi!. Lütfen yeniden deneyiniz.', 'fileError' => $this->fileError] ;
        }
    }    
    public function multipleFileLoad(){
        $result = [] ;
        $takenFiles = $_FILES[$this->inputName] ;
        $takenTmpNames = $takenFiles['tmp_name'] ;                 
        foreach($takenTmpNames as $key => $value){    
            $fileName = uniqid()."_".$takenFiles['name'][$key] ;        
            $fileFullPath = $takenFiles['full_path'][$key] ;        
            $fileType = $takenFiles['type'][$key] ;        
            $fileTmpName = $takenFiles['tmp_name'][$key] ;                
            $fileError = $takenFiles['error'][$key] ;        
            $fileSize = $takenFiles['size'][$key] ;              
            $fileExtension = Validation::extensionValidation($fileFullPath) ;      
            $fileUploadPath = $this->fileUploadPathName.'/'.$fileName ;
            if($fileError == 4 ){
                return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen bir dosya seçiniz!', 'fileError' => $fileError] ;
            }  
            if($fileError != 4 && $fileError != 0){
                return ['success' => false, 'type' => 'danger', 'message' => 'Yüklediğiniz dosyada bir hata var. Lütfen dosyanızı kontrol edip yeniden yükleyiniz.', 'fileError' => $fileError] ;
            }  
            if(file_exists($fileUploadPath)){ // uniqid()."_".$_FILES[$name]['name'] benzersiz olması beklenir ama her ihtimale karşın bu kod yine de yazıldı.
                return ['success' => false, 'type' => 'warning', 'message' => 'Yüklediğiniz dosya sistemimizde mevcuttur. Lütfen başka bir dosya seçiniz.', 'fileError' => $fileError] ;
            }
            ############ DÜZELTİLMELİ START #################
            if(!$this->sizeValidation($this->maxFileSize)){
                return ['success' => false, 'type' => 'warning', 'message' => 'Dosya boyutu '.$this->maxFileSize." byte'tan fazla olamaz!", 'fileError' => $fileError] ;
            }
            ############ DÜZELTİLMELİ END #################
            if(!in_array($fileExtension,$this->allowedExtension)){
                return ['success' => false, 'type' => 'warning', 'message' => 'Geçersiz dosya. Geçerli dosya uzantıları : '.join(", ",$this->allowedExtension), 'fileError' => $fileError] ;
            }
            // sadece resim dosyası yüklenecekse resim doğrulaması için
            /* if(!getimagesize($fileTmpName)){
                return ['success' => false, 'type' => 'warning', 'message' => 'Lütfen bir resim yükleyiniz.', 'fileError' => $fileError] ;
            } */
            if(move_uploaded_file($fileTmpName, $fileUploadPath)){

                ############ DÜZELTİLMELİ START #################
                array_merge(['success' => true, 'type' => 'success', 'message' => 'Dosya yükleme başarılı', 'fileError' => $fileError, 'filePath' => $fileUploadPath, 'fileSize' => $fileSize, 'fileName' => $fileName])  ;
                ############ DÜZELTİLMELİ END #################
            }else{
                return ['success' => false, 'type' => 'danger', 'message' => 'Dosya yüklenirken bir hata meydana geldi!. Lütfen yeniden deneyiniz.', 'fileError' => $fileError] ;
            }
        } 
        ############ DÜZELTİLMELİ START #################
        print_r($result) ;
        echo count($result) ;
        ############ DÜZELTİLMELİ END #################
    }
    public function sizeValidation($size){
        if($this->fileSize > $size){
            return false ;
        }else{
            return true ;
        }
    }
}
?>