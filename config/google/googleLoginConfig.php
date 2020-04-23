<?php

$config = [

    'credentials' => '../credentials/credentials.json',
    'scope' => 'profile openid email',
    'redirect_uri' => 'https://' . $_SERVER['HTTP_HOST'] . '/google/login',
    'prompt' => 'select_account'

];
