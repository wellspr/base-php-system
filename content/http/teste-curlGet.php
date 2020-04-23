<?php

use HttpRequest\Http as Http;

$http = new Http();

$url = "https://boilerplate.org/user/get_params?name=Paulo&title=Page&dir_name=content&file_name=home";

echo $http->getRequest($url);
