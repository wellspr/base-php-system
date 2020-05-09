<?php


use DB\Access as Access;
use User\User as User;
use User\Session as Session;
use Auth\Login as Login;
use Router\Response as Response;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

$login = new Login();
$login->setUser($user);

$session = new Session();
$session->setUser($user);

$response = new Response();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $usernameInformed = $_POST['username'];
    $passwordInformed = $_POST['password'];

    if ($login->validate($usernameInformed, $passwordInformed)) {

        $session->start($usernameInformed);

        $response->redirect("/");

    }
}
