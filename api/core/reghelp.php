<?PHP
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
?>
