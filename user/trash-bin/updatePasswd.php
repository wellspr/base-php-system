<?php

use DB\Access as Access;
use User\User as User;
use Crypto\Encrypt as Crypt;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    // $id  = $_POST['id'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    // $email  = $_POST['email'];

    echo $username;
    echo $password;

    // Encrypt password
    $crypt = new Crypt();
    $password = $crypt->encrypt($password);

    $query = ['username' => $username];

    $options = ['$set' => [

            'account' => [

                'password' => $password

            ]
        ]
    ];

    $updateResult = $user->update($query, $options);

    if ($updateResult[0]===1&&$updateResult[1]===1) {

        echo "Dados alterados com sucesso!";

    } else {

        echo "Ocorreu um erro";

    }

}
