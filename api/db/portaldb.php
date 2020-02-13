<?php

include("db.php");
include("create_db.php");


$sql = "CREATE TABLE IF NOT EXISTS license (
license_id int(11) NOT NULL auto_increment,
license_key varchar(32) NOT NULL,
user_id int(11) NOT NULL,
cust_id int(11) NOT NULL,
status varchar(30) NOT NULL default '',
start_date DATETIME,
end_date DATETIME,
UNIQUE KEY license_id (license_id),
UNIQUE KEY license_key (license_key),
PRIMARY KEY (license_id));";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>Table license created successfully";
} else {
    echo "<br>Error creating table: " . $mysqli->error;
}

$sql =  "CREATE TABLE IF NOT EXISTS clients (
  client_id int(11) NOT NULL auto_increment,
  client_name varchar(32)  NOT NULL default '',
  type varchar(32)  NOT NULL default '',
  surname varchar(32)  NOT NULL default '',
  firstname varchar(32)  NOT NULL default '',
  email varchar(150) NOT NULL default '',
  address varchar(150) NOT NULL default '',
  folder varchar(150) NOT NULL default '',
  payment_id int(11),
  date DATETIME,
  PRIMARY KEY (client_id),
  UNIQUE KEY client_id (client_id)
  )AUTO_INCREMENT = 100000;";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>Clients table created successfully";
} else {
    echo "<br>Error creating clients table: " . $mysqli->error;
}


$sql =  "CREATE TABLE IF NOT EXISTS content  (
  content_id int(11) NOT NULL auto_increment,
  content_typ varchar(32)  NOT NULL default '',
  content_name varchar(32)  NOT NULL default '',
  content_language varchar(32)  NOT NULL default '',
  content_class varchar(150) NOT NULL default '',
  content varchar(150) NOT NULL default '',
  date DATETIME,
  PRIMARY KEY (content_id ),
  UNIQUE KEY clients_id (content_id))";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>content table created successfully";
} else {
    echo "<br>Error creating content table: " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS notification (
  mail_id int(11) NOT NULL auto_increment,
  username varchar(30)  NOT NULL default '',
  content_typ varchar (20),
  content varchar(500)  NOT NULL default '',
  usermail varchar(150) NOT NULL default '',
  firstname varchar(30)  NOT NULL default '',
  surname varchar(32)  NOT NULL default '',
  PRIMARY KEY (mail_id),
   UNIQUE KEY mail_id (mail_id)
) ENGINE=MYISAM;" ;

if ($mysqli->query($sql) === TRUE) {
    echo "<br>notification table created successfully";
} else {
    echo "<br>Error creating notification table: " . $mysqli->error;
}

$sql =  "CREATE TABLE IF NOT EXISTS tags (
    tag_id int(11) NOT NULL auto_increment,
    tag_name int(11) NOT NULL,
    PRIMARY KEY (tag_id),
    UNIQUE KEY tag_id (tag_id)
  )";
  
  if ($mysqli->query($sql) === TRUE) {
  
  } else {
      echo "<br>Error creating groups table: " . $mysqli->error;
  }

  
$sql =  "CREATE TABLE IF NOT EXISTS cust_tags (
    cust_tag_id int(11) NOT NULL auto_increment,
    screen_id int(11) NOT NULL,
    tag_id int(11) NOT NULL,
    location_id int(11) NOT NULL,
    camp_id int(11) NOT NULL,
    client_id int(11) NOT NULL,
    PRIMARY KEY (cust_tag_id),
    UNIQUE KEY cust_tag_id (cust_tag_id)
  )";
  
  if ($mysqli->query($sql) === TRUE) {
  
  } else {
      echo "<br>Error creating groups table: " . $mysqli->error;
  }

$mysqli->close();
