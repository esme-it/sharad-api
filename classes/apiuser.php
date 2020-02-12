<?php

class apiuser {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;
            
    
    public function __construct($user = null){
      
        $this->_db = db::getInstance('portal');
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
        
        
        
        if ($this->_db->update('apiusers', $user_id, $fields,'user_id')){
            throw new Exception('There was a problem');
        }
    }
    
    public function create($fields=array()) {
        if (!$this->_db->insert('apiusers',$fields)){
            throw new Exception('There was a problem creating an USER account');
        }
    }
    
    public function find($user=null){
      
        if ($user){
            $field = (is_numeric($user)) ? 'user_id' : 'username';
            $data = $this->_db->get('apiusers',array($field, '=', $user));
            if ($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    
    public function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
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
                    $hashCheck= $this->_db->get('apisession',array('user_id','=', $this->data()->user_id));
                    
                    if (!$hashCheck->count()){
                        $this->_db->insert('apisession',array(
                            'user_id' => $this->data()->user_id,
                            'apisession'=>$hash,
                            'date' => date('Y-m-d H:i:s'),
                            'userip' => $this->getRealUserIp(),
                        ));
                     
                    }else {
                        $hash=$hashCheck->first()->apisession;
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
        
        $this->_db->delete('apisession',array ('user_id','=', $this->data()->user_id));
        
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
