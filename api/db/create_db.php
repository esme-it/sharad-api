<?php

if (!$_GET['dbname']==''){
$dbname=$_GET['dbname'];

$sql="CREATE DATABASE  IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>Database: ".$dbname." created successfully";
} else {
    echo "<br>Error: ".$dbname." Database was not created<br>". $mysqli->error;
}

$mysqli->select_db($dbname);
if ($result = $mysqli->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    printf("<br>Database is set to %s\n", $row[0]);
    $result->close();
}
} else {
   $dbname=$_GET['dbname'];

$sql="CREATE DATABASE  IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;;";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>Database: ".$dbname." created successfully";
} else {
    echo "<br>Error: ".$dbname." Database was not created<br>". $mysqli->error;
}

$mysqli->select_db($dbname);
if ($result = $mysqli->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    printf("<br>Database is set to %s\n", $row[0]);
    $result->close();
} 
    
}
