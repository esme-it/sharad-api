<?php
class id {
    private $_db = null;
    
    public function __construct() {
        $this->_db = db::getInstance();
    }
 
    public function generate($location='', $item=''){
       $y=0;
        do{
         $y++;
         $x=10000+$y;
         #$check= $this->_db->get($location, array($item, '=',$rand));
         $check = $this->_db->get($location, array($item, '=',$x)); 
        } while ($check->count());
         
        return $x;
    }     
}
