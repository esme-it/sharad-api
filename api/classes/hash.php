<?php

class hash{
    public static function make($string,$salt=''){
        return hash ('sha256', $string . $salt);
    }
    public static function salt($length){
        return random_bytes($length);
    }
    public static function unique(){
        return self::make(uniqid());
    }
    public static function token($string1,$string2,$string3){
        return hash ('sha256', $string2 . $string2 . $string3);
    }
}
