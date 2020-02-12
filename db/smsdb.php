<?php

include("db.php");

include("create_db.php");

$sql = "CREATE TABLE IF NOT EXISTS smsplaylist (
sms_playlist_id int(11) NOT NULL auto_increment,
camp_id int(11) NOT NULL,
camp_duration int(11) NOT NULL,
playlist_duration int(11) NOT NULL,
cust_id int(11) NOT NULL,
date DATETIME,
player_id int(11) NOT NULL,
UNIQUE KEY sms_playlist_id (sms_playlist_id),
PRIMARY KEY (sms_playlist_id));";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>Table smsplaylist created successfully";
} else {
    echo "<br>Error creating table: " . $mysqli->error;
}
$mysqli->close();