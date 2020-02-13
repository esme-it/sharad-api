<?php
class playerlist {
    private $_db;
            
    
    public function __construct($client = null){
        $this->_db = db::getInstance(); 
    }
    
    public function update ($fields = array()){
                
        if (!$this->_db->update('clients', $id, $fields)){
            throw new Exception('There was a problem');
        }
        
    }
    
    public function create($playerlist_id=null) {
       foreach ($playlist = db::getInstance()->query("SELECT * FROM playerlist WHERE playerlist_id='$playerlist_id')")->results() as $db){
           foreach ($camp = db::getInstance()->query("SELECT * FROM playlist WHERE playlist_id='$playlist->playlist_id')")->results() as $db){
               echo $camp->camp_id;
               echo 'br';
               
           }
       }
    }
    public function folder ($folder){
       
       
          foreach ($db = db::getInstance()->query("SELECT * FROM playerlist WHERE playerlist_id='$playerlist_id')")->results() as $db){
           foreach ($camp = db::getInstance()->query("SELECT * FROM playlist WHERE playlist_id='$playlist->playlist_id')")->results() as $db){
               echo $camp->camp_id;
               echo 'br';
               
           }
       }
            
    }

}