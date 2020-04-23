<?php

use Router\Response as Response;
use HttpRequest\Http as Http;
use DB\Access as Access;
use User\User as User;

include_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Auth/GoogleLogin.php");

$googleLogin = new GoogleLogin();

// Include configuratio file
include_once($_SERVER['DOCUMENT_ROOT'] . "/config/google/googleLoginConfig.php");

$googleLogin->setClientConfig($config);
$googleLogin->clientDefine();

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {

    $code = $_GET['code'];

    $profile = $googleLogin->getProfile($code);

// now you can use this profile info to create account in your website and make user logged in.

// start a new session associated with this user

    $googleLogin->startSession($profile);

/* Make a request call to server to verify if this googleID is already saved
* If Not, create a new user in next step;
* If yes, skip next step.
*/

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if (!$user->hasGoogleID($profile->googleID)) {

    // Make an http request to create a new user on server on-the-fly
    $http = new Http();
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/user/create';
    $data = [
        "username" => $email,
        'name' => $name,
        'email' => $email,
        "googleID" => $googleID,
    ];
    $http->postRequest($url, $data);

}

/*Redirect page to login window:
* Uses Class Response, method redirect
*/
$res = new Response;
$res->redirect("/login");

} else {

    include_once($_SERVER['DOCUMENT_ROOT'] . "/forms/googleLoginButton.php");

}?>
