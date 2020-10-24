<?php

// Rotas para tratamento de autorização de acesso
$app -> setRoute("/:id", function($req, $res) {

$id = $req -> params('id');

    if ($id==='login') {
        $res -> render("views", [
            'title' => 'Login',
            'contentDirectory' => "auth",
            'contentFileName' => "login"
        ]);

    } else if ($id==='loginValidate') {
        $res -> render("views", [
            'title' => 'Register',
            'contentDirectory' => "auth",
            'contentFileName' => "loginValidate"
        ]);

    } else if ($id==='logout') {
        $res -> render("views", [
            'title' => 'Logout',
            'contentDirectory' => "auth",
            'contentFileName' => "logout"
        ]);

    }

});


// Rotas para tratamento de autorização de acesso (via google-login)
$app -> setRoute("/google/:id", function($req, $res) {

$id = $req -> params('id');

    if ($id==='login') {
        $res -> render("views", [
            'title' => 'Google Login',
            'contentDirectory' => "auth",
            'contentFileName' => "google-login"
        ]);

    } else if ($id==='login-via-js') {
        $res -> render("views", [
            'title' => 'Google Login vis js',
            'contentDirectory' => "auth",
            'contentFileName' => "google-login-via-js"
        ]);

    }

});
