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

$collection = $client->$dbName->users;

echo '$collection = $client->test->users; <br>';
print_r($collection);
echo "<br><br>";

echo "Access database item: <br><br>";

$user = $collection->findOne(['username' => 'wells']);

echo '$user = $collection->findOne(["username" => "wells"]); <br>';
print_r($user);
echo "<br><br>";

echo "Username: :" . $user->username . "<br>";
echo "Email: " . $user->email . "<br>";
echo "Name: " . $user->name . "<br>";
echo "ID: " . $user->_id . "<br>";


echo "<br><br>";

var_dump($accessUri);
