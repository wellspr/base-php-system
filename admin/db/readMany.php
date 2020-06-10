<h1>Read User Info</h1>

<p>Método readMany</p>

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

echo "<br>";
echo "Listando alguns usuários: <br><br>";

$queryList = [
    ['username' => 'admin'],
    ['username' => 'paulowells@gmail.com'],
    ['username' => 'lrdwells@gmail.com']
];

$foundUsers = $user->readMany($queryList);

    if ($foundUsers) {

        foreach ($foundUsers as $user) {

            displayObject($user);
            echo "<br><br><br>";

        }


    }
