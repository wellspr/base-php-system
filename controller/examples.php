<?php

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


$app -> setRoute("/testes/:id1", function($req, $res){

    $id1 = $req -> params('id1');

    $res->send("Deu certo:" . '/testes/'. $id1);

});


$app -> setRoute("/testes/:id1/:id2", function($req, $res){

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');

    $res->send("Deu certo:" . '/testes/'. $id1 . "/" . $id2);

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


$app -> setRoute("/testes/:id1/:id2/:id3", function($req, $res){

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
