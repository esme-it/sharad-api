<?php

class user {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;
            
    
    public function __construct($user = null){
       
        $this->_db = client_db::getInstance(config::get('owner/client_id'));
        $this->_sesssionName = config::get('session/session_name');
        $this->_cookieName = config::get('remember/cookie_name');
        if (!$user){
           
            if (session::exists($this->_sessionName)){
                $user = session::get($this->_sessionName);
                 
                if ($this->find($user)){
                    $this->_isLoggedIn= true;
                   
                }else{
                    
                } }
            }else{
                            
                $this->find($user);
    
             
            
        }
        
    }
    
    public function update ($user_id,$fields = array()){
        
        
        
        if ($this->_db->update('users', $user_id, $fields,'user_id')){
            throw new Exception('There was a problem');
        }
    }
    
    public function create($fields=array()) {
        if (!$this->_db->insert('users',$fields)){
            throw new Exception('There was a problem creating an USER account');
        }
    }
    
    public function find($user=null){

        if ($user){
            $field = (is_numeric($user)) ? 'user_id' : 'username';
            $data = $this->_db->get('users',array($field, '=', $user));
            if ($data->count()){
                $this->_data = $data->first();
                
                return true;
            }
        }
        return false;
    }
    
    public function login ($username = null,$password = null, $remember=false){
         
  
        if(!$username && !$password && $this->exists()){
          
            session::put($this->_sessionName, $this->data()->user_id);
        }else{
           
            $user = $this->find($username);
            
        if ($user){	
          
            if ($this->data()->userpass === hash::make($password, $this->data()->salt)){
                session::put($this->_sessionName, $this->data()->user_id);
                if($remember){
                    $hash = hash::unique();
                    $hashCheck= $this->_db->get('usersession',array('user_id','=', $this->data()->user_id));
                    
                    if (!$hashCheck->count()){
                        $this->_db->insert('usersession',array(
                            'user_id' => $this->data()->user_id,
                            'usersession'=>$hash
                        ));
                        
                    }else {
                        $hash=$hashCheck->first()->usersession;
                    }
                   cookie::put($this->_cookieName,$hash,config::get('remember/cookie_expire'));
                }
                
                return true;
                
            }
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
