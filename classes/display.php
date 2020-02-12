<?php
class display {
    private $_passed = false,
            $_errors = array(),
            $_db;

    public function __construct($client = null){
        $this->_db = client_db::getInstance(config::get('owner/client_id'));
    }
    
    public function update ($id,$fields = array()){
                
        if ($this->_db->update('screen', $id, $fields,'screen_id')){
            throw new Exception('There was a problem');
        }
        
    }
    
    public function create($fields=array()) {
        if (!$this->_db->insert('screen',$fields)){
            throw new Exception('There was a problem creating an account');
        }   
    }
    public function folder ($folder,$campdir){
        #create user folders
       
        
        $dir = "../clients/".$folder."/camp/";   
        $custdir=$dir.$campdir;
          
        
    }
     public function check ($source, $items = array()){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
		
                $value = trim($source[$item]);
		$item = escape($item);
                if ($rule === 'required' && empty ($value)){
                   $this->addError("{$item} is requiered"); 
                }else { if (!empty($value)){
                    switch($rule) {
                        case 'min':
                            if(strlen($value)< $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                        break;
                        case 'max':
                            if(strlen($value)> $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                        break;
                        case 'matches':
                             if($value != $source[$rule_value]){
                                $this->addError("{$rule_value} must match {$item}");
                            }
                        break;
                        case 'unique':
			 $check= $this->_db->get($rule_value, array($item, '=',$value)); 
			if( $check->count()){
                                $this->addError("{$item} allredy exists.");
                            }
                           
                        break;
                        case 'exists':
			 $check= $this->_db->get($rule_value, array($item, '=',$value)); 
			if( $check->count()){
                                echo "OK Kunde existiert";
                            }else{
                                $this->addError("{$item} kein kunde");
                            }
                        break;
                    }
		
                }
                    
                }
            }
            
        }
         if (empty($this->_errors)){

                $this->_passed =  true;
            }
	return $this;
    }
        private function addError($error){
        $this->_errors[]=$error;
    }
    public function errors () {
        return $this->_errors;
    }
    public function passed(){
        return $this->_passed;
    }

}