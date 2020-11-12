<?php

// Create user
$app -> setRoute("/user/create", function($req, $res) {
    $res -> render("views", [
        'title' => 'Register',
        'contentDirectory' => 'user',
        'contentFileName' => 'create'
    ]);
});

// Rotas para tratamento de dados de usuário
$app -> setRoute("/user/:id", function($req, $res) {

    if (isset($_SESSION['id'])) {

        $id = $req -> params('id');

        if ($id=='') {

            $res -> render("views", [
                'title' => 'User',
                'contentDirectory' => "user",
                'contentFileName' => "user"
            ]);

        } else if ($id==='profile') {

            $res -> render("views", [
                'title' => 'Perfil do Usuário',
                'contentDirectory' => "content/user",
                'contentFileName' => "profile"
            ]);

        } else if ($id==='read') { // READ

            $res -> render("RESTviews", [
                'title' => 'Find User',
                'contentDirectory' => "user",
                'contentFileName' => "read"
            ]);

        } else if ($id==='update') { // UPDATE

            $res -> render("RESTviews", [
                'title' => 'Update User',
                'contentDirectory' => "user",
                'contentFileName' => "update"
            ]);

        } else if ($id==='updateAdress') { // UPDATE

            $res -> render("views", [
                'title' => 'Update User Adress',
                'contentDirectory' => "user",
                'contentFileName' => "updateAdress"
            ]);

        } else if ($id==='updateName') { // UPDATE

            $res -> render("views", [
                'title' => 'Update User\'s Name',
                'contentDirectory' => "user",
                'contentFileName' => "updateName"
            ]);

        } else if ($id==='updatePassword') { // UPDATE

            $res -> render("views", [
                'title' => 'Update Password',
                'contentDirectory' => "user",
                'contentFileName' => "updatePassword"
            ]);

        } else if ($id==='updateEmail') { // UPDATE

            $res -> render("views", [
                'title' => 'Update Password',
                'contentDirectory' => "user",
                'contentFileName' => "updateEmail"
            ]);

        } else if ($id==='delete') { // DELETE

            $res -> render("RESTviews", [
                'title' => 'Delete User',
                'contentDirectory' => "user",
                'contentFileName' => "delete"
            ]);

        } else if ($id==='editAdress') {

            $res -> render("views", [
                'title' => 'Edit Adress',
                'contentDirectory' => "user",
                'contentFileName' => "editAdress"
            ]);

        } else if ($id==='editName') {

            $res -> render("views", [
                'title' => 'Edit Name',
                'contentDirectory' => "user",
                'contentFileName' => "editName"
            ]);

        } else if ($id==='editPassword') {

            $res -> render("views", [
                'title' => 'Edit Password',
                'contentDirectory' => "user",
                'contentFileName' => "editPassword"
            ]);

        } else if ($id==='editEmail') {

            $res -> render("views", [
                'title' => 'Edit Email',
                'contentDirectory' => "user",
                'contentFileName' => "editEmail"
            ]);

        }

    } else {

        $res->redirect("/login");

    }

});
