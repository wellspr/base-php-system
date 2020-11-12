<?php

// use DB\MongoDB\Client as Client;
use DB\MongoDB\Collection as Collection;

// $client = new Client();
$collection = new Collection();

// $connection = $client->startConnection();

// var_dump($connection->test->users);

// echo "<br><br>";

$users = $collection->getCollection('users');

$filter = [];
$options = [];

$result = $users->find($filter);

foreach ($result as $document) {
    var_dump($document['username']);
}
