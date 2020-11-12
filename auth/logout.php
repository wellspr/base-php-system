<?php

session_unset();

session_destroy();

/*Redirect page to login window:
* Uses Class Response, method redirect
*/
use Router\Response as Response;
$res = new Response;
$res->redirect("/login");
