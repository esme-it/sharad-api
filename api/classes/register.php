<?php
class client {
    private $_db;
            
    
    public function __construct($client = null){
        $this->_db = system_db::getInstance(); 
    }
    
    public function update ($fields = array()){
                
        if (!$this->_db->update('clients', $id, $fields)){
            throw new Exception('There was a problem');
        }
        
    }
    
    public function create($fields=array()) {
        if (!$this->_db->insert('clients',$fields)){
            throw new Exception('There was a problem creating an Client account');
        }   
    }
    public function folder ($clientdir){
        #create client folders
        $dir = "clients/";    
        $custdir=$dir.$clientdir;
          echo $custdir;
        if(mkdir($custdir,0775)&&mkdir($custdir .'/camp',0775)&&mkdir($custdir .'/playlist',0775)){
  
            echo "done";
        }else {
            echo "error";
        }
            
    }
    public function clientdb ($clientname,$user,$pass){
        #create client db
	$sql="CREATE DATABASE `$clientname`;CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';GRANT ALL ON `$clientname`.* TO '$user'@'localhost';FLUSH PRIVILEGES;";

        if ($this->_db->query($sql)){

	 include ("pages/clientstart.php");
}


    }

}
