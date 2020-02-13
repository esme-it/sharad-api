<?PHP


spl_autoload_register(function($class){
    require_once 'classes/'. $class . '.php';
});



require_once 'functions/sanitize.php';

if (cookie::exists(config::get('remember/cookie_name')) && !session::exists(config::get('session/session_name'))){
    $hash= cookie::get(config::get('remember/cookie_name'));
    
    
    $hashCheck = client_db::getInstance($client_id);
   
    $hashCheck->get('usersession', array('usersession','=',$hash));

    if($hashCheck->count()){
        
        $user = new user($hashCheck->first()->user_id);

        $user->login();

    }
}
?>
