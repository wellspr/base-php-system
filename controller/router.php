<?php

use Router\Route as App;

$app = new App();

// Home page
$app -> setRoute("/", function($req, $res) {
    $res -> render("views", [
        'title' => 'Home',
        'contentDirectory' => "content",
        'contentFileName' => "home"
    ]);
});


// Rotas para tratamento de dados de usuário
$app -> setRoute("/user/:id", function($req, $res) {

$id = $req -> params('id');

        if ($id=='') {
            // Protected
            if (isset($_SESSION['id'])) {

                $res -> render("views", [
                    'title' => 'User',
                    'contentDirectory' => "user",
                    'contentFileName' => "user"
                ]);

            } else {

                $res->redirect("/login");

            }

        } else if ($id==='profile') {
            // Protected
            if (isset($_SESSION['id'])) {

                $res -> render("views", [
                    'title' => 'Perfil do Usuário',
                    'contentDirectory' => "content/user",
                    'contentFileName' => "profile"
                ]);

            } else {

                $res->redirect("/login");

            }

        } else if ($id==='create') { // CREATE

            $res -> render("RESTviews", [
                'title' => 'Create New User',
                'contentDirectory' => "user",
                'contentFileName' => "create"
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

        } else if ($id==='delete') { // DELETE

            $res -> render("RESTviews", [
                'title' => 'Delete User',
                'contentDirectory' => "user",
                'contentFileName' => "delete"
            ]);

        } else if ($id==='register') {

            $res -> render("views", [
                'title' => 'Create New User',
                'contentDirectory' => "user",
                'contentFileName' => "register"
            ]);

        } else if ($id==='edit') {

            $res -> render("views", [
                'title' => 'Edit User',
                'contentDirectory' => "user",
                'contentFileName' => "edit"
            ]);

        } else if ($id==='editPassword') {

            $res -> render("views", [
                'title' => 'Change Password',
                'contentDirectory' => "user",
                'contentFileName' => "editPassword"
            ]);

        } else if ($id==='editEmail') {

            $res -> render("views", [
                'title' => 'Change Email',
                'contentDirectory' => "user",
                'contentFileName' => "editEmail"
            ]);

        } else if ($id==='updatePasswd') {

            $res -> render("RESTviews", [
                'title' => 'Update Password',
                'contentDirectory' => "user",
                'contentFileName' => "updatePasswd"
            ]);

        } else if ($id==='updateEmail') {

            $res -> render("RESTviews", [
                'title' => 'Update Email',
                'contentDirectory' => "user",
                'contentFileName' => "updateEmail"
            ]);

        }

});

// Admin routes
$app -> setRoute("/admin/:id", function($req, $res) {

    $id = $req -> params('id');

    // Verify route
    if ($id==='panel') {

        // Verify user is Loggedin AND is administrator
        if (isset($_SESSION['id'])&&$_SESSION['username']==='admin') {
            // Admin acess
            $res -> render("views", [
                'title' => 'Admin',
                'contentDirectory' => "admin",
                'contentFileName' => "panel"
            ]);

        } else {
            // Anauthorized user
            $res->render("views", [
                'title' => 'Admin',
                'contentDirectory' => "admin",
                'contentFileName' => "anauthorized"
            ]);

        }

    }

});

$app -> setRoute("/admin/:id1/:id2", function($req, $res) {

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');

    // Verify route
    if ($id1==='user') {

        // Verify user is Loggedin AND is administrator
        if (isset($_SESSION['id'])&&$_SESSION['username']==='admin') {
            // Admin acess for system users

            if ($id2==='find-one'){

                $res -> render("views", [
                    'title' => 'Admin',
                    'contentDirectory' => "admin/user",
                    'contentFileName' => "find-one"
                ]);

            } else if ($id2==='find-many'){

                $res -> render("views", [
                    'title' => 'Admin',
                    'contentDirectory' => "admin/user",
                    'contentFileName' => "find-many"
                ]);

            } else if ($id2==='manage'){

                $res -> render("views", [
                    'title' => 'Admin',
                    'contentDirectory' => "admin/user",
                    'contentFileName' => "manage"
                ]);

            } else if ($id2==='list') {

                $res -> render("views", [
                    'title' => 'DB test Classes',
                    'contentDirectory' => "admin/user",
                    'contentFileName' => "list"
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

    } else if ($id1==='db'){

        // Rotas para testes no MongoDB (DB Access testing)

        // Verify user is Loggedin AND is administrator
        if (isset($_SESSION['id'])&&$_SESSION['username']==='admin') {
            // Admin acess for

            // $app -> setRoute("/db/:id1", function($req, $res) {
            //
            //     $id1 = $req->params("id1");

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

            }

        }

        // $app -> setRoute("/db/:id1/:id2", function($req, $res) {
        //
        //     $id1 = $req->params("id1");
        //     $id2 = $req->params("id2");
        //
        //     // Access to /db
        //     if ($id1==='connect'&&$id2==='') {
        //
        //         $res -> redirect("/db/connect");
        //
        //     } else if ($id1==='testClasses'&&$id2==='') {
        //
        //         $res -> redirect("/db/testClasses");
        //
        //     }
        //     // Access to /db/user
        //     if ($id1==='user'&&$id2==='readOne') {
        //
        //         $res -> render("views", [
        //             'title' => 'Read User Info',
        //             'contentDirectory' => "content/db/user",
        //             'contentFileName' => "readOne"
        //         ]);
        //
        //     } else if ($id1==='user'&&$id2==='readMany') {
        //
        //         $res -> render("views", [
        //             'title' => 'Read User Info',
        //             'contentDirectory' => "content/db/user",
        //             'contentFileName' => "readMany"
        //         ]);
        //
        //     }
        //
        // });

    }

});


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


// Rotas para tratamento de autorização de acesso
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


// Rotas para tratamentos de erros
$app -> setRoute("/error/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='403') {

        $res -> render("views", [
            'title' => '403',
            'contentDirectory' => "content/error",
            'contentFileName' => "403"
        ]);

    } else if ($id==='404'){

        $res -> render("views", [
            'title' => '404',
            'contentDirectory' => "content/error",
            'contentFileName' => "404"
        ]);

    }

});

// Rotas para testes de http requests
$app -> setRoute("/http/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='teste-curl'){

        $res -> render("views", [
            'title' => 'Teste cURL',
            'contentDirectory' => "content/http",
            'contentFileName' => "teste-curl"
        ]);

    } else if ($id==='teste-curlGet'){

        $res -> render("views", [
            'title' => 'Teste cURL: GET',
            'contentDirectory' => "content/http",
            'contentFileName' => "teste-curlGet"
        ]);

    } else if ($id==='teste-curlPost'){

        $res -> render("views", [
            'title' => 'Teste cURL: POST',
            'contentDirectory' => "content/http",
            'contentFileName' => "teste-curlPost"
        ]);

    }

});


// Info about password hashing
$app->setRoute("/passwordHash", function($req, $res) {

    $res->render('views', [
        'title' => 'Password Hash',
        'contentDirectory' => "content/password_hash",
        'contentFileName' => "passwordHash"
    ]);

});

// Get parameters of a query.
$app -> setRoute("/get_params", function($req, $res) {

    $req_uri = $req->get_request_uri();
    $params = $req->get_query_params($req_uri);

    // Load a URL of the website:

    if (isset($params['title'])) {
        $title = $params['title'];
    } else {
        $title = "Get User Params";
    }

    if (isset($params['file_name'])) {
        $file_name = $params['file_name'];
    } else {
        $file_name = 'get_params';
    }

    if (isset($params['dir_name'])) {
        $dir_name = $params['dir_name'];
    } else {
        $dir_name = 'user';
    }

    $res -> render("views", [
        'title' => "$title",
        'contentDirectory' => "$dir_name",
        'contentFileName' => "$file_name"
    ]);

});

// Testing the 'send' method.
$app -> setRoute("/:id", function($req, $res) {

$id = $req -> params('id');

    if ($id=='hello') {

        $res->send("Hello!!!");

    } else if ($id=='good-bye') {

        $res->send("Good Bye!!!");

    }

});

// A set of example routes
$app -> setRoute("/:id1/:id2", function($req, $res) {

    $id1 = $req->params('id1');
    $id2 = $req->params('id2');

    if($id1==='hello'&&$id2==='dear'){

        $res->send("$id1 $id2");

    } else if ($id1==='banana'&&$id2==='prata') {
        $res->send("$id1 $id2");
    }
});

$app -> setRoute("/testes/:id1/case/:id2", function($req, $res){

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');

    if ($id1=="1"&&$id2=="2") {
        $res->send("Deu certo:" . '/testes/'. $id1 . '/case/' . $id2);
    }else if ($id1=="3"&&$id2=="4") {
        $res->send("Deu certo:" . '/testes/'. $id1 . '/case/' . $id2);
    }
});

$app -> setRoute("/teste/:id1/:id2/:id3", function($req, $res){

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');
    $id3 = $req -> params('id3');

    if($id1==='1'&$id2==='2'&$id3==='3'){
        $res->send("Hello! from: /teste/$id1/$id2/$id3");
    }

});


$app -> setRoute("/teste", function($req, $res) {

    $res->send("Testing My Darling...");

});


$app -> setRoute("/Hello/MyDarling", function($req, $res) {

    $res->send("Hello My Darling!!!");

});

// Exibe o phpinfo
$app -> setRoute("/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='phpinfo'){

        $res->send(phpinfo());

    }

});
