<?php
class camp {
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
        if (!$this->_db->insert('campaign',$fields)){
            throw new Exception('There was a problem creating an account');
        }   
    }
    public function folder ($folder,$campdir){
        #create user folders
       
        
        $dir = "clients/".$folder."/camp/";   
        $custdir=$dir.$campdir;
       
          
        if(mkdir($custdir,0775)&&mkdir($custdir.'/media',0775)&&mkdir($custdir.'/css',0775)){
           
        }
        else{
            
             echo "error";
        }
        
            
    }
    
    public function upload ($folder,$campdir,$data=array(),$html,$css){
       
$uploadOk = 1;
$upload_folder = "clients/".$folder."/camp/".$campdir."/media/"; //Das Upload-Verzeichnis



    $file_count = count($data['name']);

    if ($data["error"]["0"] != 4)
    {
    for ($i=0; $i<$file_count; $i++) {
      
            $filename = $data['name'][$i];
            $filesize = $data['size'][$i];
            $filetmp = $data['tmp_name'][$i];
            $target_file = $upload_folder.$data['name'][$i];
            
        
            
        if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($filesize > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (!move_uploaded_file($filetmp, $target_file)) {
     echo "Sorry,". $filename ."there was an error uploading your file.<br>";
    }
}
    }
    }
    
    $upload_html = "clients/".$folder."/camp/".$campdir;
   if(!file_put_contents($upload_html.'/index.html',$html,FILE_APPEND)){
 echo "Data writ ERROR";
   }
  $upload_css = "clients/".$folder."/camp/".$campdir."/css/";
    if(!file_put_contents($upload_css.'style.css',$css,FILE_APPEND)){
 echo "Data writ ERROR";
    }
        }
    
    
}