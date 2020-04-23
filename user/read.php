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

    $username = $_POST['username'];

    $filter = ['username' => $username];

    $options = [];

    $foundUsers = $user->read($filter, $options);

    if ($foundUsers) {

        displayObject($foundUsers);

    }

}
