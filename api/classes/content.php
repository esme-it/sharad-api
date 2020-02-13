<?php
class content {
    private $_db;
            
    
    public function __construct($client = null){
        $this->_db = system_db::getInstance(); 
    }
    
    public function update ($fields = array()){
                
        if (!$this->_db->update('content', $id, $fields)){
            throw new Exception('There was a problem');
        }
        
    }
    
    public function create($fields=array()) {
        if (!$this->_db->insert('content',$fields)){
            throw new Exception('There was a problem creating an account');
        }   
    }
    public function sidebar ($content_typ,$lang){
       
        foreach ($output = system_db::getInstance()->query("SELECT * FROM content WHERE content_typ='$content_typ' and content_language='$lang'")->results() as $output){
               echo '<li><a href="index.php?pages='.$output->content_name.'"><i class="'.$output->content_class.'"></i>'.$output->content.'</a></li>';
               
           }
            
    }

}