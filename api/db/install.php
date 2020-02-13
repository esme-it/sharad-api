<?php

$dbname = array(
    "portal",
    "sms",
    "payment",
   // "reporting"
) ;
$i=0;
$servername= $_SERVER['SERVER_NAME'];
echo $servername;
foreach ($dbname as $value)
{
echo $value;
echo "http://".$servername."/db/".$value."db.php?dbname=".$value;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".$servername."/api/db/".$value."db.php?dbname=".$value);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        echo $output;
}
