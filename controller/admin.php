<?php

// Exibe o phpinfo
$app -> setRoute("/phpinfo", function($req, $res) {

    // Verify user is Loggedin AND is administrator
    if (isset($_SESSION['id'])&&$_SESSION['username']==='admin') {

        $res->send(phpinfo());

    }

});

// Admin routes
$app -> setRoute("/admin/:id", function($req, $res) {

    // Verify user is Loggedin AND is administrator
    if (isset($_SESSION['id'])&&$_SESSION['username']==='admin') {

    $id = $req -> params('id');

        // Admin Panel
        if ($id==='dashboard') {

            $res -> render("views", [
                'title' => 'Admin',
                'contentDirectory' => "admin",
                'contentFileName' => "dashboard"
            ]);

        }

    } else {
        // Anauthorized user
        $res->render("views", [
            'title' => 'Admin',
            'contentDirectory' => "admin",
            'contentFileName' => "anauthorized"
        ]);

    }

});

$app -> setRoute("/admin/:id1/:id2", function($req, $res) {

    // Verify user is Loggedin AND is administrator
    if (isset($_SESSION['id'])&&$_SESSION['username']==='admin') {

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');

        // Verify route
        if ($id1==='user') {

            // Admin acess for system users

            if ($id2==='find'){

                $res -> render("views", [
                    'title' => 'Admin',
                    'contentDirectory' => "admin/user",
                    'contentFileName' => "find"
                ]);

            } else if ($id2==='manage'){

                $res -> render("views", [
                    'title' => 'Admin',
                    'contentDirectory' => "admin/user",
                    'contentFileName' => "manage"
                ]);

            }  else if ($id2==='resetPassword') {

                // Reset users password
                $res -> render("views", [
                    'title' => 'Password Reset',
                    'contentDirectory' => "admin/user",
                    'contentFileName' => "resetPassword"
                ]);

            }

        } else if ($id1==='db'){

            // Rotas para testes no MongoDB (DB Access testing)

            // Access to /db
            if ($id2==='connect') {

                $res -> render("views", [
                    'title' => 'DB Connection',
                    'contentDirectory' => "admin/db",
                    'contentFileName' => "connect"
                ]);

            } else if ($id2==='testClasses') {

                $res -> render("views", [
                    'title' => 'DB test Classes',
                    'contentDirectory' => "admin/db",
                    'contentFileName' => "testClasses"
                ]);

            } else if ($id2==='manage-tokens') {

                $res -> render("views", [
                    'title' => 'Manage Tokens',
                    'contentDirectory' => "admin/db",
                    'contentFileName' => "manageTokens"
                ]);

            }

        } else if ($id1=="example"){

            // Admin acess for /example-Routes

            // Access to /example-routes
            if ($id2==='routes') {

                $res -> render("views", [
                    'title' => 'DB Connection',
                    'contentDirectory' => "admin/example",
                    'contentFileName' => "routes"
                ]);

            } else if ($id2==='pages') {

                $res -> render("views", [
                    'title' => 'DB test Classes',
                    'contentDirectory' => "admin/example",
                    'contentFileName' => "pages"
                ]);

            } else if ($id2==='passwordHash') {
                // Info about password hash

                $res -> render("views", [
                    'title' => 'Password Hash',
                    'contentDirectory' => "admin/example",
                    'contentFileName' => "passwordHash"
                ]);

            }

        } else if ($id1 === 'tests') {

            // Rotas para testes de http requests
            if ($id2==='teste-curl'){

                $res -> render("views", [
                    'title' => 'Teste cURL',
                    'contentDirectory' => "content/http",
                    'contentFileName' => "teste-curl"
                ]);

            } else if ($id2==='teste-curlGet'){

                $res -> render("views", [
                    'title' => 'Teste cURL: GET',
                    'contentDirectory' => "content/http",
                    'contentFileName' => "teste-curlGet"
                ]);

            } else if ($id2==='teste-curlPost'){

                $res -> render("views", [
                    'title' => 'Teste cURL: POST',
                    'contentDirectory' => "content/http",
                    'contentFileName' => "teste-curlPost"
                ]);

            }

        }

    } else {
        // Anauthorized user
        $res->render("views", [
            'title' => 'Admin',
            'contentDirectory' => "admin",
            'contentFileName' => "anauthorized"
        ]);

    }

});
