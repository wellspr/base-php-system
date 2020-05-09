<h1>DB Connection</h1>

<?php

use DB\Connect as Db;
use DB\Access as Access;

$accessData = Access :: clusterAccessData();
$accessUri = Access :: clusterAccessUri();

$clusterDB = new Db($accessUri);

$connection = $clusterDB->connect();

echo '$connection = $db->connect(); <br>';
print_r($connection);
echo "<br><br>";

$client = $clusterDB->client();

echo '$client = $clusterDB->client(); <br>';
print_r($client);
echo "<br><br>";

$dbName = $accessData['databaseName'];
$db = $client->$dbName;

echo '$db = $client->$dbName; <br>';
print_r($db);
echo "<br><br>";

// Here we choose the collection from database(in this case is 'users');
$collection = $client->$dbName->users;

echo '$collection = $client->test->users; <br>';
print_r($collection);
echo "<br><br>";

echo "Access database item: <br><br>";

$user = $collection->findOne(['username' => 'admin']);

echo '$user = $collection->findOne(["username" => "admin"]); <br>';
print_r($user);
echo "<br><br>";

var_dump($accessUri);

echo "<br>********************************<br>";


$collection = $client->$dbName->list;

echo '$collection = $client->test->list; <br>';
print_r($collection);
echo "<br><br>";
