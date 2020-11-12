<h1>Password Reset</h1>

<form class="password-reset" action="" method="post">

    <label for="user_name"> User </label><br>
        <input type="text" id="user_name" name="username" value="" placeholder="User to change password">

    <br>

    <label> New Password </label><br>
        <input type="password" name="password" value="" placeholder="Informe uma nova senha">

    <br>

    <input type="submit" name="submit" value="Confirmar">

</form>


<?php

use DB\Access as Access;
use User\User as User;
use Crypto\Encrypt as Crypt;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // // Get the username
    $username = $_POST["username"];

    // Get the value of password
    $new_password = $_POST["password"];

    // Encrypt password
    $crypt = new Crypt();
    $new_password = $crypt->encrypt($new_password);

    $query = ['username' => $username];

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
