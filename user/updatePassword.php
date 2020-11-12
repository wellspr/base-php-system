<?php

use DB\Access as Access;
use User\User as User;
use Crypto\Encrypt as Crypt;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // // Get the user's ID'
    $id = $_POST["id"];

    // Get the value of password
    $new_password = $_POST["password"];

    // Encrypt password
    $crypt = new Crypt();
    $new_password = $crypt->encrypt($new_password);

    $query = ['_id' => $user->sendIdToServer($id)];

    $options = ['$set' => [

            'password' => $new_password

        ]

    ];

    $updateResult = $user->update($query, $options);

    if ($updateResult[0]===1&&$updateResult[1]===1) {

        echo "Dados alterados com sucesso!";

    } else {

        echo "Ocorreu um erro";

    }

}
