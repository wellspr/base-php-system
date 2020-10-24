<?php
/*  Update password by email
    Follows the forgot my password process
*/
use DB\Access as Access;
use User\User as User;
use Crypto\Encrypt as Crypt;
use Token\Token as Token;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // // Get the user's ID'
    $email = $_POST["email"];

    // Get the value of password
    $new_password = $_POST["password"];

    // Encrypt password
    $crypt = new Crypt();
    $new_password = $crypt->encrypt($new_password);

    $query = ['email' => $email];

    $options = ['$set' => [

            'password' => $new_password

        ]

    ];

    $updateResult = $user->update($query, $options);

    if ($updateResult[0]===1&&$updateResult[1]===1) {

        echo "Dados alterados com sucesso!";

        $myToken = new Token($accessUri);
        $myToken->define();

        $query = ['email' => $email];

        $myToken->delete($query);

    } else {

        echo "Ocorreu um erro";

    }

}
