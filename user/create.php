<?php
use FormCreate\Form as Form;
use DB\Access as Access;
use User\User as User;
use Crypto\Encrypt as Crypt;

$register = new Form();
$accessUri = Access :: clusterAccessUri();
$newUser = new User($accessUri);
$newUser->define();

$creationDate = date("Y-m-d");
$creationYear = date("Y");
$creationMonth = date("m");
$creationDay = date("d");
$creationTime = date("h:m:sa");

if($_SERVER['REQUEST_METHOD']==='POST'){

    foreach ($_POST as $key => $value) {
        ${$key} = $register->clean($_POST[$key]);
    }

    // Encrypt password
    $crypt = new Crypt();
    $password = $crypt->encrypt($password);

    $user = [

        'username' => $username,
        'email' => $email,
        'password' => $password,

        'name' => [
            'firstName' => $firstName,
            'lastName' => $lastName
        ],

        'adress' => [],

        'telephone' => [],

        'creationDate' => $creationDate,
        'creationYear' => $creationYear,
        'creationMonth' => $creationMonth,
        'creationDay' => $creationDay,
        'creationTime' => $creationTime,

    ];

    if (!$newUser->username_exists($username)) {

        if (!$newUser->email_exists($email)) {

            if ($newUser->create($user)) {

                echo "Usuário cadastrado com sucesso!";

            } else {

                echo "Houve um problema, por favor tente novamente.";

            }

        } else {

            echo "Email já cadastrado!";

            $username = $user['username'];

            include_once($_SERVER['DOCUMENT_ROOT'] . "/user/register/register.php");

        }

    } else {

        echo "Username não disponível!";

        include_once($_SERVER['DOCUMENT_ROOT'] . "/user/register/register.php");

    }

}

?>
