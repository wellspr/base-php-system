<?php

$app -> setRoute("/register", function($req, $res) {
    $res->render("views", [
        'title' => 'Registrar Usuário',
        'contentDirectory' => 'user/register',
        'contentFileName' => 'register'
    ]);
});
