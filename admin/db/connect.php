<h1>DB Connection</h1>

<?php

use DB\Connect as Db;
use DB\Access as Access;

$accessData = Access :: clusterAccessData();
$accessUri = Access :: clusterAccessUri();

$clusterDB = new Db($accessUri);

// Print the database access uri
echo "<h2>Access URI</h2>";
echo "<p>";
print_r($accessUri);
echo "</p>";
echo "<br>";
echo "<hr>";

// Get collection
$connection = $clusterDB->connect();
echo '<h2>$connection = $clusterDB->connect();</h2>';
print_r($connection);
echo "<br><br>";
echo "<hr>";

// Get client
$client = $clusterDB->client();
echo '<h2>$client = $clusterDB->client();</h2>';
print_r($client);
echo "<br><br>";
echo "<hr>";

// Get the database name as a String, directly from the class 'Access';
$dbName = $accessData['databaseName'];
echo "<h2>Database selected by defalt: ";
print_r($dbName);
echo "</h2>";
echo "<br>";
echo "<hr>";

// Select database
$db = $client->$dbName;
echo '<h2>$db = $client->$dbName; </h2>';
echo "Print database: <br>" ;
print_r($db);
echo "<br><br>";
var_dump($db);
echo "<br><br>";
echo "<hr>";

// Here we choose the collection from database(in this case is 'users');
$collection = $db->users;
echo '<h2>$collection = $client->test->users; </h2>';
print_r($collection);
echo "<br><br>";
var_dump($collection);
echo "<br><br>";
echo "<hr>";

// Select database item
$user = $collection->findOne(['username' => 'admin']);
echo '<h2>$user = $collection->findOne(["username" => "admin"]); </h2>';
echo "<p>Access database item:</p>";
print_r($user);
echo "<br><br>";
var_dump($user);
echo "<br><br>";
echo "<hr>";
echo "<br>";
