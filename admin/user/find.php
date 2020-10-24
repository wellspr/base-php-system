<div class="forms">

    <h1>Data Base Query Access</h1>

    <form action="" method="post">

        <label for="user">Search for a user by username:</label>
        <input id="user" type="text" name="username" value=""><br>

        <label for="user">Search for a user by email:</label>
        <input id="user" type="text" name="email" value=""><br>

        <button type="submit" name="button">Enviar</button>
        <input type="submit" name="showAllUsers" value="Show All Users">

    </form>

</div>


<?php

use DB\Access as Access;
use User\User as User;

include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    if($_POST['username']){

        $username = $_POST['username'];
        $filter = ['username' => $username];
        $options = [];

        $foundUsers = $user->read($filter, $options);

        // Prints the user info
        if ($foundUsers) {

            displayObject($foundUsers);

        }

    } else if($_POST['email']){

        $email = $_POST['email'];
        $filter = [
            // 'email' => $email,
            'account' => ['email' => $email]
        ];
        $options = [];

        $foundUsers = $user->read($filter, $options);

        // Prints the user info
        if ($foundUsers) {

            displayObject($foundUsers);

        }

    } else if($_POST['showAllUsers']){

        $filter = [];
        $options = [

            'projection' => [
                'username' => 1,
                'email' => 1,
                '_id' => 0,
            ],

            'sort' => ['username' => 1]

        ];

        $foundUsers = $user->read($filter, $options);

        echo "<br><hr>";

        foreach ($foundUsers as $user) {
            echo "Username: " . $user->username;
            echo "<br>";
            var_dump($user);
            echo "<hr>";
        }

    }

}
