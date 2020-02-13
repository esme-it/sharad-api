<?php

include("db.php");
include("create_db.php");

$sql =  "CREATE TABLE IF NOT EXISTS client_payment (
  payment_id int(11) NOT NULL auto_increment,
  client_id int(11) NOT NULL ,
  surname varchar(32)  NOT NULL default '',
  firstname varchar(32)  NOT NULL default '',
  email varchar(150) NOT NULL default '',
  address varchar(150) NOT NULL default '',
  date DATETIME,
  PRIMARY KEY (payment_id),
  UNIQUE KEY payment_id (payment_id)) AUTO_INCREMENT=10000;";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>client_payment table created successfully";
} else {
    echo "<br>Error creating client_payment table: " . $mysqli->error;
}

$sql =  "CREATE TABLE IF NOT EXISTS bank_data (
  bank_id int(11) NOT NULL auto_increment,
  bank_name varchar(32)  NOT NULL default '',
  iban varchar(32)  NOT NULL ,
  payment_id int(11) NOT NULL,
  date DATETIME,
  PRIMARY KEY (bank_id),
  UNIQUE KEY bank_id (bank_id)) AUTO_INCREMENT=10000;";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>bank_data table created successfully";
} else {
    echo "<br>Error creating bank_data table: " . $mysqli->error;
}

$sql =  "CREATE TABLE IF NOT EXISTS income (
  income_id int(11) NOT NULL auto_increment,
  iban varchar(32)  NOT NULL,
  m_income_id int(11) NOT NULL,
  payment_id int(11) NOT NULL,
  date DATETIME,
  PRIMARY KEY (income_id),
  UNIQUE KEY income_id (income_id))AUTO_INCREMENT=10000;";

if ($mysqli->query($sql) === TRUE) {
    echo "<br>income table created successfully";
} else {
    echo "<br>Error creating income table: " . $mysqli->error;
}
$mysqli->close();