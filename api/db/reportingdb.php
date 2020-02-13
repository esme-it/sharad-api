<?php
include("cas_db.php");
include("create_cas_db.php");

$statement = $session->execute(new Cassandra\SimpleStatement("
CREATE TABLE IF NOT EXISTS playerreport ( 
player_id uuid,
camp_id int,
view_count int,
view_time text,
view_date text,
view_duration float,
freq_count int,
object_typ text,
human_age int,
human_hair text,
human_gender text,
human_emotion text,
car_typ text,
car_view int,
car_count int,
location_id int,
location_long double,
location_lati double,
PRIMARY KEY (player_id) ) "));

$statement = $session->execute(new Cassandra\SimpleStatement("
CREATE TABLE IF NOT EXISTS tags ( 
tags_id int,
tags text,
player_id int,
PRIMARY KEY (tags_id))"));

//Select and show the change
$result = $session->execute(new Cassandra\SimpleStatement("SELECT * FROM $keyspace.playerreport"));

if ($result){
    echo "<br>table playerreport is created";
}
//Select and show the change
$result = $session->execute(new Cassandra\SimpleStatement
          ("SELECT * FROM $keyspace.tags"));

if ($result){
    echo "<br>table tags is created";
}
