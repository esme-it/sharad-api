<?php
require_once ('init.php');
/*$dbhost='localhost';
$dbuser='root';
$dbpass='E07s12m88e!';
*/

$mysqli = new mysqli(config::get('mysql/host'),config::get('mysql/username'),config::get('mysql/password'));

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
