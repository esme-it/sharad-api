<?php

class screen {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;
            
    
    public function __construct($token){
       
     	
        $this->_db = client_db::getInstance(config::get('owner/client_id'));
        if ($token){
            
                $logedin = $this->_db->get('screensession',array("screensession", '=', $token));
                if ($logedin->count()){
                     
                        $this->_isLoggedIn= true;
                       
                    }else{
                        $this->_isLoggedIn= false;
                        return false;
                    }
                
                 
                
            }else{
                            
                //login
    
             
            
        }
        
    }
    
    
    public function find($user=null){

        if ($user){
            $field = (is_numeric($user)) ? 'user_id' : 'username';
            $data = $this->_db->get('',array($field, '=', $user));
            if ($data->count()){
              
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    

    public function exists(){
        
   return (!empty($this->_data))? true : false;
    }
    public function logout(){
        
        $this->_db->delete('usersession',array ('user_id','=', $this->data()->user_id));
        
        session::delete($this->_sessionName);
        cookie::delete($this->_cookieName);
    }
    public function data(){
        return $this->_data;
    }
    public function isLoggedIn(){
        return $this->_isLoggedIn;        
    }
}
