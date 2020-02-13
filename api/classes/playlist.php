<?php
class playlist {
    private $_db;
            
    
    public function __construct($client = null){
        $this->_db = db::getInstance(); 
    }
    
    public function update ($fields = array()){
                
        if (!$this->_db->update('clients', $id, $fields)){
            throw new Exception('There was a problem');
        }
        
    }
    
    public function create($fields=array()) {
        if (!$this->_db->insert('playlist',$fields)){
            throw new Exception('There was a problem creating an account');
        }   
    }
    public function folder ($folder,$campdir){
        #create user folders
       
        
        $dir = "../clients/".$folder."/camp/";   
        $custdir=$dir.$campdir;
        echo '<br>'.$custdir;
          
        if(mkdir($custdir,775)&&mkdir($custdir .'/media',775)&&mkdir($custdir .'/css',775)){
  
            echo "done";
        }else {
            echo "error";
        }
            
    }

}