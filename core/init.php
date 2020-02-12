<?PHP
if (isset($_GET['client_id'])){
    $client_id = $_GET['client_id'];
}else{
    $client_id = 00000;
}
$GLOBALS['config']= array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => ''
    ),
    'cas_system' => array(
        'host' => '192.168.37.5',
        'username' => '',
        'password' => '',
        'port' => '9042'
    ),
    'mongo_system' => array(
        'host' => '192.168.37.3',
        'username' => '',
        'password' => '',
        'port' => ''
    ),
    'owner' => array(
        'system' => 'S0m7s1E2U8!8',
        'url'=>"localhost/spotmotion",
        'play'=>"localhost/spotmotion",
        'client_id'=>$client_id
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expire' => '60000'
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);


spl_autoload_register(function($class){
    require_once 'classes/'. $class . '.php';
});


require_once 'functions/sanitize.php';

?>
