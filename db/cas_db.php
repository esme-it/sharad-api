<?php
require_once ('init.php');
// Connect to the cluster and keyspace "playerrport"
$cluster  = Cassandra::cluster()
                ->withContactPoints(config::get('cassandra/host'))
                ->withPort(9042)
                ->build();
$session = $cluster->connect();

