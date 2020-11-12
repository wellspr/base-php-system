<h1>Database Connection</h1>

<hr>

<p>PHP MongoDB database connection reference: </p>
<a href="https://docs.mongodb.com/php-library/master/reference/" target="_blank">https://docs.mongodb.com/php-library/master/reference/</a>

<p>PHP MongoDB CRUD operations manuals</p>
<a href="https://docs.mongodb.com/php-library/current/tutorial/crud/" target="_blank">https://docs.mongodb.com/php-library/current/tutorial/crud/</a>

<p>University MongoDB</p>
<a href="https://university.mongodb.com/" target="_blank">https://university.mongodb.com/</a>

<?php

$username = "admin-wells";
$password = "teste123";
$clusterAdress = "cluster0-etjm8.mongodb.net";
$databaseName = "test";

// Create connection
$connect = new MongoDB\Client(
    'mongodb+srv://'. $username .':'. $password .'@'. $clusterAdress .'/'. $databaseName .'?retryWrites=true&w=majority'
);

echo <<<HERE

    <h2>Databases on Server: </h2>

HERE;

// List all databases with method listDatabases()
$databases = $connect->listDatabases();

foreach ($databases as $database) {
    echo $database["name"];
    echo "<br>";
}

echo "<hr><br><br>";

// Database (The database is chosen at the connection)
$db = $connect->$databaseName;
var_dump($db);
echo "<br><br>";

// Collection -> Each database has one or more collections
$collection = $db->users;
/*  This collection could be named "users":
    $users = $db->users;
*/

/*  A cursor helps to extract a document from the collection,
    using a specific collection method, in this case, find;
*/
$cursor = $collection->find(['username' => 'pato']);
// This cursor can be named "results", "foundUsers", etc

// We could name the documents "user"
foreach ($cursor as $document) {
    var_dump($document);
}
