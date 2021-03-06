<?php

use DB\Access as Access;
use User\User as User;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    if($_POST['username']){

        $username = $_POST['username'];
        $filter = ['username' => $username];

    } else {

        $filter = [];

    }

    $options = [];

    $foundUsers = $user->read($filter, $options);

// Prints the user info
    if ($foundUsers) {

        displayObject($foundUsers);

    }

}
