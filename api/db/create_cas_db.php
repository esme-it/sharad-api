<?php
#change
if (!$_GET['dbname']==''){

$keyspace  = $_GET['dbname'];

$createKeyspace = new Cassandra\SimpleStatement("CREATE KEYSPACE IF NOT EXISTS $keyspace WITH replication = {'class': 'SimpleStrategy','replication_factor': 1};");

$session->execute($createKeyspace);
if($session->execute("USE reporting")){
echo "<br>Database ".$keyspace." created";
}
}

