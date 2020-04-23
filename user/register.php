<?php
use FormCreate\Form as Form;
use DB\Access as Access;
use User\User as User;
use Crypto\Encrypt as Crypt;

$register = new Form();
$accessUri = Access :: clusterAccessUri();
$newUser = new User($accessUri);
$newUser->define();

if($_SERVER['REQUEST_METHOD']==='POST'){

    foreach ($_POST as $key => $value) {
        ${$key} = $register->clean($_POST[$key]);
    }

    // Encrypt password
    $crypt = new Crypt();
    $password = $crypt->encrypt($password);

    $user = [

        'username' => $username,

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
            'password' => $password
        ]

    ];

    $newUser->create($user);

}

$register->setFormTitle('Register');
$register->setActionURL("/user/register");
$register->setCSS('/resources/css/forms.css');

$pathToRegisterFields = $_SERVER['DOCUMENT_ROOT'] . "/config/register/fields.php";
include($pathToRegisterFields);

$register->setFields($fields);

$pathToRegisterButtons = $_SERVER['DOCUMENT_ROOT'] . "/config/register/buttons.php";
include($pathToRegisterButtons);

$register->setButtons($buttons);

$register->create();

?>
