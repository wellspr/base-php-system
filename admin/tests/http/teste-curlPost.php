<?php

use HttpRequest\Http as Http;

$http = new Http();

// URL
$url = "https://boilerplate.org/user/create";

// Data to send

$email = 'bobo@globo.com';
$name = 'Bobalhão Zalhão';
$id = '1234567890';

$data = [
    "username" => $email,
    'name' => $name,
    'email' => $email,
    "googleID" => $id,
];

$headers = [
    // 'Host: organizer.org',
    // 'Referer: boilerplate.org',
    // 'Accept: text/html, text/plain',
    // 'Accept: application/json, application/xml',
    // 'Accept-Language: pt-BR, en-US'
];

echo $http->postRequest($url, $data);
