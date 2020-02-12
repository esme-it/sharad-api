<?php


class input {
    public static function exists($type = 'post'){
        switch($type){
            case 'post':
                $postBody = file_get_contents("php://input");
                $salt="197bd09cacc657d80d3eb1dc862356bb";
        $decrypted_raw = base64_decode($postBody);
        $decrypted = preg_replace(sprintf('/%s/', $salt), '', $decrypted_raw);
        $decrypted = json_decode($decrypted);
                return (!empty($_POST)) ? true : false;
                if (!empty($_POST)===false) return $decrypted;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            case 'file':
                return (!empty($_FILES)) ? true : false;
                break;
            default:
                return false;
            break;    
        }
    }
    public static function convert($type = 'post',$secret){
        switch($type){
            case 'POST':
                echo $secret;
                $postBody = file_get_contents("php://input");
                $decrypted_raw = base64_decode($postBody);
                $decrypted = preg_replace(sprintf('/%s/', $secret), '', $decrypted_raw);
                $decrypted = json_decode($decrypted);
                if (!empty($_POST)===false) return $decrypted;
                break;
            case 'GET':
                return (!empty($_GET)) ? true : false;
                break;
            case 'FILE':
                return (!empty($_FILES)) ? true : false;
                break;
            default:
                return false;
            break;    
        }
    }
    public static function get($item){
       if (isset($_POST[$item])){
           return $_POST[$item];
       } else if(isset($_GET[$item])){
       return $_GET[$item];}
       
       else{
           if(isset($_FILES[$item])){
       return $_FILES[$item];}
           
     
       }
       return '';
    }
}
