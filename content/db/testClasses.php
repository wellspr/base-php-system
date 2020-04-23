<?php

use DB\Connect as Connection;
use DB\Access as Access;
use DB\Collection as Collection;
use DB\Document as Document;
use User\User as User;

$accessData = Access :: clusterAccessData();
$accessUri = Access :: clusterAccessUri();

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$db = new Connection($accessUri);

var_dump($db->client()->test);

echo 'Até aqui <br><br>';

$collection = new Collection($accessUri);

var_dump($collection->getCollection());

echo 'Até aqui <br><br>';

// $connection = $db->connect();
//
// print_r($connection);
//
// echo "<br><br>";
//
//
// $client = $db->client();
//
// print_r($client);
//
// echo "<br><br>";

$user = new User($accessUri);
$user->define();

// $user = new Document($accessUri);



$query = [
    'username' => 'nico'
];

$foundUser = $user->readOne($query);
echo "ID: " . $foundUser->_id;
echo "<br>";

    if ($foundUser) {

        echo "Username: ";
        getField($foundUser,'username');
        echo "<br>";
        echo "Email: ";
        getField($foundUser,'email');
        echo "<br>";

        echo "Adress: <br>";

        if (isset($foundUser->adress)){

            $adress = $foundUser->adress;

            echo "&nbsp;&nbsp; Street: ";
            getField($adress,'street');
            echo "<br>";

            echo "&nbsp;&nbsp; Number: ";
            getField($adress,'number');
            echo "<br>";

            echo "&nbsp;&nbsp; Complement: ";
            getField($adress,'comp');
            echo "<br>";

            echo "&nbsp;&nbsp; City: ";
            getField($adress,'city');
            echo "<br>";

            echo "&nbsp;&nbsp; State: ";
            getField($adress,'state');
            echo "<br>";

            echo "&nbsp;&nbsp; Country: ";
            getField($adress,'country');
            echo "<br>";

            echo "&nbsp;&nbsp; Zip: ";
            getField($adress,'zip');
            echo "<br>";

        } else {

            echo "&nbsp;&nbsp; User has no adress in database.";

        }

    } else {

        echo "There is no such user.";

    }

function getField($array, string $field)
{
    print_r($array->$field);
}

echo "<br><br>";

$list = new Document($accessUri);
$list->setCollectionName('list');

$filter = ['name' => 'Estudar'];


$foundItem = $list->readOne($filter);


    if ($foundItem) {

        displayObject($foundItem);

    }



    echo "<br><br>";



    $filter = [];

    $options = [];

    $items = $list->read($filter, $options);

        if ($items) {

            displayObject($items);

        }
