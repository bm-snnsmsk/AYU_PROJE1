<?php

class Database{

    private $hostName = "localhost"; // sunucuda da  genelde localhost olur
    private $DBName = "ayu_proje1" ;
    private $userName = "root" ;
    private $password = "" ;
    private $charset = "UTF8" ;
    private $collationCharset = "utf8_general_ci" ;
    private $DBConnect = NULL ;
    private $query = NULL ;
    
    private function DBConnect(){
        $PDO = "mysql:host=".$this->hostName.";dbname=".$this->DBName ;
        try{           
            $this->DBConnect = new PDO($PDO, $this->userName, $this->password) ;
            $this->DBConnect->exec("SET NAMES '".$this->charset."' COLLATE '".$this->collationCharset."'") ;
            $this->DBConnect->exec("SET CHARACTER SET '".$this->charset."'") ;
            $this->DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
            $this->DBConnect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC) ;
        }catch(PDOException $e){
            die("Veritabanı erişim hatası ".$e->getMessage()) ;
        }
    }
    public function __construct(){
        $this->DBConnect() ;
    }
    // common function START 
    public function commonQuery($query, $params = NULL){
        if(is_null($params)){
            $this->query = $this->DBConnect->query($query) ;
        }else{
            $this->query = $this->DBConnect->prepare($query) ;
            $this->query->execute($params) ;
        }
        return $this->query ;
    }
    // common function END 
    public function getColumn($query, $params = NULL){ // $item = $DB->getColumn("SELECT todoTitle FROM todo WHERE todoID = ?", [83]) ; echo $item ;
        try{  // $item = $DB->listColumn("SELECT COUNT(todoID) FROM todo") ; echo "$item" ; // = 21 
            return $this->commonQuery($query, $params)->fetchColumn() ;
        }catch(PDOException $e){
            die($e->getMessage()) ;
        }
    }
    public function getRow($query, $params = NULL){ // getRow("SELECT * FROM tableName WHERE id = ?", [5])  // not array
        try{
            return $this->commonQuery($query, $params)->fetch() ;
        }catch(PDOException $e){
            die($e->getMessage()) ;
        }
    }
    public function getRows($query, $params = NULL){ // getRows("SELECT * FROM tableName WHERE id > ? AND id < ?", [5, 12]) // array
        try{
            return $this->commonQuery($query, $params)->fetchAll() ;
        }catch(PDOException $e){
            die($e->getMessage()) ;
        }
    }
    public function getLimitedRows($query, $param1 = 0, $param2 = NULL){ //getLimitedRows("SELECT * FROM todo LIMIT ?", 4) ;
        try{
            $this->query = $this->DBConnect->prepare($query) ;
            $this->query->bindParam(1, $param1, PDO::PARAM_INT) ;
            if(!is_null($param2)){
                $this->query->bindParam(2, $param2, PDO::PARAM_INT) ;
            }
            $this->query->execute() ;
            return $this->query->fetchAll() ;
        }catch(PDOException $e){
            die($e->getMessage()) ;
        }
    }
    public function addRow($query, $params = NULL){
        try{
            $this->commonQuery($query, $params) ;
            return $this->DBConnect->lastInsertId() ; // ekleme yapılmış mı ?
        }catch(PDOException $e){
            die($e->getMessage()) ;
        }
    }
    public function updateRow($query, $params = NULL){
        try{
            return $this->commonQuery($query, $params)->rowCount() ; // güncellenen satır sayısı
        }catch(PDOException $e){
            die($e->getMessage()) ;
        }
    }
    public function deleteRow($query, $params = NULL){
        return $this->updateRow($query, $params) ; 
    }  
    public function maintenance($DB = NULL){
        $showTables = $this->DBConnect->query("SHOW TABLES FROM ".$DB) ; 
        $showTables->setFetchMode(PDO::FETCH_NUM) ;
        if($showTables){
            foreach($showTables as $items){
                $check = $this->DBConnect->query("CHECK TABLE ".$items[0]) ;
                $analyze = $this->DBConnect->query("ANALYZE TABLE ".$items[0]) ;
                $repair = $this->DBConnect->query("REPAIR TABLE ".$items[0]) ;
                $optimize = $this->DBConnect->query("OPTIMIZE TABLE ".$items[0]) ;
                if($check == true && $analyze == true && $repair == true && $optimize == true){
                    return ["process" => true, "message" => "Bakım ve Onarım işlemi başarılı bir şekilde yapılmıştır."] ;
                }else{
                    return ["process" => false, "message" => "Bakım ve Onarım işlemi sırasında bir hata meydana geldi."] ;
                }
            }            
        }
    }
    public function __destruct(){
        $this->DBConnect = NULL ;
    }
}
?>
