<?php

use HttpRequest\Http as Http;

$http = new Http();

// $url = "https://base-php/user/profile";

$url = "/";

$result = $http->getRequest($url);

print_r($result);

var_dump($result);
