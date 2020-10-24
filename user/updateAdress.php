<?php

use DB\Access as Access;
use User\User as User;
use Crypto\Encrypt as Crypt;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    // $id  = $_POST['id'];

    foreach ($_POST as $key => $value) {
        ${$key} = $_POST[$key];
        echo $key . ": " . $value;
    }



    $query = ['_id' => $user->sendIdToServer($id)];

    $options = ['$set' => [

            'adress' => [
                'street' => $street,
                'number' => $number,
                'complement' => $complement,
                'bairro' => $bairro,
                'zip' => $zip,
                'city' => $city,
                'state' => $state,
                'country' => $country
            ],

        ]

    ];

$updateResult = $user->update($query, $options);

    if ($updateResult[0]===1&&$updateResult[1]===1) {

        echo "Dados alterados com sucesso!";

    } else {

        echo "Ocorreu um erro";

    }

}
