<?PHP
$GLOBALS['config']= array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => ''
    )
);

spl_autoload_register(function($class){
    require_once '../classes/'.$class . '.php';
});

