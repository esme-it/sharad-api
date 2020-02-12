<?php

class license {
    private $_db = null,
            $_data;
    
    public function __construct() {
        $this->_db = db::getInstance('portal');
    }
    
    public function update ($fields = array(),$license_id,$parameter){
                  
        if ($this->_db->update('license', $license_id, $fields, $parameter)){
            throw new Exception('There was a problem');
        }
        
    }
    public function generate($user_id='',$client_id=''){
   
         $licens_key= uniqid();
         $check = $this->_db->get('license', array('license_key', '=',$licens_key)); 
         $this->_data =  $licens_key;
      
        if (!$this->_db->insert('license',array ('license_key'=>$licens_key,
                                                 'user_id'=>$user_id,
                                                 'clients_id'=>$client_id,
                                                 'status'=>'disabled')))
                {
            throw new Exception('There was a problem creating an account');
        return true;
        }   
    
        
    }
    public function data(){
        return $this->_data;
    }   
       
}
