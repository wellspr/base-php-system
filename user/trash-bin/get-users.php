<?php

use DB\Access as Access;
use User\User as User;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

// Receive a POST request for given "username"
if ($_SERVER['REQUEST_METHOD']==='POST') {

    if($_POST['username']){

        $username = $_POST['username'];
        $filter = ['username' => $username];

    } else {

        $filter = [];

    }

    $options = [];

    $users = $user -> read($filter, $options);

} else {

    // Without a POST request 
    $filter = [];
    $options = [];
    $users = $user -> read($filter, $options);

}
