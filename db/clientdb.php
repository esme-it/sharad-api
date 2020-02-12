<?php

$host="127.0.0.1";
$user="root";
$pass="";
$dbname="$clientname";

$mysqli = new mysqli("$host","$user","$pass","$dbname");


if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


if ($result = $mysqli->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();

    $result->close();
}

$sql =  "CREATE TABLE IF NOT EXISTS usersession (
  session_id int(11) NOT NULL auto_increment,
  user_id int(11)  NOT NULL,
  usersession varchar(64)  NOT NULL default '',
  PRIMARY KEY (session_id),
  UNIQUE KEY session_id (session_id))";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating usersession table<br>" . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS users (
  user_id int(11) NOT NULL auto_increment,
  client_id int(11) NOT NULL default '0',
  username varchar(30)  NOT NULL default '',
  userpass varchar(64)  NOT NULL default '',
  group_id int(11)  NOT NULL default '0',
  secret varchar(64)  NOT NULL default '',
  salt varchar(64)  default NULL default '',
  usermail varchar(150) NOT NULL default '',
  firstname varchar(30)  NOT NULL default '',
  surname varchar(32)  NOT NULL default '',
  date DATETIME,
  date_old DATETIME,
  PRIMARY KEY (user_id),
  UNIQUE KEY user_id (user_id)) AUTO_INCREMENT = 1000;";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating users table<br>" . $mysqli->error;
}

$sql =  "CREATE TABLE IF NOT EXISTS groups (
  group_id int(11) NOT NULL auto_increment,
  name varchar(32)  NOT NULL default '',
  permissions text(32)  NOT NULL default '',
  PRIMARY KEY (group_id),
  UNIQUE KEY group_id (group_id)
)";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error creating groups table: " . $mysqli->error;
}

$sql = "INSERT INTO groups SET permissions = '',name = 'Standard'";


if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error creating table: " . $mysqli->error;
}

$sql = "INSERT INTO groups SET permissions = '{\"admin\": 1}',name = 'Administrator'";


if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error creating table: " . $mysqli->error;
}

$sql =  "CREATE TABLE IF NOT EXISTS apisession (
  session_id int(11) NOT NULL auto_increment,
  user_id int(11)  NOT NULL,
  apisession varchar(64)  NOT NULL default '',
  PRIMARY KEY (session_id),
  date DATETIME,
  userip varchar (64) default NULL,
  UNIQUE KEY session_id (session_id))";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating usersession table<br>" . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS apiusers (
  user_id int(11) NOT NULL auto_increment,
  client_id int(11) NOT NULL,
  username varchar(30)  NOT NULL default '',
  userpass varchar(64)  NOT NULL default '',
  secret varchar(64)  NOT NULL default '',
  salt varchar(64)  default NULL,
  usermail varchar(150) NOT NULL default '',
  firstname varchar(30)  NOT NULL default '',
  surname varchar(32)  NOT NULL default '',
  date DATETIME,

  PRIMARY KEY (user_id),
  UNIQUE KEY user_id (user_id)
) AUTO_INCREMENT = 1000;" ;

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating users table<br>" . $mysqli->error;
}


$sql = "CREATE TABLE IF NOT EXISTS playerlist (
playerlist_id int(11) NOT NULL auto_increment,
playlist_id int(11) NOT NULL,
player_id int(11) NOT NULL,
status varchar(32) NOT NULL,
date DATETIME,
UNIQUE KEY playerlist_id (playerlist_id ),
PRIMARY KEY (playerlist_id )) AUTO_INCREMENT = 1000;";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating Playerlist table<br>" . $mysqli->error;
}
$sql = "CREATE TABLE IF NOT EXISTS campaign (
camp_id int(255) NOT NULL auto_increment,
cust_id int(255) NOT NULL,
camp_name varchar(64) NOT NULL,
duration varchar (64) NOT NULL,
date DATETIME,
UNIQUE KEY camp_id (camp_id),
PRIMARY KEY (camp_id)) AUTO_INCREMENT = 1000;";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating campaign table<br>" . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS screen (
screen_id int(11) NOT NULL auto_increment,
player_id int(11) NOT NULL,
user_id int(11) NOT NULL,
screen_name varchar(100) NOT NULL,
status varchar(15) NOT NULL,
location_lang varchar(100) NOT NULL,
location_lati varchar(100) NOT NULL,
locationname varchar(100) NOT NULL,
dim varchar(100) NOT NULL,
brand varchar(100) NOT NULL,
license_key varchar(32) NOT NULL,
date DATE,
income_id int(255) NOT NULL,
UNIQUE KEY screen (screen_id),
PRIMARY KEY (screen_id)) AUTO_INCREMENT = 1000;";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating screen table<br>" . $mysqli->error;
}
$sql =  "CREATE TABLE IF NOT EXISTS screensession (
    token_id int(11) NOT NULL auto_increment,
    screen_id int(11)  NOT NULL,
    screensession varchar(64)  NOT NULL default '',
    newdate DATE,
    olddate DATE,
    PRIMARY KEY (token_id),
    UNIQUE KEY token_id (token_id))";
  
  if ($mysqli->query($sql) === TRUE) {
  
  } else {
      echo "<br>Error: creating usersession table<br>" . $mysqli->error;
  }

$sql = "CREATE TABLE IF NOT EXISTS cust_playlist (
cust_playlist_id int(11) NOT NULL auto_increment,
camp_id int(11) NOT NULL,
playlistname varchar(100) NOT NULL,
camp_duration int(11) NOT NULL,
playlist_duration int(11) NOT NULL,
cust_id int(11) NOT NULL,
status varchar(15) NOT NULL,
date DATETIME,
UNIQUE KEY cust_playlist_id (cust_playlist_id),
PRIMARY KEY (cust_playlist_id)) AUTO_INCREMENT = 1000;";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating Playlist table<br>" . $mysqli->error;
}
$sql =  "CREATE TABLE IF NOT EXISTS cust_location (
  cust_id int(11) NOT NULL auto_increment,
  location_id int(11) NOT NULL,
  location_type varchar(32)  NOT NULL default '',
  location_freq varchar(32)  NOT NULL default '',
  locationname varchar(32)  NOT NULL default '',
  primetime varchar(32)  NOT NULL default '',
  nearby varchar(150) NOT NULL default '',
  PRIMARY KEY (cust_id),
  UNIQUE KEY cust_id (cust_id))";

if ($mysqli->query($sql) === TRUE) {

} else {
    echo "<br>Error: creating location table <br>" . $mysqli->error;
}
$mysqli->close();
