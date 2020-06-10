<h1>Read User Info</h1>

<p>Método readOne</p>

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

// Primeiro método: readOne
echo "Listando um usuário apenas: <br><br>";


$filter = ['username' => 'admin'];


$foundUser = $user->readOne($filter);

print_r($foundUser);

// print_r($foundUser->name);

    if ($foundUser) {

        displayObject($foundUser);

    }
