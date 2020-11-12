<h1>Teste cURL</h1>

<?php

use HttpRequest\Http as Http;

$http = new Http();

$url = "https://www.google.com";

echo $http->request($url);
