<?php
class client {
    private $_db;
            
    
    public function __construct($client = null){
        $this->_db = db::getInstance('portal');
 
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
        if(mkdir($custdir,0775)&&mkdir($custdir .'/camp',0775)&&mkdir($custdir .'/playlist',0775)){
  

        }else {
            echo "error";
        }
            
    }
    public function clientdb ($clientname){
        #create client db
	$sql="CREATE DATABASE IF NOT EXISTS `$clientname`;";

        if ($this->_db->query($sql)){

	 include ("db/clientdb.php");
}


    }

}
