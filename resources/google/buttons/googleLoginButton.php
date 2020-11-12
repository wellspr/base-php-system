<?php

// use Auth\GoogleLogin as GoogleLogin;

include_once($_SERVER['DOCUMENT_ROOT'] . "/classes/Auth/GoogleLogin.php");

$googleLogin = new GoogleLogin();

// Include configuratio file
include_once($_SERVER['DOCUMENT_ROOT'] . "/config/google/googleLoginConfig.php");

$googleLogin->setClientConfig($config);
$googleLogin->clientDefine();
$googleLogin->buttonGenerate();

?>
