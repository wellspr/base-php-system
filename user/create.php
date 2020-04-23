<?php

use DB\Access as Access;
use User\User as User;

$accessUri = Access :: clusterAccessUri();
$newUser = new User($accessUri);
$newUser->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $firstName = $_POST['name'];
    $lastName = '';
    $street = '';
    $number = '';
    $complement = '';
    $bairro = '';
    $zip = '';
    $city = '';
    $state = '';
    $country = '';
    $telResidencial = '';
    $telCelular = '';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = '';
    $googleID = $_POST['googleID'];


    $user = [

        'username' => $username,
        'googleID' => $googleID,

        'name' => [
            'firstName' => $firstName,
            'lastName' => $lastName
        ],

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

        'telephone' => [
            'residencial' => $telResidencial,
            'celular' => $telCelular
        ],

        'account' => [
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]

    ];

    $result = $newUser->create($user);

    if ($result===1) {

        echo "Usuário criado com sucesso!";

    } else {

        echo "Ocorreu um erro";

    }


}
